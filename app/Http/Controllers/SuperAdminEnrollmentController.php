<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enrollment;
use App\Challenge;
use App\Batch;
use App\Student;

class SuperAdminEnrollmentController extends Controller
{
    /**
     * Display a listing of enrollments.
     */
    public function index(Request $request)
    {
        $query = Enrollment::with(['challenge', 'batch']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('email_id', 'LIKE', "%{$search}%")
                  ->orWhere('phone_number', 'LIKE', "%{$search}%");
            });
        }

        // Challenge filter
        if ($request->filled('challenge_id')) {
            $query->where('challenge_id', $request->challenge_id);
        }

        // Batch filter
        if ($request->filled('batch_id')) {
            $query->where('batch_selected', $request->batch_id);
        }

        // Payment status filter
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $enrollments = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Get all challenges and batches for filter dropdowns
        $challenges = Challenge::orderBy('title')->get();
        $batches = Batch::orderBy('title')->get();

        return view('superadmin.enrollments.index', compact('enrollments', 'challenges', 'batches'));
    }

    /**
     * Display the specified enrollment.
     */
    public function show($id)
    {
        $enrollment = Enrollment::with(['challenge', 'batch'])->findOrFail($id);
        return view('superadmin.enrollments.show', compact('enrollment'));
    }

    /**
     * Update payment status of enrollment.
     */
    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:paid,unpaid'
        ]);

        $enrollment = Enrollment::findOrFail($id);
        $oldStatus = $enrollment->payment_status;
        
        $enrollment->update([
            'payment_status' => $request->payment_status
        ]);

        // If payment status changed to 'paid', move enrollment data to Student table
        if ($request->payment_status === 'paid' && $oldStatus !== 'paid') {
            $this->moveEnrollmentToStudent($enrollment);
        }

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }

    /**
     * Move enrollment data to Student table when payment is confirmed.
     */
    private function moveEnrollmentToStudent(Enrollment $enrollment)
    {
        // Check if student already exists with this email
        $existingStudent = Student::where('email', $enrollment->email_id)->first();
        
        if (!$existingStudent) {
            // Map enrollment data to student fields
            $studentData = [
                'full_name' => $enrollment->full_name,
                'email' => $enrollment->email_id,
                'phone_number' => $enrollment->phone_number,
                'date_of_birth' => $enrollment->date_of_birth,
                'gender' => $enrollment->gender === 'prefer_not_to_say' ? 'other' : $enrollment->gender,
                'partner_institution' => null, // Not available in enrollment
                'status' => 'active',
                'email_verified_at' => null,
                'has_seen_welcome' => false,
                'B2C' => true // Set B2C to true for paid enrollments
            ];

            $student = Student::create($studentData);
            
            // Assign student to batch with paid status
            $this->assignStudentToBatch($student, $enrollment);
        } else {
            // If student exists, still assign to batch if not already assigned
            $this->assignStudentToBatch($existingStudent, $enrollment);
        }
    }

    /**
     * Assign student to batch with payment status as paid.
     */
    private function assignStudentToBatch(Student $student, Enrollment $enrollment)
    {
        // Check if student is already assigned to this batch
        $existingAssignment = $student->batches()
            ->wherePivot('batch_id', $enrollment->batch_selected)
            ->wherePivot('challenge_id', $enrollment->challenge_id)
            ->first();
            
        if (!$existingAssignment) {
            // Get challenge amount for pivot table
            $challenge = Challenge::find($enrollment->challenge_id);
            $amount = $challenge ? $challenge->selling_price : 0;
            
            // Assign student to batch with paid status
            $student->batches()->attach($enrollment->batch_selected, [
                'challenge_id' => $enrollment->challenge_id,
                'amount' => $amount,
                'payment_status' => 'paid',
                'payment_time' => now(),
                'payment_comments' => 'Auto-assigned from enrollment payment confirmation',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            // Update existing assignment to paid status if it was unpaid
            if ($existingAssignment->pivot->payment_status !== 'paid') {
                $student->batches()->updateExistingPivot($enrollment->batch_selected, [
                    'payment_status' => 'paid',
                    'payment_time' => now(),
                    'payment_comments' => 'Payment confirmed via enrollment',
                    'updated_at' => now()
                ]);
            }
        }
    }

    /**
     * Remove the specified enrollment from storage.
     */
    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return redirect()->route('superadmin.enrollments.index')
            ->with('success', 'Enrollment deleted successfully.');
    }
}
