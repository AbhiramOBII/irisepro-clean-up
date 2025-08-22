@extends('superadmin.layout')

@section('title', 'Edit Challenge')

@section('content')
<div class=mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Edit Challenge: {{ $challenge->title }}</h3>
            <a href="{{ route('challenges.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Challenges
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

            <form action="{{ route('challenges.update', $challenge->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Basic Information -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h5 class="text-md font-semibold text-gray-900">Basic Information</h5>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Challenge Title <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $challenge->title) }}" 
                                           required>
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Description <span class="text-red-500">*</span>
                                    </label>
                                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                              id="description" 
                                              name="description" 
                                              rows="4" 
                                              required>{{ old('description', $challenge->description) }}</textarea>
                                </div>

                                <div>
                                    <label for="features" class="block text-sm font-medium text-gray-700 mb-2">Features</label>
                                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                              id="features" 
                                              name="features" 
                                              rows="3">{{ old('features', $challenge->features) }}</textarea>
                                    <p class="text-sm text-gray-500 mt-1">List the key features of this challenge</p>
                                </div>

                                <div>
                                    <label for="who_is_this_for" class="block text-sm font-medium text-gray-700 mb-2">Who is this for?</label>
                                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                              id="who_is_this_for" 
                                              name="who_is_this_for" 
                                              rows="3">{{ old('who_is_this_for', $challenge->who_is_this_for) }}</textarea>
                                    <p class="text-sm text-gray-500 mt-1">Describe the target audience</p>
                                </div>
                            </div>
                        </div>

                        <!-- Task Selection -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h5 class="text-md font-semibold text-gray-900">Select Tasks</h5>
                                <p class="text-sm text-gray-500 mt-1">Select tasks and set their order in the challenge</p>
                            </div>
                            <div class="p-6">
                                <!-- Task Type Filter -->
                                <div class="mb-6">
                                    <label for="task_type_filter" class="block text-sm font-medium text-gray-700 mb-2">Filter by Task Type</label>
                                    <select id="task_type_filter" class="w-full md:w-64 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" onchange="filterTasksByType()">
                                        <option value="">All Task Types</option>
                                        <option value="CareerRise">CareerRise</option>
                                        <option value="Sankalp">Sankalp</option>
                                    </select>
                                </div>
                                @if($tasks->count() > 0)
                                    <div class="space-y-4">
                                        @php
                                            // Get selected tasks ordered by sorting_order
                                            $selectedTasks = $challenge->tasks->sortBy('pivot.sorting_order');
                                            $selectedTaskIds = $selectedTasks->pluck('id')->toArray();
                                            $unselectedTasks = $tasks->whereNotIn('id', $selectedTaskIds);
                                            
                                            // Combine selected tasks first (in order), then unselected tasks
                                            $orderedTasks = $selectedTasks->concat($unselectedTasks);
                                        @endphp
                                        @foreach($orderedTasks as $task)
                                            @php
                                                $isSelected = in_array($task->id, old('tasks', $challenge->tasks->pluck('id')->toArray()));
                                                $currentSortingOrder = old('sorting_order.' . $task->id, 
                                                    $challenge->tasks->where('id', $task->id)->first()?->pivot?->sorting_order ?? 0
                                                );
                                            @endphp
                                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 task-item" data-task-id="{{ $task->id }}" data-task-type="{{ $task->task_type }}">
                                                <div class="flex items-start space-x-3">
                                                    <input type="checkbox" 
                                                           class="mt-1 h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded task-checkbox" 
                                                           id="task_{{ $task->id }}" 
                                                           name="tasks[]" 
                                                           value="{{ $task->id }}" 
                                                           {{ $isSelected ? 'checked' : '' }}
                                                           onchange="toggleSortingOrder({{ $task->id }})">
                                                    <div class="flex-1">
                                                        <label for="task_{{ $task->id }}" class="cursor-pointer">
                                                            <div class="font-medium text-gray-900">{{ $task->task_title }}</div>
                                                            <div class="text-sm text-gray-500 mt-1">{{ Str::limit($task->task_description, 80) }}</div>
                                                        </label>
                                                        
                                                        <!-- Sorting Order Input -->
                                                        <div class="mt-3 sorting-order-input" id="sorting_order_{{ $task->id }}" style="display: {{ $isSelected ? 'block' : 'none' }};">
                                                            <label for="sorting_order_task_{{ $task->id }}" class="block text-sm font-medium text-gray-600 mb-1">
                                                                Sorting Order
                                                            </label>
                                                            <input type="number" 
                                                                   class="w-20 px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-primary focus:border-transparent" 
                                                                   id="sorting_order_task_{{ $task->id }}" 
                                                                   name="sorting_order[{{ $task->id }}]" 
                                                                   value="{{ $currentSortingOrder }}" 
                                                                   min="0" 
                                                                   step="1"
                                                                   placeholder="0">
                                                            <span class="text-xs text-gray-500 ml-2">Lower numbers appear first</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                                        <div class="text-blue-800">
                                            No tasks available. <a href="{{ route('superadmin.tasks.create') }}" class="underline hover:text-blue-900">Create a task first</a>.
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
                                <h5 class="text-md font-semibold text-gray-900">Thumbnail Image</h5>
                            </div>
                            <div class="p-6">
                                @if($challenge->thumbnail_image)
                                    <div class="mb-4">
                                        <img src="{{ asset($challenge->thumbnail_image) }}" alt="Current thumbnail" class="w-full max-w-xs rounded-md border border-gray-200">
                                        <p class="text-sm text-gray-500 mt-2">Current thumbnail</p>
                                    </div>
                                @endif
                                <input type="file" 
                                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary file:text-white hover:file:bg-primary-dark" 
                                       id="thumbnail_image" 
                                       name="thumbnail_image" 
                                       accept="image/*">
                                <p class="text-sm text-gray-500 mt-2">Upload a new thumbnail image (JPG, PNG, GIF) to replace current one</p>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h5 class="text-md font-semibold text-gray-900">Pricing</h5>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <label for="cost_price" class="block text-sm font-medium text-gray-700 mb-2">
                                        Cost Price <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">₹</span>
                                        </div>
                                        <input type="number" 
                                               class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                               id="cost_price" 
                                               name="cost_price" 
                                               value="{{ old('cost_price', $challenge->cost_price) }}" 
                                               step="0.01" 
                                               min="0" 
                                               required>
                                    </div>
                                </div>

                                <div>
                                    <label for="selling_price" class="block text-sm font-medium text-gray-700 mb-2">
                                        Selling Price <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">₹</span>
                                        </div>
                                        <input type="number" 
                                               class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                               id="selling_price" 
                                               name="selling_price" 
                                               value="{{ old('selling_price', $challenge->selling_price) }}" 
                                               step="0.01" 
                                               min="0" 
                                               required>
                                    </div>
                                </div>

                                <div>
                                    <label for="special_price" class="block text-sm font-medium text-gray-700 mb-2">Special Price</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">₹</span>
                                        </div>
                                        <input type="number" 
                                               class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                               id="special_price" 
                                               name="special_price" 
                                               value="{{ old('special_price', $challenge->special_price) }}" 
                                               step="0.01" 
                                               min="0">
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">Optional promotional price</p>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h5 class="text-md font-semibold text-gray-900">Status</h5>
                            </div>
                            <div class="p-6">
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                        id="status" 
                                        name="status" 
                                        required>
                                    <option value="draft" {{ old('status', $challenge->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="active" {{ old('status', $challenge->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $challenge->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="p-6 space-y-3">
                                <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md transition duration-200 font-medium">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Update Challenge
                                </button>
                                <a href="{{ route('challenges.index') }}" class="w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 font-medium text-center block">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview thumbnail image
    document.getElementById('thumbnail_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let preview = document.getElementById('thumbnail_preview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'thumbnail_preview';
                    preview.className = 'img-thumbnail mt-2';
                    preview.style.maxWidth = '200px';
                    preview.style.maxHeight = '200px';
                    document.getElementById('thumbnail_image').parentNode.appendChild(preview);
                }
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Auto-assign sorting order based on selection order
    let sortingOrderCounter = 1;
    
    // Initialize sorting order for already selected tasks (for old input)
    document.querySelectorAll('.task-checkbox:checked').forEach(function(checkbox) {
        const taskId = checkbox.value;
        const sortingInput = document.getElementById('sorting_order_task_' + taskId);
        if (sortingInput && sortingInput.value == '0') {
            sortingInput.value = sortingOrderCounter++;
        }
    });
});

// Toggle sorting order input visibility and auto-assign order
function toggleSortingOrder(taskId) {
    const checkbox = document.getElementById('task_' + taskId);
    const sortingOrderDiv = document.getElementById('sorting_order_' + taskId);
    const sortingInput = document.getElementById('sorting_order_task_' + taskId);
    
    if (checkbox.checked) {
        sortingOrderDiv.style.display = 'block';
        
        // Auto-assign next available sorting order if not already set
        if (!sortingInput.value || sortingInput.value == '0') {
            const existingOrders = Array.from(document.querySelectorAll('input[name^="sorting_order"]'))
                .map(input => parseInt(input.value) || 0)
                .filter(val => val > 0);
            
            const nextOrder = existingOrders.length > 0 ? Math.max(...existingOrders) + 1 : 1;
            sortingInput.value = nextOrder;
        }
    } else {
        sortingOrderDiv.style.display = 'none';
        sortingInput.value = '0';
    }
}

// Filter tasks by task type
function filterTasksByType() {
    const selectedType = document.getElementById('task_type_filter').value;
    const taskItems = document.querySelectorAll('.task-item');
    
    taskItems.forEach(function(taskItem) {
        const taskType = taskItem.getAttribute('data-task-type');
        
        if (selectedType === '' || taskType === selectedType) {
            taskItem.style.display = 'block';
        } else {
            taskItem.style.display = 'none';
            
            // Uncheck hidden tasks and hide their sorting order
            const checkbox = taskItem.querySelector('.task-checkbox');
            if (checkbox && checkbox.checked) {
                checkbox.checked = false;
                const taskId = checkbox.value;
                const sortingOrderDiv = document.getElementById('sorting_order_' + taskId);
                const sortingInput = document.getElementById('sorting_order_task_' + taskId);
                if (sortingOrderDiv) sortingOrderDiv.style.display = 'none';
                if (sortingInput) sortingInput.value = '0';
            }
        }
    });
}
</script>
@endsection
