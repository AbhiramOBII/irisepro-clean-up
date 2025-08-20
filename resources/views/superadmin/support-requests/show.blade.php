@extends('superadmin.layout')

@section('title', 'Support Request Details')
@section('page-title', 'Support Request #' . $request->id)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('superadmin.support-requests.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Support Requests
        </a>
    </div>

    <!-- Request Details Card -->
    <div class="bg-card-bg rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Request Details</h3>
                <div class="flex space-x-2">
                    <!-- Status Badge -->
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                        {{ $request->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                           ($request->status == 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                           ($request->status == 'resolved' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')) }}">
                        {{ $request->status_display }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Request ID</label>
                        <p class="text-sm text-gray-900">#{{ $request->id }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Student Name</label>
                        <p class="text-sm text-gray-900">{{ $request->student->full_name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Student Email</label>
                        <p class="text-sm text-gray-900">{{ $request->student->email }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Issue Type</label>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $request->issue_type == 'technical_issue' ? 'bg-red-100 text-red-800' : 
                               ($request->issue_type == 'content_issue' ? 'bg-yellow-100 text-yellow-800' : 
                               ($request->issue_type == 'evaluator_issue' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')) }}">
                            {{ $request->issue_type_display }}
                        </span>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Status</label>
                        <select class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary text-sm" 
                                onchange="updateStatus({{ $request->id }}, this.value)">
                            <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $request->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ $request->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="closed" {{ $request->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Created Date</label>
                        <p class="text-sm text-gray-900">{{ $request->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Updated</label>
                        <p class="text-sm text-gray-900">{{ $request->updated_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Time Since Created</label>
                        <p class="text-sm text-gray-900">{{ $request->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Description Card -->
    <div class="bg-card-bg rounded-lg shadow overflow-hidden mt-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Issue Description</h3>
        </div>
        <div class="p-6">
            <div class="prose max-w-none">
                <div class="bg-gray-50 rounded-lg p-4 border">
                    {{ $request->description }}
                </div>
            </div>
        </div>
    </div>

    <!-- Student Information Card -->
    <div class="bg-card-bg rounded-lg shadow overflow-hidden mt-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Student Information</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <p class="text-sm text-gray-900">{{ $request->student->full_name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-sm text-gray-900">{{ $request->student->email }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <p class="text-sm text-gray-900">{{ $request->student->phone ?? 'Not provided' }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Student ID</label>
                        <p class="text-sm text-gray-900">#{{ $request->student->id }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Registration Date</label>
                        <p class="text-sm text-gray-900">{{ $request->student->created_at->format('M d, Y') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Profile Status</label>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="bg-card-bg rounded-lg shadow overflow-hidden mt-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Actions</h3>
        </div>
        <div class="p-6">
            <div class="flex flex-wrap gap-3">
                <button onclick="markAsResolved({{ $request->id }})" 
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-check mr-2"></i>
                    Mark as Resolved
                </button>

                <button onclick="markAsInProgress({{ $request->id }})" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-clock mr-2"></i>
                    Mark as In Progress
                </button>

                <a href="mailto:{{ $request->student->email }}?subject=Re: Support Request #{{ $request->id }}" 
                   class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                    <i class="fas fa-envelope mr-2"></i>
                    Email Student
                </a>

                <button onclick="deleteRequest({{ $request->id }})" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-trash mr-2"></i>
                    Delete Request
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Update request status
function updateStatus(requestId, newStatus) {
    fetch(`/superadmin/support-requests/${requestId}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Status updated successfully', 'success');
            // Reload page to reflect changes
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            showAlert('Failed to update status', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('An error occurred', 'error');
    });
}

// Quick action functions
function markAsResolved(requestId) {
    updateStatus(requestId, 'resolved');
}

function markAsInProgress(requestId) {
    updateStatus(requestId, 'in_progress');
}

// Delete request
function deleteRequest(requestId) {
    if (confirm('Are you sure you want to delete this support request? This action cannot be undone.')) {
        fetch(`/superadmin/support-requests/${requestId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Request deleted successfully', 'success');
                setTimeout(() => {
                    window.location.href = '/superadmin/support-requests';
                }, 1000);
            } else {
                showAlert('Failed to delete request', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred', 'error');
        });
    }
}

// Show alert messages
function showAlert(message, type) {
    const alertClass = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
    const alertHtml = `
        <div class="alert ${alertClass} px-4 py-3 rounded mb-4 border" role="alert">
            ${message}
            <button type="button" class="float-right text-xl leading-none font-semibold" onclick="this.parentElement.remove()">
                &times;
            </button>
        </div>
    `;
    
    // Insert alert at the top of the content
    const content = document.querySelector('.max-w-4xl');
    content.insertAdjacentHTML('afterbegin', alertHtml);
    
    // Auto-dismiss after 3 seconds
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 3000);
}
</script>
@endpush
