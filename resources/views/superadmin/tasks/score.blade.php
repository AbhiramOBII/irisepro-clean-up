@extends('superadmin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="flex justify-between items-center p-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800">Task Details</h3>
                    <div class="flex space-x-3">
                        <a href="{{ route('superadmin.tasks.edit', $task) }}" 
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Task
                        </a>
                        <a href="{{ route('superadmin.tasks.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Tasks
                        </a>
                    </div>
                </div>
                <form action="{{ route('superadmin.task-scores.store') }}" method="POST" id="scoreForm">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    
                    <div class="p-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900"><strong>Task:</strong> {{ $task->task_title }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-gray-700 mb-2">Task Description</h4>
                                    <p class="text-gray-600">{{ $task->task_description }}</p>
                                </div>
                                
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold text-gray-700 mb-2">Created Date</h4>
                                    <p class="text-gray-600">{{ $task->created_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                            
                            @if($task->task_instructions)
                            <div class="bg-blue-50 p-4 rounded-lg mt-4">
                                <h4 class="font-semibold text-blue-700 mb-2">Task Instructions</h4>
                                <div class="text-blue-600">{{ $task->task_instructions }}</div>
                            </div>
                            @endif
                            
                            @if($task->task_multimedia && is_array($task->task_multimedia) && count($task->task_multimedia) > 0)
                            <div class="bg-purple-50 p-4 rounded-lg mt-4">
                                <h4 class="font-semibold text-purple-700 mb-2">Multimedia Files</h4>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    @foreach($task->task_multimedia as $media)
                                        <div class="bg-white p-3 rounded border border-purple-200">
                                            <div class="text-xs text-purple-600 font-medium truncate">{{ basename($media) }}</div>
                                            <a href="{{ asset('storage/' . $media) }}" target="_blank" 
                                               class="text-purple-500 hover:text-purple-700 text-xs">View File</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
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

                        <!-- AAEC Framework Scoring -->
                        @foreach($attributes as $attribute)
                            <div class="mb-8">
                                <div class="bg-{{ $attribute->name == 'Attitude' ? 'red' : ($attribute->name == 'Aptitude' ? 'blue' : ($attribute->name == 'Communication' ? 'green' : 'purple')) }}-600 text-white px-4 py-3 rounded-t-lg">
                                    <h3 class="text-lg font-semibold flex items-center">
                                        <span class="w-8 h-8 bg-{{ $attribute->name == 'Attitude' ? 'red' : ($attribute->name == 'Aptitude' ? 'blue' : ($attribute->name == 'Communication' ? 'green' : 'purple')) }}-700 rounded-full flex items-center justify-center text-sm font-bold mr-3">
                                            {{ substr($attribute->name, 0, 1) }}
                                        </span>
                                        {{ $attribute->name }}
                                    </h3>
                                    <p class="text-sm mt-1">{{ count($attribute->subAttributes) }} sub-attributes</p>
                                </div>
                                
                                <div class="bg-white border border-gray-200 rounded-b-lg p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                        @foreach($attribute->subAttributes as $subAttribute)
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                                    {{ ucwords(str_replace('_', ' ', $subAttribute->subattribute_name)) }}
                                                </label>
                                                
                                                <div class="flex items-center justify-center">
                                                    <input type="number" 
                                                           id="{{ strtolower($attribute->name) }}_{{ str_replace(' ', '_', strtolower($subAttribute->subattribute_name)) }}"
                                                           name="{{ strtolower($attribute->name) }}_{{ str_replace(' ', '_', strtolower($subAttribute->subattribute_name)) }}"
                                                           min="0" 
                                                           max="{{ isset($taskWeights[strtolower($attribute->name)][str_replace(' ', '_', strtolower($subAttribute->subattribute_name))]) ? $taskWeights[strtolower($attribute->name)][str_replace(' ', '_', strtolower($subAttribute->subattribute_name))] : 10 }}" 
                                                           value="{{ isset($taskWeights[strtolower($attribute->name)][str_replace(' ', '_', strtolower($subAttribute->subattribute_name))]) ? $taskWeights[strtolower($attribute->name)][str_replace(' ', '_', strtolower($subAttribute->subattribute_name))] : 8 }}"
                                                           data-category="{{ strtolower($attribute->name) }}"
                                                           data-max="{{ isset($taskWeights[strtolower($attribute->name)][str_replace(' ', '_', strtolower($subAttribute->subattribute_name))]) ? $taskWeights[strtolower($attribute->name)][str_replace(' ', '_', strtolower($subAttribute->subattribute_name))] : 10 }}"
                                                           class="w-16 h-12 text-center text-lg font-semibold border-2 border-gray-300 rounded-md focus:border-{{ $attribute->name == 'Attitude' ? 'red' : ($attribute->name == 'Aptitude' ? 'blue' : ($attribute->name == 'Communication' ? 'green' : 'purple')) }}-500 focus:outline-none">
                                                    <span class="ml-2 text-sm text-gray-500">pts</span>
                                                </div>
                                                
                                                <div class="mt-2 text-center">
                                                    <span class="text-xs text-gray-400">Score for this sub-attribute</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <div class="mt-6 p-4 bg-{{ $attribute->name == 'Attitude' ? 'red' : ($attribute->name == 'Aptitude' ? 'blue' : ($attribute->name == 'Communication' ? 'green' : 'purple')) }}-50 rounded-lg">
                                        <div class="flex justify-between items-center">
                                            <span class="font-semibold text-gray-700">{{ $attribute->name }} Total:</span>
                                            <span class="category-total text-xl font-bold text-{{ $attribute->name == 'Attitude' ? 'red' : ($attribute->name == 'Aptitude' ? 'blue' : ($attribute->name == 'Communication' ? 'green' : 'purple')) }}-600" data-category="{{ strtolower($attribute->name) }}">{{ isset($categoryTotals[strtolower($attribute->name)]) ? number_format($categoryTotals[strtolower($attribute->name)], 1) : '0.0' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    
               
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input[type="number"][data-category]');
    const categoryAverages = {};
    
    // Initialize category tracking
    inputs.forEach(input => {
        const category = input.dataset.category;
        if (!categoryAverages[category]) {
            categoryAverages[category] = [];
        }
        categoryAverages[category].push(input);
    });
    
    // Update averages and summary scores
    function updateScores() {
        // Calculate category averages
        Object.keys(categoryAverages).forEach(category => {
            const categoryInputs = categoryAverages[category];
            const sum = categoryInputs.reduce((total, input) => total + parseFloat(input.value || 0), 0);
            const average = (sum / categoryInputs.length).toFixed(1);
            
            const averageDisplay = document.querySelector(`.category-average[data-category="${category}"]`);
            if (averageDisplay) {
                averageDisplay.textContent = average;
            }
            
            // Update summary score inputs
            const scoreInput = document.getElementById(`${category}_score`);
            if (scoreInput) {
                scoreInput.value = average;
            }
        });
        
        // Calculate total score
        const totalScore = Object.keys(categoryAverages).reduce((total, category) => {
            const categoryInputs = categoryAverages[category];
            const sum = categoryInputs.reduce((catTotal, input) => catTotal + parseFloat(input.value || 0), 0);
            const average = sum / categoryInputs.length;
            return total + average;
        }, 0) / Object.keys(categoryAverages).length;
        
        const totalScoreInput = document.getElementById('total_score');
        if (totalScoreInput) {
            totalScoreInput.value = totalScore.toFixed(1);
        }
    }
    
    // Add event listeners to all number inputs
    inputs.forEach(input => {
        input.addEventListener('input', updateScores);
    });
    
    // Initial calculation
    updateScores();
});
</script>

<style>
.border-left-danger { border-left: 4px solid #dc3545 !important; }
.border-left-info { border-left: 4px solid #17a2b8 !important; }
.border-left-success { border-left: 4px solid #28a745 !important; }
.border-left-warning { border-left: 4px solid #ffc107 !important; }

.form-range {
    width: 100%;
    height: 1.5rem;
    padding: 0;
    background-color: transparent;
    appearance: none;
}

.form-range::-webkit-slider-track {
    width: 100%;
    height: 0.5rem;
    color: transparent;
    cursor: pointer;
    background: #dee2e6;
    border-radius: 1rem;
}

.form-range::-webkit-slider-thumb {
    width: 1rem;
    height: 1rem;
    margin-top: -0.25rem;
    background: #007bff;
    border: 0;
    border-radius: 1rem;
    cursor: pointer;
    appearance: none;
}

.score-display {
    min-width: 30px;
    text-align: center;
}
</style>
@endsection
