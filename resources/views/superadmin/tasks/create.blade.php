@extends('superadmin.layout')

@section('title', 'Create New Task')
@section('page-title', 'Create New Task')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Create New Task</h2>
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

<form method="POST" action="{{ route('superadmin.tasks.store') }}" class="space-y-8">
    @csrf
    
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
                    <input type="text" name="task_title" id="task_title" value="{{ old('task_title') }}" 
                           required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('task_title') border-red-500 @enderror">
                    @error('task_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="task_description" class="block text-sm font-medium text-gray-700 mb-2">Task Description</label>
                    <textarea name="task_description" id="task_description" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('task_description') border-red-500 @enderror">{{ old('task_description') }}</textarea>
                    @error('task_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="task_instructions" class="block text-sm font-medium text-gray-700 mb-2">Task Instructions</label>
                    <textarea name="task_instructions" id="task_instructions" rows="6" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('task_instructions') border-red-500 @enderror">{{ old('task_instructions') }}</textarea>
                    @error('task_instructions')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="task_multimedia" class="block text-sm font-medium text-gray-700 mb-2">Multimedia URL</label>
                    <input type="url" name="task_multimedia" id="task_multimedia" value="{{ old('task_multimedia') }}" 
                           placeholder="https://youtube.com/watch?v=..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('task_multimedia') border-red-500 @enderror">
                    @error('task_multimedia')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" id="status" required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-orange-500 focus:border-orange-500 @error('status') border-red-500 @enderror">
                        <option value="">Select Status</option>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- AACE Framework Weights -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">AACE Framework Weights</h3>
            <p class="mt-1 text-sm text-gray-500">Set the weight (maximum points) for each sub-attribute in this task. Higher values mean the attribute is more important.</p>
        </div>
        <div class="px-6 py-6">
            @foreach($aaceFramework as $attributeTypeName => $attributeTypeData)
            <div class="mb-8 last:mb-0">
                <!-- Attribute Type Header -->
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4
                            @if($attributeTypeName == 'attitude') bg-red-500
                            @elseif($attributeTypeName == 'aptitude') bg-blue-500
                            @elseif($attributeTypeName == 'communication') bg-green-500
                            @elseif($attributeTypeName == 'execution') bg-purple-500
                            @endif">
                            {{ strtoupper(substr($attributeTypeData['display_name'], 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">{{ $attributeTypeData['display_name'] }}</h4>
                            <p class="text-sm text-gray-500">{{ count($attributeTypeData['sub_attributes']) }} sub-attributes</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Category Total</div>
                        <div class="text-2xl font-bold text-gray-900 category-total" data-category="{{ $attributeTypeName }}">
                            {{ count($attributeTypeData['sub_attributes']) * 8 }}
                        </div>
                        <div class="text-xs text-gray-400">points</div>
                    </div>
                </div>

                <!-- Sub-Attributes Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-4 bg-gray-50 rounded-lg">
                    @foreach($attributeTypeData['sub_attributes'] as $subAttribute)
                    <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow">
                        <label for="{{ $attributeTypeName }}_{{ $subAttribute['name'] }}" 
                               class="block text-sm font-semibold text-gray-700 mb-3">
                            {{ $subAttribute['display_name'] }}
                        </label>
                        <div class="flex items-center justify-center space-x-2">
                            <input type="number" 
                                   name="{{ $attributeTypeName }}_{{ $subAttribute['name'] }}" 
                                   id="{{ $attributeTypeName }}_{{ $subAttribute['name'] }}"
                                   min="0" max="50" step="1" 
                                   value="{{ old($attributeTypeName . '_' . $subAttribute['name'], 8) }}"
                                   data-category="{{ $attributeTypeName }}"
                                   class="w-20 h-12 text-center text-lg font-bold border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 
                                   @if($attributeTypeName == 'attitude') focus:ring-red-500 focus:border-red-500
                                   @elseif($attributeTypeName == 'aptitude') focus:ring-blue-500 focus:border-blue-500
                                   @elseif($attributeTypeName == 'communication') focus:ring-green-500 focus:border-green-500
                                   @elseif($attributeTypeName == 'execution') focus:ring-purple-500 focus:border-purple-500
                                   @endif">
                            <span class="text-sm font-medium text-gray-600">pts</span>
                        </div>
                        <div class="mt-2 text-center">
                            <span class="text-xs text-gray-500">Max points for this skill</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <!-- Summary Section -->
            <div class="mt-8 p-6 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg border border-orange-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900">Total Framework Points</h4>
                        <p class="text-sm text-gray-600">Maximum possible score for this task</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-orange-600" id="grand-total">
                            {{ array_sum(array_map(function($attr) { return count($attr['sub_attributes']) * 8; }, $aaceFramework)) }}
                        </div>
                        <div class="text-sm text-gray-500">total points</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="number"][data-category]');
        
        function updateTotals() {
            const categories = ['aptitude', 'attitude', 'communication', 'execution'];
            let grandTotal = 0;
            
            categories.forEach(category => {
                const categoryInputs = document.querySelectorAll(`input[data-category="${category}"]`);
                let categoryTotal = 0;
                
                categoryInputs.forEach(input => {
                    categoryTotal += parseInt(input.value) || 0;
                });
                
                const categoryTotalElement = document.querySelector(`.category-total[data-category="${category}"]`);
                if (categoryTotalElement) {
                    categoryTotalElement.textContent = categoryTotal;
                }
                
                grandTotal += categoryTotal;
            });
            
            const grandTotalElement = document.getElementById('grand-total');
            if (grandTotalElement) {
                grandTotalElement.textContent = grandTotal;
            }
        }
        
        inputs.forEach(input => {
            input.addEventListener('input', updateTotals);
        });
        
        // Initial calculation
        updateTotals();
    });
    </script>

    <!-- Form Actions -->
    <div class="flex justify-end space-x-4">
        <a href="{{ route('superadmin.tasks.index') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-md font-medium">
            Cancel
        </a>
        <button type="submit" 
                class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-md font-medium flex items-center">
            <i class="fas fa-save mr-2"></i>
            Create Task & Scoring Framework
        </button>
    </div>
</form>
@endsection
