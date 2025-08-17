@extends('superadmin.layout')

@section('title', 'View Habit')
@section('page-title', 'Habit Details')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <a href="{{ route('habits.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">{{ $habit->title }}</h2>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('habits.edit', $habit) }}" 
               class="bg-accent hover:bg-accent-dark text-white px-4 py-2 rounded-md transition duration-200">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
            <form action="{{ route('habits.destroy', $habit) }}" method="POST" class="inline" 
                  onsubmit="return confirm('Are you sure you want to delete this habit?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Habit Details -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $habit->title }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                    {{ $habit->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ ucfirst($habit->status) }}
                </span>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
                <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $habit->icon ?? 'No icon set' }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Created At</label>
                <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $habit->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Last Updated</label>
                <p class="text-gray-900 bg-gray-50 px-3 py-2 rounded-md">{{ $habit->updated_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <div class="bg-gray-50 px-3 py-2 rounded-md min-h-[100px]">
                @if($habit->description)
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $habit->description }}</p>
                @else
                    <p class="text-gray-500 italic">No description provided</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Associated Students -->
    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Associated Students</h3>
        @if($habit->students->count() > 0)
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($habit->students as $student)
                        <div class="bg-white p-3 rounded-md shadow-sm">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $student->full_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $student->email }}</p>
                                    @if($student->pivot->datestamp)
                                        <p class="text-xs text-gray-400 mt-1">
                                            Added: {{ \Carbon\Carbon::parse($student->pivot->datestamp)->format('M d, Y') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                <h4 class="mt-2 text-sm font-medium text-gray-900">No students associated</h4>
                <p class="mt-1 text-sm text-gray-500">This habit is not currently associated with any students.</p>
            </div>
        @endif
    </div>
</div>
@endsection
