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

class EnrollmentController extends Controller
{
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
     * Submit enrollment form
     */
    public function submitEnrollment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'challenge_id' => 'required|exists:challenges,id',
            'batch_id' => 'required|exists:batches,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,prefer_not_to_say',
            'education' => 'nullable|string|max:100',
            'goals' => 'nullable|string|max:1000',
            'terms' => 'required|accepted'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill in all required fields correctly',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Check if user is already enrolled in this batch
            $existingEnrollment = Enrollment::where('email_id', $request->email)
                ->where('batch_selected', $request->batch_id)
                ->where('challenge_id', $request->challenge_id)
                ->first();

            if ($existingEnrollment) {
                DB::rollBack();
                return redirect()->back()->with('error', 'You are already enrolled in this challenge batch.');
            }

            // Get challenge and batch details
            $challenge = Challenge::find($request->challenge_id);
            $batch = Batch::find($request->batch_id);

            // Create new enrollment record
            $enrollment = Enrollment::create([
                'full_name' => $request->name,
                'email_id' => $request->email,
                'phone_number' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'educational_level' => $request->education,
                'goals' => $request->goals,
                'batch_selected' => $request->batch_id,
                'challenge_id' => $request->challenge_id,
                'payment_status' => 'unpaid'
            ]);

            DB::commit();

            // TODO: Send enrollment confirmation email
            // TODO: Send SMS notification
            // TODO: Notify admin about new enrollment

            return redirect()->back()->with('success', 'Enrollment successful! We will contact you shortly with payment details.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Enrollment failed. Please try again or contact support.');
        }
    }
}
