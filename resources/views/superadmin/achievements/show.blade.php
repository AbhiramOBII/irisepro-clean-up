@extends('superadmin.layout')

@section('title', 'Achievement Details')

@section('page-title', 'Achievement Details')

@section('content')
<div class="mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Achievement: {{ $achievement->title }}</h3>
            <div class="flex space-x-2">
                <a href="{{ route('achievements.edit', $achievement->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Achievement
                </a>
                <a href="{{ route('achievements.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Achievements
                </a>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Achievement Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Title</label>
                                <p class="text-sm text-gray-900 font-medium">{{ $achievement->title }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Domain</label>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($achievement->domain == 'attitude') bg-purple-100 text-purple-800
                                    @elseif($achievement->domain == 'aptitude') bg-blue-100 text-blue-800
                                    @elseif($achievement->domain == 'communication') bg-green-100 text-green-800
                                    @elseif($achievement->domain == 'execution') bg-orange-100 text-orange-800
                                    @elseif($achievement->domain == 'aace') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($achievement->domain) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Threshold</label>
                                <p class="text-sm text-gray-900 font-medium">{{ $achievement->threshold }} points</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Achievement ID</label>
                                <p class="text-sm text-gray-900 font-medium">#{{ $achievement->id }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-blue-600">{{ $achievement->students()->count() }}</div>
                                <div class="text-sm text-gray-600">Students Unlocked</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-green-600">{{ $achievement->created_at->format('M Y') }}</div>
                                <div class="text-sm text-gray-600">Created</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-purple-600">{{ $achievement->updated_at->diffForHumans() }}</div>
                                <div class="text-sm text-gray-600">Last Updated</div>
                            </div>
                        </div>
                    </div>

                    <!-- Students Who Unlocked This Achievement -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Students Who Unlocked This Achievement</h4>
                        @if($achievement->students()->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unlocked At</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($achievement->students()->take(10)->get() as $student)
                                            <tr>
                                                <td class="px-4 py-2 text-sm font-medium text-gray-900">{{ $student->student_fullname }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-600">{{ $student->student_email }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-600">
                                                    {{ $student->pivot->unlocked_at ? \Carbon\Carbon::parse($student->pivot->unlocked_at)->format('M d, Y H:i') : 'N/A' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if($achievement->students()->count() > 10)
                                    <div class="mt-4 text-center">
                                        <p class="text-sm text-gray-600">Showing 10 of {{ $achievement->students()->count() }} students</p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <p class="text-gray-600">No students have unlocked this achievement yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Achievement Image and Actions -->
                <div class="space-y-6">
                    <!-- Achievement Image -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Achievement Image</h4>
                        @if($achievement->image)
                            <div class="text-center">
                                <img src="{{ asset($achievement->image) }}" alt="{{ $achievement->title }}" class="w-full max-w-xs mx-auto rounded-lg shadow-md">
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-600">No image uploaded</p>
                            </div>
                        @endif
                    </div>

                    <!-- Domain Information -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-blue-900 mb-2">Domain: {{ ucfirst($achievement->domain) }}</h4>
                        <div class="text-xs text-blue-800">
                            @if($achievement->domain == 'attitude')
                                <p>Focuses on personal mindset, behavior, and character development.</p>
                            @elseif($achievement->domain == 'aptitude')
                                <p>Recognizes natural ability, talent, and intellectual capacity.</p>
                            @elseif($achievement->domain == 'communication')
                                <p>Celebrates expression, interaction, and interpersonal skills.</p>
                            @elseif($achievement->domain == 'execution')
                                <p>Honors implementation, delivery, and task completion abilities.</p>
                            @elseif($achievement->domain == 'aace')
                                <p>Comprehensive achievement covering Attitude, Aptitude, Communication, and Execution.</p>
                            @else
                                <p>Recognizes guidance, management, and leadership capabilities.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h4>
                        <div class="space-y-3">
                            <a href="{{ route('achievements.edit', $achievement->id) }}" 
                               class="w-full flex items-center justify-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md transition duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Achievement
                            </a>
                            <form action="{{ route('achievements.destroy', $achievement->id) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this achievement? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full flex items-center justify-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md transition duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete Achievement
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Timestamps -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Timestamps</h4>
                        <div class="space-y-2 text-xs text-gray-600">
                            <div>
                                <span class="font-medium">Created:</span>
                                {{ $achievement->created_at->format('M d, Y H:i') }}
                            </div>
                            <div>
                                <span class="font-medium">Updated:</span>
                                {{ $achievement->updated_at->format('M d, Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
