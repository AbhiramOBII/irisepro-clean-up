@extends('superadmin.layout')

@section('title', 'Edit Batch')

@section('content')
<div class="mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Edit Batch</h3>
            <a href="{{ route('batches.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Batches
            </a>
        </div>
        <div class="p-6">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('batches.update', $batch->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                               id="title" name="title" value="{{ old('title', $batch->title) }}" required>
                    </div>

                    <div>
                        <label for="challenge_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Challenge <span class="text-red-500">*</span>
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                id="challenge_id" name="challenge_id" required>
                            <option value="">Select Challenge</option>
                            @foreach($challenges as $challenge)
                                <option value="{{ $challenge->id }}" {{ old('challenge_id', $batch->challenge_id) == $challenge->id ? 'selected' : '' }}>
                                    {{ $challenge->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                              id="description" name="description" rows="3">{{ old('description', $batch->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                    <div>
                        <label for="yashodarshi_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Yashodarshi <span class="text-red-500">*</span>
                        </label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                id="yashodarshi_id" name="yashodarshi_id" required>
                            <option value="">Select Yashodarshi</option>
                            @foreach($yashodarshis as $yashodarshi)
                                <option value="{{ $yashodarshi->id }}" {{ old('yashodarshi_id', $batch->yashodarshi_id) == $yashodarshi->id ? 'selected' : '' }}>
                                    {{ $yashodarshi->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Start Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                               id="start_date" name="start_date" value="{{ old('start_date', $batch->start_date->format('Y-m-d')) }}" required>
                    </div>

                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700 mb-2">
                            Time <span class="text-red-500">*</span>
                        </label>
                        <input type="time" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                               id="time" name="time" value="{{ old('time', $batch->time) }}" required>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                            id="status" name="status" required>
                        <option value="active" {{ old('status', $batch->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $batch->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Status will automatically change to "Ongoing" on start date and "Completed" after 60 days.</p>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Students</label>
                    <div class="mb-3">
                        <input type="text" 
                               id="student-search" 
                               placeholder="Search students by name or email..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div class="bg-gray-50 rounded-lg border border-gray-300 p-4" style="max-height: 400px; overflow-y: auto;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="students-grid">
                            @foreach($students as $student)
                                @php
                                    $isSelected = $batch->students->contains($student->id) || in_array($student->id, old('students', []));
                                    $isPaid = in_array($student->id, $paidStudentIds);
                                @endphp
                                <div class="student-item {{ $isPaid ? 'bg-green-50 border-green-200' : 'bg-white border-gray-200' }} p-3 rounded-md border" 
                                     data-name="{{ strtolower($student->full_name) }}" 
                                     data-email="{{ strtolower($student->email) }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input class="mr-3" type="checkbox" 
                                                   name="students[]" value="{{ $student->id }}" 
                                                   id="student_{{ $student->id }}"
                                                   {{ $isSelected ? 'checked' : '' }}
                                                   {{ $isPaid ? 'disabled' : '' }}>
                                            <label class="text-sm font-medium {{ $isPaid ? 'text-green-700' : 'text-gray-900' }}" for="student_{{ $student->id }}">
                                                {{ $student->full_name }}
                                                @if($isPaid)
                                                    <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        Paid
                                                    </span>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <div class="text-xs {{ $isPaid ? 'text-green-600' : 'text-gray-500' }} ml-6">{{ $student->email }}</div>
                                    @if($isPaid)
                                        <div class="text-xs text-green-600 ml-6 mt-1">
                                            <i class="fas fa-lock mr-1"></i>
                                            Cannot be removed - payment completed
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex space-x-4">
                    <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-md transition duration-200">
                        Update Batch
                    </button>
                    <a href="{{ route('batches.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md transition duration-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('student-search');
            const studentItems = document.querySelectorAll('.student-item');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();

                studentItems.forEach(function(item) {
                    const name = item.getAttribute('data-name');
                    const email = item.getAttribute('data-email');
                    
                    if (name.includes(searchTerm) || email.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
