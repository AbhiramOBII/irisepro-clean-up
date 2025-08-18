@extends('superadmin.layout')

@section('title', 'Enrollment Management')
@section('page-title', 'Enrollment Management')

@section('content')
<!-- Success/Error Messages -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Enrollments -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-plus text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Enrollments</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Enrollment::count() }}</p>
            </div>
        </div>
    </div>

    <!-- Paid Enrollments -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Paid Enrollments</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Enrollment::where('payment_status', 'paid')->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Unpaid Enrollments -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Unpaid Enrollments</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Enrollment::where('payment_status', 'unpaid')->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Today's Enrollments -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-day text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Today's Enrollments</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Enrollment::whereDate('created_at', today())->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Enrollments Table -->
<div class="bg-card-bg rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-list mr-2 text-primary"></i>
            All Enrollments
        </h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Student Details
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Challenge & Batch
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Contact Info
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Payment Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Enrolled Date
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($enrollments as $enrollment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-primary flex items-center justify-center">
                                        <span class="text-white font-medium text-sm">
                                            {{ strtoupper(substr($enrollment->full_name, 0, 2)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $enrollment->full_name }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ ucfirst($enrollment->gender) }} • 
                                        {{ \Carbon\Carbon::parse($enrollment->date_of_birth)->age }} years
                                    </div>
                                    @if($enrollment->educational_level)
                                        <div class="text-xs text-gray-400">{{ $enrollment->educational_level }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                <div class="font-medium">{{ $enrollment->challenge->title ?? 'N/A' }}</div>
                                <div class="text-gray-500">{{ $enrollment->batch->title ?? 'N/A' }}</div>
                                @if($enrollment->batch)
                                    <div class="text-xs text-gray-400">
                                        Starts: {{ \Carbon\Carbon::parse($enrollment->batch->start_date)->format('M d, Y') }}
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                <div class="flex items-center mb-1">
                                    <i class="fas fa-envelope text-gray-400 mr-2 text-xs"></i>
                                    {{ $enrollment->email_id }}
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-400 mr-2 text-xs"></i>
                                    {{ $enrollment->phone_number }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('superadmin.enrollments.payment', $enrollment->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="payment_status" onchange="this.form.submit()" 
                                    class="text-xs rounded-full px-3 py-1 font-semibold {{ $enrollment->payment_status == 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <option value="unpaid" {{ $enrollment->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    <option value="paid" {{ $enrollment->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $enrollment->created_at->format('M d, Y') }}
                            <div class="text-xs text-gray-400">{{ $enrollment->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('superadmin.enrollments.show', $enrollment->id) }}" 
                                   class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('superadmin.enrollments.destroy', $enrollment->id) }}" 
                                      method="POST" class="inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this enrollment?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-user-plus text-4xl text-gray-300 mb-4"></i>
                                <p class="text-lg font-medium">No enrollments found</p>
                                <p class="text-sm">Enrollments will appear here once students start enrolling.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($enrollments->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $enrollments->links() }}
        </div>
    @endif
</div>
@endsection
