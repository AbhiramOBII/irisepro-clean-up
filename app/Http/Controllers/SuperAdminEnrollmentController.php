<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enrollment;

class SuperAdminEnrollmentController extends Controller
{
    /**
     * Display a listing of enrollments.
     */
    public function index()
    {
        $enrollments = Enrollment::with(['challenge', 'batch'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('superadmin.enrollments.index', compact('enrollments'));
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
