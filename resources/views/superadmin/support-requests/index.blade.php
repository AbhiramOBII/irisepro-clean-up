@extends('superadmin.layout')

@section('title', 'Support Requests')
@section('page-title', 'Support Requests Management')

@section('content')
<!-- Filter Buttons -->
<div class="bg-card-bg rounded-lg shadow p-6 mb-6">
    <div class="flex flex-wrap gap-2">
        <button type="button" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition duration-200 text-sm font-medium" onclick="filterRequests('all')">
            All ({{ $helpRequests->total() }})
        </button>
        <button type="button" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-200 text-sm font-medium" onclick="filterRequests('pending')">
            Pending ({{ $helpRequests->where('status', 'pending')->count() }})
        </button>
        <button type="button" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 text-sm font-medium" onclick="filterRequests('in_progress')">
            In Progress ({{ $helpRequests->where('status', 'in_progress')->count() }})
        </button>
        <button type="button" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 text-sm font-medium" onclick="filterRequests('resolved')">
            Resolved ({{ $helpRequests->where('status', 'resolved')->count() }})
        </button>
    </div>
</div>

<!-- Support Requests Table -->
<div class="bg-card-bg rounded-lg shadow overflow-hidden">
    @if($helpRequests->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issue Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($helpRequests as $request)
                        <tr data-status="{{ $request->status }}" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $request->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $request->student->full_name }}</div>
                                <div class="text-sm text-gray-500">{{ $request->student->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $request->issue_type == 'technical_issue' ? 'bg-red-100 text-red-800' : 
                                       ($request->issue_type == 'content_issue' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($request->issue_type == 'evaluator_issue' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')) }}">
                                    {{ $request->issue_type_display }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs">
                                    {{ Str::limit($request->description, 100) }}
                                    @if(strlen($request->description) > 100)
                                        <button class="text-primary hover:text-primary-dark ml-1" onclick="showFullDescription({{ $request->id }})">
                                            Read more
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <select class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary text-sm" 
                                        data-request-id="{{ $request->id }}" onchange="updateStatus({{ $request->id }}, this.value)">
                                    <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ $request->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ $request->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="closed" {{ $request->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div>{{ $request->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $request->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('superadmin.support-requests.show', $request->id) }}" class="text-primary hover:text-primary-dark">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="text-red-600 hover:text-red-900" onclick="deleteRequest({{ $request->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white px-4 py-3 border-t border-gray-200">
            {{ $helpRequests->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No support requests found</h3>
            <p class="text-gray-500">Support requests from students will appear here.</p>
        </div>
    @endif
</div>

<!-- View Request Modal -->
<div id="viewRequestModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Support Request Details</h3>
            <button class="text-gray-400 hover:text-gray-600" onclick="closeModal('viewRequestModal')">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="requestDetails" class="mt-2">
            <!-- Request details will be loaded here -->
        </div>
        <div class="flex justify-end pt-4">
            <button class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600" onclick="closeModal('viewRequestModal')">
                Close
            </button>
        </div>
    </div>
</div>

<!-- Full Description Modal -->
<div id="descriptionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold text-gray-900">Full Description</h3>
            <button class="text-gray-400 hover:text-gray-600" onclick="closeModal('descriptionModal')">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="fullDescription" class="mt-2 p-4 bg-gray-50 rounded-lg">
            <!-- Full description will be loaded here -->
        </div>
        <div class="flex justify-end pt-4">
            <button class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600" onclick="closeModal('descriptionModal')">
                Close
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Filter requests by status
function filterRequests(status) {
    const rows = document.querySelectorAll('tbody tr[data-status]');
    
    rows.forEach(row => {
        if (status === 'all' || row.dataset.status === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update active button
    document.querySelectorAll('.flex.flex-wrap.gap-2 button').forEach(btn => {
        btn.classList.remove('bg-primary', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500');
        btn.classList.add('bg-gray-300', 'text-gray-700');
    });
    event.target.classList.remove('bg-gray-300', 'text-gray-700');
    
    // Add appropriate color based on status
    if (status === 'all') {
        event.target.classList.add('bg-primary', 'text-white');
    } else if (status === 'pending') {
        event.target.classList.add('bg-yellow-500', 'text-white');
    } else if (status === 'in_progress') {
        event.target.classList.add('bg-blue-500', 'text-white');
    } else if (status === 'resolved') {
        event.target.classList.add('bg-green-500', 'text-white');
    }
}

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
            // Update the row's data-status attribute
            const select = document.querySelector(`select[data-request-id="${requestId}"]`);
            const row = select.closest('tr');
            if (row) {
                row.setAttribute('data-status', newStatus);
            }
            
            // Show success message
            showAlert('Status updated successfully', 'success');
        } else {
            showAlert('Failed to update status', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('An error occurred', 'error');
    });
}

// View request details
function viewRequest(requestId) {
    fetch(`/superadmin/support-requests/${requestId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const request = data.request;
                const html = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <div><strong class="text-gray-700">Request ID:</strong> #${request.id}</div>
                            <div><strong class="text-gray-700">Student:</strong> ${request.student.full_name}</div>
                            <div><strong class="text-gray-700">Email:</strong> ${request.student.email}</div>
                            <div><strong class="text-gray-700">Issue Type:</strong> 
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    ${request.issue_type_display}
                                </span>
                            </div>
                            <div><strong class="text-gray-700">Status:</strong> 
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    ${request.status_display}
                                </span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div><strong class="text-gray-700">Created:</strong> ${new Date(request.created_at).toLocaleString()}</div>
                            <div><strong class="text-gray-700">Updated:</strong> ${new Date(request.updated_at).toLocaleString()}</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <strong class="text-gray-700">Description:</strong>
                        <div class="mt-2 p-4 bg-gray-50 rounded-lg border">
                            ${request.description}
                        </div>
                    </div>
                `;
                
                document.getElementById('requestDetails').innerHTML = html;
                document.getElementById('viewRequestModal').classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Failed to load request details', 'error');
        });
}

// Show full description
function showFullDescription(requestId) {
    fetch(`/superadmin/support-requests/${requestId}/details`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('fullDescription').innerHTML = data.request.description;
                document.getElementById('descriptionModal').classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Close modal
function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Delete request
function deleteRequest(requestId) {
    if (confirm('Are you sure you want to delete this support request?')) {
        fetch(`/superadmin/support-requests/${requestId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
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
    const content = document.querySelector('.bg-card-bg.rounded-lg.shadow.overflow-hidden');
    content.insertAdjacentHTML('beforebegin', alertHtml);
    
    // Auto-dismiss after 3 seconds
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 3000);
}

// Close modals when clicking outside
document.getElementById('viewRequestModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal('viewRequestModal');
    }
});

document.getElementById('descriptionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal('descriptionModal');
    }
});
</script>
@endpush
