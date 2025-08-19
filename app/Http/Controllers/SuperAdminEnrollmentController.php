<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enrollment;
use App\Challenge;
use App\Batch;

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
        $enrollment->update([
            'payment_status' => $request->payment_status
        ]);

        return redirect()->back()->with('success', 'Payment status updated successfully.');
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
