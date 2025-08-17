@extends('superadmin.layout')

@section('title', 'Batch Details')

@section('content')
<div class="mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Batch Details</h3>
            <div class="flex space-x-2">
                <a href="{{ route('batches.edit', $batch->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('batches.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">Basic Information</h4>
                    <div class="space-y-3">
                        <div class="flex">
                            <span class="w-24 text-sm font-medium text-gray-600">ID:</span>
                            <span class="text-sm text-gray-900">{{ $batch->id }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-24 text-sm font-medium text-gray-600">Title:</span>
                            <span class="text-sm text-gray-900">{{ $batch->title }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-24 text-sm font-medium text-gray-600">Challenge:</span>
                            <span class="text-sm text-gray-900">{{ $batch->challenge->title ?? 'N/A' }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-24 text-sm font-medium text-gray-600">Yashodarshi:</span>
                            <div class="flex-1">
                                @if($batch->yashodarshi)
                                    <div class="text-sm text-gray-900 font-medium">{{ $batch->yashodarshi->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $batch->yashodarshi->email }}</div>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full mt-1 
                                        {{ $batch->yashodarshi->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($batch->yashodarshi->status) }}
                                    </span>
                                @else
                                    <span class="text-sm text-gray-500">Not Assigned</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex">
                            <span class="w-24 text-sm font-medium text-gray-600">Start Date:</span>
                            <span class="text-sm text-gray-900">{{ $batch->start_date->format('Y-m-d') }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-24 text-sm font-medium text-gray-600">Time:</span>
                            <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($batch->time)->format('H:i') }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-24 text-sm font-medium text-gray-600">Status:</span>
                            <span>
                                @if($batch->calculated_status == 'active')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @elseif($batch->calculated_status == 'ongoing')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Ongoing</span>
                                @elseif($batch->calculated_status == 'completed')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                                @endif
                            </span>
                        </div>
                        <div class="flex">
                            <span class="w-24 text-sm font-medium text-gray-600">Created:</span>
                            <span class="text-sm text-gray-900">{{ $batch->created_at->format('Y-m-d H:i:s') }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-24 text-sm font-medium text-gray-600">Updated:</span>
                            <span class="text-sm text-gray-900">{{ $batch->updated_at->format('Y-m-d H:i:s') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">Description</h4>
                    <p class="text-sm text-gray-700">{{ $batch->description ?: 'No description provided.' }}</p>
                </div>
            </div>

            <div class="mt-8">
                <h4 class="text-md font-semibold text-gray-900 mb-4">Enrolled Students ({{ $batch->students->count() }})</h4>
                
                @if($batch->students->count() > 0)
                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-blue-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-blue-600">{{ $batch->students->count() }}</div>
                            <div class="text-sm text-blue-600">Total Students</div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-green-600">₹{{ number_format($batch->students->sum('pivot.amount'), 2) }}</div>
                            <div class="text-sm text-green-600">Total Amount</div>
                        </div>
                        <div class="bg-emerald-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-emerald-600">{{ $batch->students->where('pivot.payment_status', 'paid')->count() }}</div>
                            <div class="text-sm text-emerald-600">Paid Students</div>
                        </div>
                        <div class="bg-orange-50 rounded-lg p-4 text-center">
                            <div class="text-2xl font-bold text-orange-600">{{ $batch->students->where('pivot.payment_status', 'unpaid')->count() }}</div>
                            <div class="text-sm text-orange-600">Unpaid Students</div>
                        </div>
                    </div>

                    <!-- Students Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Time</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Comments</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrolled At</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($batch->students as $student)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $student->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₹{{ number_format($student->pivot->amount, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($student->pivot->payment_status == 'paid')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Unpaid</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $student->pivot->payment_time ? \Carbon\Carbon::parse($student->pivot->payment_time)->format('Y-m-d H:i:s') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->pivot->payment_comments ?: 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->pivot->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button onclick="openPaymentModal({{ $batch->id }}, {{ $student->id }}, '{{ $student->name }}', {{ $student->pivot->amount }}, '{{ $student->pivot->payment_status }}', '{{ $student->pivot->payment_comments }}')" 
                                                    class="text-indigo-600 hover:text-indigo-900">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit Payment
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                        <svg class="w-12 h-12 text-blue-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-blue-600 font-medium">No students enrolled in this batch yet.</p>
                        <p class="text-blue-500 text-sm mt-1">Students can be added by editing this batch.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Update Payment Information</h3>
            <form id="paymentForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4" hidden>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Student</label>
                    <input type="text" id="studentName" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100" readonly>
                </div>
                
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount (₹)</label>
                    <input type="number" step="0.01" id="amount" name="amount" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" required>
                </div>
                
                <div class="mb-4">
                    <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">Payment Status</label>
                    <select id="payment_status" name="payment_status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" required>
                        <option value="unpaid">Unpaid</option>
                        <option value="paid">Paid</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="payment_comments" class="block text-sm font-medium text-gray-700 mb-2">Payment Comments</label>
                    <textarea id="payment_comments" name="payment_comments" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closePaymentModal()" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">Update Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openPaymentModal(batchId, studentId, studentName, amount, paymentStatus, paymentComments) {
    document.getElementById('studentName').value = studentName;
    document.getElementById('amount').value = amount;
    document.getElementById('payment_status').value = paymentStatus;
    document.getElementById('payment_comments').value = paymentComments || '';
    
    const form = document.getElementById('paymentForm');
    form.action = `/superadmin/batches/${batchId}/students/${studentId}/payment`;
    
    document.getElementById('paymentModal').classList.remove('hidden');
}

function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('paymentModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePaymentModal();
    }
});
</script>

@endsection
