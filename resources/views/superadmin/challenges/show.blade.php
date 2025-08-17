@extends('superadmin.layout')

@section('title', 'Challenge Details')

@section('content')
<div class=" mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Challenge Details</h3>
            <div class="flex space-x-3">
                <a href="{{ route('challenges.edit', $challenge->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('challenges.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Challenges
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h5 class="text-lg font-semibold text-gray-900">{{ $challenge->title }}</h5>
                                @if($challenge->status == 'active')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @elseif($challenge->status == 'inactive')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Draft</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-6 space-y-6">
                            <div>
                                <h6 class="text-sm font-semibold text-gray-900 mb-2">Description</h6>
                                <p class="text-gray-700">{{ $challenge->description }}</p>
                            </div>

                            @if($challenge->features)
                                <div>
                                    <h6 class="text-sm font-semibold text-gray-900 mb-2">Features</h6>
                                    <p class="text-gray-700">{{ $challenge->features }}</p>
                                </div>
                            @endif

                            @if($challenge->who_is_this_for)
                                <div>
                                    <h6 class="text-sm font-semibold text-gray-900 mb-2">Who is this for?</h6>
                                    <p class="text-gray-700">{{ $challenge->who_is_this_for }}</p>
                                </div>
                            @endif

                            <div>
                                <h6 class="text-sm font-semibold text-gray-900 mb-4">Pricing Information</h6>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="bg-blue-50 rounded-lg p-4 text-center">
                                        <div class="text-sm font-medium text-gray-600">Cost Price</div>
                                        <div class="text-2xl font-bold text-blue-600">₹{{ number_format($challenge->cost_price, 2) }}</div>
                                    </div>
                                    <div class="bg-green-50 rounded-lg p-4 text-center">
                                        <div class="text-sm font-medium text-gray-600">Selling Price</div>
                                        <div class="text-2xl font-bold text-green-600">₹{{ number_format($challenge->selling_price, 2) }}</div>
                                    </div>
                                    @if($challenge->special_price)
                                        <div class="bg-red-50 rounded-lg p-4 text-center">
                                            <div class="text-sm font-medium text-gray-600">Special Price</div>
                                            <div class="text-2xl font-bold text-red-600">₹{{ number_format($challenge->special_price, 2) }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <h6 class="text-sm font-semibold text-gray-900 mb-4">Challenge Information</h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium text-gray-600">Total Tasks:</span>
                                            <span class="text-sm text-gray-900">{{ $challenge->tasks->count() }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium text-gray-600">Created:</span>
                                            <span class="text-sm text-gray-900">{{ $challenge->created_at->format('M d, Y h:i A') }}</span>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium text-gray-600">Last Updated:</span>
                                            <span class="text-sm text-gray-900">{{ $challenge->updated_at->format('M d, Y h:i A') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium text-gray-600">Date Stamp:</span>
                                            <span class="text-sm text-gray-900">{{ $challenge->datestamp->format('M d, Y h:i A') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Associated Tasks -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-md font-semibold text-gray-900">Associated Tasks ({{ $challenge->tasks->count() }})</h5>
                        </div>
                        <div class="p-6">
                            @if($challenge->tasks->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task Title</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($challenge->tasks as $task)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $task->id }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $task->task_title }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($task->task_description, 100) }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($task->status == 'active')
                                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                                        @else
                                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($task->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <div class="flex space-x-2">
                                                            <a href="{{ route('superadmin.tasks.show', $task->id) }}" class="text-blue-600 hover:text-blue-900" title="View Task">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                </svg>
                                                            </a>
                                                            <a href="{{ route('superadmin.tasks.edit', $task->id) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit Task">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                                    <div class="flex">
                                        <svg class="w-5 h-5 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div class="text-blue-800">
                                            No tasks are associated with this challenge yet.
                                            <a href="{{ route('challenges.edit', $challenge->id) }}" class="underline hover:text-blue-900">Edit the challenge</a> to add tasks.
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Thumbnail -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-md font-semibold text-gray-900">Thumbnail</h5>
                        </div>
                        <div class="p-6 text-center">
                            @if($challenge->thumbnail_image)
                                <img src="{{ asset($challenge->thumbnail_image) }}" alt="Challenge Thumbnail" class="w-full rounded-lg">
                            @else
                                <div class="text-gray-400">
                                    <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p>No thumbnail image</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-md font-semibold text-gray-900">Quick Stats</h5>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-600">Status:</span>
                                @if($challenge->status == 'active')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @elseif($challenge->status == 'inactive')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Draft</span>
                                @endif
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-600">Total Tasks:</span>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $challenge->tasks->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-600">Selling Price:</span>
                                <span class="text-sm font-bold text-green-600">₹{{ number_format($challenge->selling_price, 2) }}</span>
                            </div>
                            @if($challenge->special_price)
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-600">Special Price:</span>
                                    <span class="text-sm font-bold text-red-600">₹{{ number_format($challenge->special_price, 2) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-md font-semibold text-gray-900">Actions</h5>
                        </div>
                        <div class="p-6 space-y-3">
                            <a href="{{ route('challenges.edit', $challenge->id) }}" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition duration-200 font-medium text-center block">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Challenge
                            </a>
                            <form action="{{ route('challenges.destroy', $challenge->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this challenge? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-200 font-medium">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete Challenge
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
