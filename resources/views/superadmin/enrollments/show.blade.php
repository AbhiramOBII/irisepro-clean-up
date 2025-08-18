@extends('superadmin.layout')

@section('title', 'Enrollment Details')
@section('page-title', 'Enrollment Details')

@section('content')
<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('superadmin.enrollments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200">
        <i class="fas fa-arrow-left mr-2"></i>
        Back to Enrollments
    </a>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Student Information -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Personal Details -->
        <div class="bg-card-bg rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-user mr-2 text-primary"></i>
                    Personal Information
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Full Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $enrollment->full_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Email Address</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $enrollment->email_id }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Phone Number</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $enrollment->phone_number }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Date of Birth</label>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($enrollment->date_of_birth)->format('F d, Y') }}
                            <span class="text-gray-500">({{ \Carbon\Carbon::parse($enrollment->date_of_birth)->age }} years old)</span>
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Gender</label>
                        <p class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $enrollment->gender)) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Education Level</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $enrollment->educational_level ?: 'Not specified' }}</p>
                    </div>
                </div>
                
                @if($enrollment->goals)
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-500">Goals</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $enrollment->goals }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Challenge & Batch Details -->
        <div class="bg-card-bg rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-graduation-cap mr-2 text-primary"></i>
                    Challenge & Batch Information
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Challenge</label>
                        <p class="mt-1 text-sm text-gray-900 font-medium">{{ $enrollment->challenge->title ?? 'N/A' }}</p>
                        @if($enrollment->challenge && $enrollment->challenge->description)
                            <p class="mt-1 text-xs text-gray-600">{{ Str::limit($enrollment->challenge->description, 100) }}</p>
                        @endif
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Batch</label>
                        <p class="mt-1 text-sm text-gray-900 font-medium">{{ $enrollment->batch->title ?? 'N/A' }}</p>
                        @if($enrollment->batch)
                            <p class="mt-1 text-xs text-gray-600">
                                Starts: {{ \Carbon\Carbon::parse($enrollment->batch->start_date)->format('F d, Y') }}
                                at {{ \Carbon\Carbon::parse($enrollment->batch->time)->format('h:i A') }}
                            </p>
                        @endif
                    </div>
                </div>
                
                @if($enrollment->challenge)
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-tasks text-primary mr-2"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Total Tasks</p>
                                    <p class="text-lg font-semibold">{{ $enrollment->challenge->number_of_tasks ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-rupee-sign text-primary mr-2"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Price</p>
                                    <p class="text-lg font-semibold">
                                        ₹{{ number_format($enrollment->challenge->special_price ?: $enrollment->challenge->selling_price, 0) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-primary mr-2"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Duration</p>
                                    <p class="text-lg font-semibold">30 Days</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Enrollment Status & Actions -->
    <div class="space-y-6">
        <!-- Payment Status -->
        <div class="bg-card-bg rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-credit-card mr-2 text-primary"></i>
                    Payment Status
                </h3>
            </div>
            <div class="p-6">
                <form action="{{ route('superadmin.enrollments.payment', $enrollment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Status</label>
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $enrollment->payment_status == 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <i class="fas {{ $enrollment->payment_status == 'paid' ? 'fa-check-circle' : 'fa-exclamation-circle' }} mr-1"></i>
                                    {{ ucfirst($enrollment->payment_status) }}
                                </span>
                            </div>
                        </div>
                        
                        <div>
                            <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                            <select name="payment_status" id="payment_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="unpaid" {{ $enrollment->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="paid" {{ $enrollment->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="w-full bg-primary hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                            Update Payment Status
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Enrollment Details -->
        <div class="bg-card-bg rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-primary"></i>
                    Enrollment Details
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Enrollment ID</label>
                    <p class="mt-1 text-sm text-gray-900 font-mono">#{{ str_pad($enrollment->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Enrolled Date</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $enrollment->created_at->format('F d, Y h:i A') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Last Updated</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $enrollment->updated_at->format('F d, Y h:i A') }}</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-card-bg rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-cogs mr-2 text-primary"></i>
                    Actions
                </h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="mailto:{{ $enrollment->email_id }}" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200 flex items-center justify-center">
                    <i class="fas fa-envelope mr-2"></i>
                    Send Email
                </a>
                <a href="tel:{{ $enrollment->phone_number }}" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200 flex items-center justify-center">
                    <i class="fas fa-phone mr-2"></i>
                    Call Student
                </a>
                <form action="{{ route('superadmin.enrollments.destroy', $enrollment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enrollment? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition duration-200 flex items-center justify-center">
                        <i class="fas fa-trash mr-2"></i>
                        Delete Enrollment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
