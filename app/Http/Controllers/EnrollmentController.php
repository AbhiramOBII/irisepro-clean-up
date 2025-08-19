<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use App\Batch;
use App\Student;
use App\Enrollment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;
use App\StudentOtp;
use Illuminate\Support\Facades\Mail;

class EnrollmentController extends Controller
{
    /**
     * Create or fetch Student record corresponding to paid enrollment
     */
    private function createOrGetStudent(Enrollment $enrollment)
    {
        // Check existing student
        $student = Student::where('email', $enrollment->email_id)->first();
        if (!$student) {
            $student = Student::create([
                'full_name'          => $enrollment->full_name,
                'email'              => $enrollment->email_id,
                'phone_number'       => $enrollment->phone_number,
                'date_of_birth'      => $enrollment->date_of_birth,
                'gender'             => $enrollment->gender === 'prefer_not_to_say' ? 'other' : $enrollment->gender,
                'partner_institution'=> null,
                'status'             => 'active',
                'email_verified_at'  => null,
                'has_seen_welcome'   => false,
                'B2C'                => true,
            ]);
        }

        // Attach batch/challenge in pivot if not yet
        if (!$student->batches()->wherePivot('batch_id', $enrollment->batch_selected)->exists()) {
            $challenge = Challenge::find($enrollment->challenge_id);
            $amount = $challenge ? $challenge->selling_price : 0;
            $student->batches()->attach($enrollment->batch_selected, [
                'challenge_id'   => $enrollment->challenge_id,
                'amount'         => $amount,
                'payment_status' => 'paid',
                'payment_time'   => now(),
                'payment_comments' => 'Auto-assigned from enrollment payment confirmation',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
        return $student;
    }

    /**
     * Generate OTP and send verification email
     */
    private function sendVerificationEmail(Student $student)
    {
        // Remove existing OTP
        StudentOtp::where('student_id', $student->id)->delete();

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = Carbon::now()->addMinutes(30);

        StudentOtp::create([
            'student_id' => $student->id,
            'email'      => $student->email,
            'otp'        => $otp,
            'expires_at' => $expiresAt,
            'is_used'    => false,
        ]);

        Mail::send('emails.verify-email', [
            'name' => $student->full_name,
            'otp'  => $otp,
            'email' => $student->email,
            'expires_in' => '30 minutes',
        ], function ($message) use ($student) {
            $message->to($student->email)
                    ->subject('iRisePro – Verify Your Email');
        });
    }

    /**
     * Show challenge details page
     */
    public function showChallengeDetails($challengeId)
    {
        $challenge = Challenge::with(['batches' => function($query) {
            $query->where('start_date', '>=', Carbon::now()->addDays(2)->toDateString())
                  ->where('status', 'active')
                  ->orderBy('start_date', 'asc');
        }])->find($challengeId);

        if (!$challenge) {
            abort(404, 'Challenge not found');
        }

        return view('landing.challenge-details', compact('challenge'));
    }

    /**
     * Start Razorpay payment and create enrollment draft
     */
    public function startPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'challenge_id'   => 'required|exists:challenges,id',
            'batch_id'       => 'required|exists:batches,id',
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:20',
            'date_of_birth'  => 'required|date|before:today',
            'gender'         => 'required|in:male,female,prefer_not_to_say',
            'education'      => 'nullable|string|max:100',
            'goals'          => 'nullable|string|max:1000',
            'amount'         => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Check if enrollment already exists for this email, challenge & batch
        $existingEnrollment = Enrollment::where([
            ['email_id', '=', $request->email],
            ['challenge_id', '=', $request->challenge_id],
            ['batch_selected', '=', $request->batch_id],
        ])->first();

        if ($existingEnrollment) {
            if ($existingEnrollment->payment_status === 'paid') {
                return back()->with('error', 'You have already completed payment for this batch.');
            }
            // Pending or authorised payment exists – redirect to its payment page
            return redirect()->route('enrollment.pay.page', $existingEnrollment);
        }

        DB::beginTransaction();

        // ensure not duplicate pending enrollment
        $enrollment = Enrollment::create([
            'full_name'        => $request->name,
            'email_id'         => $request->email,
            'phone_number'     => $request->phone,
            'date_of_birth'    => $request->date_of_birth,
            'gender'           => $request->gender,
            'educational_level'=> $request->education,
            'goals'            => $request->goals,
            'batch_selected'   => $request->batch_id,
            'challenge_id'     => $request->challenge_id,
            'payment_status'   => 'pending'
        ]);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $order = $api->order->create([
            'receipt'         => 'enroll_'.$enrollment->id,
            'amount'          => $request->amount * 100, // paise
            'currency'        => 'INR',
            'payment_capture' => 1,
        ]);
        $enrollment->update(['razorpay_order_id' => $order['id']]);
        DB::commit();

        // Redirect to GET payment page so page refresh works safely
        return redirect()->route('enrollment.pay.page', $enrollment);
    }

    /**
     * Verify Razorpay payment signature
     */
    public function paymentPage(Enrollment $enrollment)
    {
        // If already paid, redirect back to challenge
        if ($enrollment->payment_status === 'paid') {
            return redirect()->route('challenge.details', $enrollment->challenge_id)
                    ->with('success', 'Payment already completed for this enrollment.');
        }

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $order = $api->order->fetch($enrollment->razorpay_order_id);

        return view('landing.payment', [
            'order'      => $order->toArray(),
            'enrollment' => $enrollment,
            'key'        => config('services.razorpay.key'),
        ]);
    }

    public function verifyPayment(Request $request)
    {
        $input = $request->all();
        $enrollment = Enrollment::where('razorpay_order_id', $input['razorpay_order_id'] ?? null)->firstOrFail();

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        try {
            $api->utility->verifyPaymentSignature($input);
            $enrollment->update([
                'payment_status'      => 'paid',
                'razorpay_payment_id' => $input['razorpay_payment_id'] ?? null,
            ]);

            // Move enrollment data into Student table & send verification email
            $student = $this->createOrGetStudent($enrollment);
            $this->sendVerificationEmail($student);

            return redirect()->route('challenge.details', $enrollment->challenge_id)
                    ->with('success', 'Payment successful! Please check your email for verification link.');
        } catch (\Exception $e) {
            return back()->with('error', 'Payment verification failed');
        }
    }

    /**
     * Razorpay webhook endpoint (optional)
     */
    public function webhook(Request $request)
    {
        $payload   = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');
        $expected  = hash_hmac('sha256', $payload, config('services.razorpay.webhook_secret'));

        if (!hash_equals($expected, $signature)) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $data = json_decode($payload, true);
        $event     = $data['event'] ?? null;
        $orderId   = $data['payload']['payment']['entity']['order_id'] ?? null;
        $paymentId = $data['payload']['payment']['entity']['id'] ?? null;

        $enrollment = $orderId ? Enrollment::where('razorpay_order_id', $orderId)->first() : null;

        switch ($event) {
            case 'payment.captured':
                if ($enrollment) {
                    $enrollment->update([
                        'payment_status'      => 'paid',
                        'razorpay_payment_id' => $paymentId
                    ]);
                    $student = $this->createOrGetStudent($enrollment);
                    $this->sendVerificationEmail($student);
                }
                break;

            case 'payment.authorized':
                // Payment authorised but not captured yet
                if ($enrollment && $enrollment->payment_status !== 'paid') {
                    $enrollment->update([
                        'payment_status'      => 'authorized',
                        'razorpay_payment_id' => $paymentId
                    ]);
                }
                break;

            case 'payment.refunded':
                if ($enrollment) {
                    $enrollment->update([
                        'payment_status'   => 'refunded',
                        'payment_comments' => 'Payment refunded via Razorpay'
                    ]);
                    // TODO: optionally notify the student about the refund
                }
                break;
        }

        return response()->json(['status' => 'ok']);
    }
}
