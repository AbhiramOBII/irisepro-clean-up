@extends('superadmin.layout')

@section('title', 'Edit Task')
@section('page-title', 'Edit Task')

@push('styles')
<style>
    .ck-editor__editable {
        min-height: 200px;
    }
</style>
@endpush

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Edit Task</h2>
    <a href="{{ route('superadmin.tasks.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md font-medium transition duration-200">
        Back to Tasks
    </a>
</div>

@if($errors->any())
    <div class="bg-red-600 text-white px-4 py-3 rounded mb-4">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('superadmin.tasks.update', $task) }}" class="space-y-8">
    @csrf
    @method('PUT')
    
    <!-- Task Information -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Task Information</h3>
            <p class="mt-1 text-sm text-gray-500">Basic information about the task.</p>
        </div>
        <div class="px-6 py-4 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="task_title" class="block text-sm font-medium text-gray-700 mb-2">Task Title *</label>
                    <input type="text" name="task_title" id="task_title" value="{{ old('task_title', $task->task_title) }}" 
                           required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('task_title') border-red-500 @enderror">
                    @error('task_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="task_description" class="block text-sm font-medium text-gray-700 mb-2">Task Description</label>
                    <textarea name="task_description" id="task_description" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('task_description') border-red-500 @enderror">{{ old('task_description', $task->task_description) }}</textarea>
                    @error('task_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="task_instructions" class="block text-sm font-medium text-gray-700 mb-2">Task Instructions</label>
                    <textarea name="task_instructions" id="task_instructions" rows="6" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('task_instructions') border-red-500 @enderror">{{ old('task_instructions', $task->task_instructions) }}</textarea>
                    @error('task_instructions')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="task_multimedia" class="block text-sm font-medium text-gray-700 mb-2">Multimedia URL</label>
                    <input type="url" name="task_multimedia" id="task_multimedia" value="{{ old('task_multimedia', $task->task_multimedia) }}" 
                           placeholder="https://youtube.com/watch?v=..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('task_multimedia') border-red-500 @enderror">
                    @error('task_multimedia')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="task_type" class="block text-sm font-medium text-gray-700 mb-2">Task Type *</label>
                    <select name="task_type" id="task_type" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('task_type') border-red-500 @enderror">
                        <option value="">Select Task Type</option>
                        <option value="CareerRise" {{ old('task_type', $task->task_type) == 'CareerRise' ? 'selected' : '' }}>CareerRise</option>
                        <option value="Sankalp" {{ old('task_type', $task->task_type) == 'Sankalp' ? 'selected' : '' }}>Sankalp</option>
                    </select>
                    @error('task_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" id="status" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('status') border-red-500 @enderror">
                        <option value="">Select Status</option>
                        <option value="active" {{ old('status', $task->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $task->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- AACE Framework Scores -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">AACE Framework Weights</h3>
            <p class="mt-1 text-sm text-gray-500">Set the weight (maximum points) for each sub-attribute in this task. Higher values mean the attribute is more important.</p>
        </div>
        <div class="px-6 py-6">
            @foreach($aaceFramework as $attributeTypeName => $attributeTypeData)
            <div class="mb-8 last:mb-0">
                <!-- Attribute Type Header -->
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3
                        @if($attributeTypeName == 'attitude') bg-red-500
                        @elseif($attributeTypeName == 'aptitude') bg-blue-500
                        @elseif($attributeTypeName == 'communication') bg-green-500
                        @elseif($attributeTypeName == 'execution') bg-purple-500
                        @endif">
                        {{ strtoupper(substr($attributeTypeData['display_name'], 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">{{ $attributeTypeData['display_name'] }}</h4>
                        <p class="text-sm text-gray-500">{{ count($attributeTypeData['sub_attributes']) }} sub-attributes</p>
                    </div>
                </div>

                <!-- Sub-Attributes Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 ml-11">
                    @foreach($attributeTypeData['sub_attributes'] as $subAttribute)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label for="{{ $attributeTypeName }}_{{ $subAttribute['name'] }}" 
                               class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $subAttribute['display_name'] }}
                        </label>
                        <div class="flex items-center space-x-2">
                            <input type="number" 
                                   name="{{ $attributeTypeName }}_{{ $subAttribute['name'] }}" 
                                   id="{{ $attributeTypeName }}_{{ $subAttribute['name'] }}"
                                   min="0" max="5" step="1" 
                                   value="{{ old($attributeTypeName . '_' . $subAttribute['name'], isset($existingScores[$attributeTypeName][$subAttribute['name']]) ? $existingScores[$attributeTypeName][$subAttribute['name']] : 5) }}"
                                   class="w-24 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 text-center">
                            <span class="text-sm text-gray-500">points</span>
                        </div>
                        <div class="mt-1 text-xs text-gray-400">Weight for this sub-attribute</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Form Actions -->
    <div class="flex justify-end space-x-4">
        <a href="{{ route('superadmin.tasks.index') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-md font-medium">
            Cancel
        </a>
        <button type="submit" 
                class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-md font-medium flex items-center">
            <i class="fas fa-save mr-2"></i>
            Update Task
        </button>
    </div>
</form>
@endsection
