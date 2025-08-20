<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HelpRequest;
use App\Models\Student;

class SupportRequestController extends Controller
{
    /**
     * Display a listing of support requests.
     */
    public function index()
    {
        $helpRequests = HelpRequest::with('student')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('superadmin.support-requests.index', compact('helpRequests'));
    }

    /**
     * Display the specified support request.
     */
    public function show($id)
    {
        $request = HelpRequest::with('student')->findOrFail($id);

        return view('superadmin.support-requests.show', compact('request'));
    }

    /**
     * Get support request details as JSON (for AJAX calls).
     */
    public function getDetails($id)
    {
        $helpRequest = HelpRequest::with('student')->findOrFail($id);

        return response()->json([
            'success' => true,
            'request' => [
                'id' => $helpRequest->id,
                'student' => [
                    'full_name' => $helpRequest->student->full_name,
                    'email' => $helpRequest->student->email
                ],
                'issue_type_display' => $helpRequest->issue_type_display,
                'status_display' => $helpRequest->status_display,
                'description' => $helpRequest->description,
                'created_at' => $helpRequest->created_at->toISOString(),
                'updated_at' => $helpRequest->updated_at->toISOString()
            ]
        ]);
    }

    /**
     * Update the status of the specified support request.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed'
        ]);

        $helpRequest = HelpRequest::findOrFail($id);
        $helpRequest->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    /**
     * Remove the specified support request from storage.
     */
    public function destroy($id)
    {
        $helpRequest = HelpRequest::findOrFail($id);
        $helpRequest->delete();

        return response()->json([
            'success' => true,
            'message' => 'Support request deleted successfully'
        ]);
    }
}
