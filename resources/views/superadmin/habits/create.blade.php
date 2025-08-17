@extends('superadmin.layout')

@section('title', 'Create Habit')
@section('page-title', 'Create New Habit')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center mb-6">
        <a href="{{ route('habits.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-800">Create New Habit</h2>
    </div>

    <form action="{{ route('habits.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Title <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-red-500 @enderror"
                       placeholder="Enter habit title"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" 
                        name="status" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('status') border-red-500 @enderror"
                        required>
                    <option value="">Select Status</option>
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Icon -->
        <div>
            <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                Icon
            </label>
            <div class="relative">
                <select id="icon" 
                        name="icon" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('icon') border-red-500 @enderror"
                        onchange="updateIconPreview()">
                    <option value="">Select an icon</option>
                    <option value="fas fa-heart" {{ old('icon') === 'fas fa-heart' ? 'selected' : '' }}>❤️ Heart</option>
                    <option value="fas fa-star" {{ old('icon') === 'fas fa-star' ? 'selected' : '' }}>⭐ Star</option>
                    <option value="fas fa-check-circle" {{ old('icon') === 'fas fa-check-circle' ? 'selected' : '' }}>✅ Check Circle</option>
                    <option value="fas fa-trophy" {{ old('icon') === 'fas fa-trophy' ? 'selected' : '' }}>🏆 Trophy</option>
                    <option value="fas fa-fire" {{ old('icon') === 'fas fa-fire' ? 'selected' : '' }}>🔥 Fire</option>
                    <option value="fas fa-dumbbell" {{ old('icon') === 'fas fa-dumbbell' ? 'selected' : '' }}>🏋️ Dumbbell</option>
                    <option value="fas fa-book" {{ old('icon') === 'fas fa-book' ? 'selected' : '' }}>📚 Book</option>
                    <option value="fas fa-apple-alt" {{ old('icon') === 'fas fa-apple-alt' ? 'selected' : '' }}>🍎 Apple</option>
                    <option value="fas fa-bed" {{ old('icon') === 'fas fa-bed' ? 'selected' : '' }}>🛏️ Bed</option>
                    <option value="fas fa-running" {{ old('icon') === 'fas fa-running' ? 'selected' : '' }}>🏃 Running</option>
                    <option value="fas fa-water" {{ old('icon') === 'fas fa-water' ? 'selected' : '' }}>💧 Water</option>
                    <option value="fas fa-meditation" {{ old('icon') === 'fas fa-meditation' ? 'selected' : '' }}>🧘 Meditation</option>
                    <option value="fas fa-clock" {{ old('icon') === 'fas fa-clock' ? 'selected' : '' }}>⏰ Clock</option>
                    <option value="fas fa-calendar-check" {{ old('icon') === 'fas fa-calendar-check' ? 'selected' : '' }}>📅 Calendar</option>
                    <option value="fas fa-lightbulb" {{ old('icon') === 'fas fa-lightbulb' ? 'selected' : '' }}>💡 Lightbulb</option>
                </select>
                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                    <i id="icon-preview" class="{{ old('icon') ?? 'fas fa-question' }} text-gray-400"></i>
                </div>
            </div>
            @error('icon')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <script>
            function updateIconPreview() {
                const select = document.getElementById('icon');
                const preview = document.getElementById('icon-preview');
                const selectedValue = select.value;
                
                if (selectedValue) {
                    preview.className = selectedValue + ' text-primary';
                } else {
                    preview.className = 'fas fa-question text-gray-400';
                }
            }
            
            // Initialize preview on page load
            document.addEventListener('DOMContentLoaded', function() {
                updateIconPreview();
            });
        </script>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                Description
            </label>
            <textarea id="description" 
                      name="description" 
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror"
                      placeholder="Enter habit description">{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('habits.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                Cancel
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-primary hover:bg-primary-dark text-white rounded-md transition duration-200">
                Create Habit
            </button>
        </div>
    </form>
</div>
@endsection
