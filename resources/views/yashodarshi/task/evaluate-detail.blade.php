<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed Evaluation - {{ $submission->student->name }} - IrisePro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'montserrat': ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#667eea',
                        'secondary': '#764ba2',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-shadow {
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .hover-shadow:hover {
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 font-montserrat">
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('yashodarshi.dashboard') }}" class="flex items-center text-white hover:text-gray-200 transition-colors">
                    <img src="{{ asset('images/icon.png') }}" alt="IrisePro" class="w-8 h-8 mr-2">
                    <span class="text-lg font-semibold">IrisePro - Yashodarshi</span>
                </a>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('yashodarshi.task.evaluate', ['batchId' => $submission->batch_id, 'taskId' => $submission->task_id]) }}" 
                       class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg border border-white border-opacity-30 transition-all duration-200 text-sm">
                        <i class="fas fa-arrow-left mr-1"></i>Back to Evaluations
                    </a>
                    <form action="{{ route('yashodarshi.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg border border-white border-opacity-30 transition-all duration-200 text-sm">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

   
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Student & Task Information -->
        <div class="bg-white rounded-2xl card-shadow mb-8">
            <div class="gradient-bg text-white rounded-t-2xl p-6">
                <h3 class="text-xl font-semibold mb-0">
                    <i class="fas fa-user-graduate mr-2"></i>Detailed Evaluation
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-content-center mr-4 text-lg font-semibold">
                                {{ strtoupper(substr($submission->student->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold mb-1">{{ $submission->student->name }}</h4>
                                <p class="text-gray-600 text-sm">{{ $submission->student->email }}</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="font-semibold text-gray-700 w-24">Task:</span>
                                <span class="text-gray-900">{{ $submission->task->task_title }}</span>
                            </div>
                            <div class="flex">
                                <span class="font-semibold text-gray-700 w-24">Batch:</span>
                                <span class="text-gray-900">{{ $submission->batch->title }}</span>
                            </div>
                            <div class="flex">
                                <span class="font-semibold text-gray-700 w-24">Submitted:</span>
                                <span class="text-gray-900">{{ $submission->submitted_at ? $submission->submitted_at->format('M d, Y H:i') : 'Not submitted' }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="gradient-bg text-white rounded-xl p-6 text-center">
                            <h5 class="text-lg font-semibold mb-2">Current Total Score</h5>
                            <div class="text-4xl font-bold" id="totalScoreDisplay">{{ $submission->score ?? 0 }}</div>
                            <p class="text-sm opacity-90 mt-1">out of {{ array_sum($attributeWeights ?: []) }} points</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submission Content -->
        @if($submission->submission_response || $submission->submission_multimedia)
        <div class="bg-white rounded-2xl card-shadow mb-8">
            <div class="gradient-bg text-white rounded-t-2xl p-6">
                <h3 class="text-xl font-semibold mb-0">
                    <i class="fas fa-file-alt mr-2"></i>Student Submission
                </h3>
            </div>
            <div class="p-6">
                @if($submission->submission_response)
                    <div class="bg-gray-50 rounded-xl p-6 mb-6 border-l-4 border-primary">
                        <h5 class="text-lg font-semibold mb-3"><i class="fas fa-comment mr-2"></i>Written Response</h5>
                        <p class="text-gray-800 leading-relaxed">{{ $submission->submission_response }}</p>
                    </div>
                @endif

                @if($submission->submission_multimedia)
                    <div class="bg-gray-50 rounded-xl p-6 border-l-4 border-primary">
                        <h5 class="text-lg font-semibold mb-4"><i class="fas fa-paperclip mr-2"></i>Attached Files</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @php
                                $multimedia = is_array($submission->submission_multimedia) 
                                    ? $submission->submission_multimedia 
                                    : json_decode($submission->submission_multimedia, true);
                            @endphp
                            @if($multimedia && is_array($multimedia))
                                @foreach($multimedia as $file)
                                    <div class="mb-3">
                                        @if(is_string($file) && (str_contains($file, '.jpg') || str_contains($file, '.jpeg') || str_contains($file, '.png') || str_contains($file, '.gif')))
                                            <img src="{{ asset('storage/' . $file) }}" alt="Submission" class="w-full max-h-48 object-cover rounded-lg shadow-sm">
                                        @elseif(is_string($file))
                                            <a href="{{ asset('storage/' . $file) }}" target="_blank" class="block w-full bg-white hover:bg-gray-50 border-2 border-gray-200 hover:border-primary rounded-lg p-4 text-center transition-all duration-200">
                                                <i class="fas fa-file text-2xl text-gray-400 mb-2"></i>
                                                <p class="text-sm text-gray-600">View File</p>
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Attribute Scoring Form -->
        <div class="bg-white rounded-2xl card-shadow mb-8">
            <div class="gradient-bg text-white rounded-t-2xl p-6">
                <h3 class="text-xl font-semibold mb-0">
                    <i class="fas fa-star mr-2"></i>Attribute-Based Evaluation
                </h3>
            </div>
            <div class="p-6">
                <form id="detailedEvaluationForm" method="POST" action="{{ route('yashodarshi.submission.store-evaluation', $submission->id) }}">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

          
                       
                        @if($attributeWeights && count($attributeWeights) > 0)
                            @foreach($attributeWeights as $mainAttribute => $subAttributes)
                                @if(is_array($subAttributes))
                                    @php
                                        // Check if any sub-attributes have non-zero weights
                                        $hasNonZeroSubAttributes = collect($subAttributes)->filter(function($weight) {
                                            return $weight > 0;
                                        })->count() > 0;
                                    @endphp
                                    
                                    @if($hasNonZeroSubAttributes)
                                        <!-- Main Attribute Header -->
                                        <div class="col-span-full mb-6">
                                            <h4 class="text-primary text-lg font-semibold border-b border-gray-200 pb-2">
                                                <i class="fas fa-{{ $mainAttribute == 'aptitude' ? 'brain' : ($mainAttribute == 'attitude' ? 'heart' : ($mainAttribute == 'communication' ? 'comments' : 'cogs')) }} mr-2"></i>
                                                {{ ucfirst($mainAttribute) }} Category
                                            </h4>
                                        </div>
                                        
                                        <!-- Sub-attributes for this main attribute in 4-column grid -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 col-span-full">
                                            @foreach($subAttributes as $subAttributeName => $subAttributeWeight)
                                                @if($subAttributeWeight > 0)
                                                    <div class="border-2 border-gray-200 hover-shadow hover:border-primary rounded-xl p-4 transition-all duration-300">
                                                        <div class="text-center mb-4">
                                                            <h5 class="text-base font-semibold capitalize mb-2">
                                                                <i class="fas fa-dot-circle mr-1 text-primary text-sm"></i>
                                                                {{ str_replace('_', ' ', ucfirst($subAttributeName)) }}
                                                            </h5>
                                                            <span class="bg-gray-500 text-white px-2 py-1 rounded-full text-xs">Max: {{ $subAttributeWeight }}</span>
                                                        </div>
                                                        
                                                        <div class="mb-4">
                                                            <label class="block text-xs font-medium text-gray-700 mb-2 text-center">Score</label>
                                                            <input type="number" 
                                                                   name="attribute_scores[{{ $mainAttribute }}][{{ $subAttributeName }}]" 
                                                                   class="w-full px-3 py-2 text-lg font-bold text-center border-2 border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-25 transition-all duration-200 score-input" 
                                                                   min="0" 
                                                                   max="{{ $subAttributeWeight }}" 
                                                                   value="{{ $submission->attribute_scores[$mainAttribute][$subAttributeName] ?? 0 }}"
                                                                   data-max="{{ $subAttributeWeight }}"
                                                                   onchange="updateTotalScore()">
                                                        </div>
                                                        
                                                        <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                                            <div class="bg-primary h-2 rounded-full transition-all duration-300" 
                                                                 style="width: {{ $subAttributeWeight > 0 ? (($submission->attribute_scores[$mainAttribute][$subAttributeName] ?? 0) / $subAttributeWeight) * 100 : 0 }}%"
                                                                 id="progress-{{ $mainAttribute }}-{{ $subAttributeName }}">
                                                            </div>
                                                        </div>
                                                        
                                                        <p class="text-gray-500 text-xs text-center">
                                                            {{ str_replace('_', ' ', $subAttributeName) }}
                                                        </p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    @if($subAttributes > 0)
                                        <!-- Handle case where it's a direct attribute (not nested) -->
                                        <div class="mb-6">
                                            <div class="border-2 border-gray-200 hover-shadow hover:border-primary rounded-xl p-6 transition-all duration-300">
                                                <div class="flex justify-between items-center mb-4">
                                                    <h5 class="text-lg font-semibold capitalize">
                                                        <i class="fas fa-{{ $mainAttribute == 'aptitude' ? 'brain' : ($mainAttribute == 'attitude' ? 'heart' : ($mainAttribute == 'communication' ? 'comments' : 'cogs')) }} mr-2 text-primary"></i>
                                                        {{ str_replace('_', ' ', ucfirst($mainAttribute)) }}
                                                    </h5>
                                                    <span class="bg-gray-500 text-white px-3 py-1 rounded-full text-sm">Max: {{ $subAttributes }}</span>
                                                </div>
                                                
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Score</label>
                                                    <input type="number" 
                                                           name="attribute_scores[{{ $mainAttribute }}]" 
                                                           class="w-full px-4 py-3 text-xl font-bold text-center border-2 border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-25 transition-all duration-200 score-input" 
                                                           min="0" 
                                                           max="{{ $subAttributes }}" 
                                                           value="{{ $submission->attribute_scores[$mainAttribute] ?? 0 }}"
                                                           data-max="{{ $subAttributes }}"
                                                           onchange="updateTotalScore()">
                                                </div>
                                                
                                                <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                                                    <div class="bg-primary h-2 rounded-full transition-all duration-300" 
                                                         style="width: {{ $subAttributes > 0 ? (($submission->attribute_scores[$mainAttribute] ?? 0) / $subAttributes) * 100 : 0 }}%"
                                                         id="progress-{{ $mainAttribute }}">
                                                    </div>
                                                </div>
                                                
                                                <p class="text-gray-500 text-sm">
                                                    @if(str_contains($mainAttribute, 'aptitude'))
                                                        Technical skills, problem-solving ability, and domain knowledge
                                                    @elseif(str_contains($mainAttribute, 'attitude'))
                                                        Work ethic, enthusiasm, and professional behavior
                                                    @elseif(str_contains($mainAttribute, 'communication'))
                                                        Clarity of expression, presentation skills, and interaction quality
                                                    @elseif(str_contains($mainAttribute, 'execution'))
                                                        Implementation quality, attention to detail, and delivery
                                                    @else
                                                        Evaluation criteria for {{ str_replace('_', ' ', $mainAttribute) }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <div class="col-span-full">
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                                        <p class="text-yellow-800">No attribute scoring framework found for this task. Please contact the administrator.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Feedback Section -->
                    <div class="mt-8">
                        <label for="feedback" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-comment-dots mr-2"></i>Detailed Feedback
                        </label>
                        <textarea id="feedback" 
                                  name="feedback" 
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-25 transition-all duration-200" 
                                  rows="6" 
                                  placeholder="Provide comprehensive feedback covering all evaluated attributes...">{{ $submission->feedback }}</textarea>
                        <p class="text-gray-500 text-sm mt-1">Provide specific, actionable feedback to help the student improve.</p>
                    </div>

                    <!-- Status Selection -->
                    <div class="mt-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-flag mr-2"></i>Evaluation Status
                        </label>
                        <select id="status" name="status" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-25 transition-all duration-200" required>
                            <option value="reviewed" {{ $submission->status == 'reviewed' ? 'selected' : '' }}>
                                Reviewed & Approved
                            </option>
                            <option value="submitted" {{ $submission->status == 'submitted' ? 'selected' : '' }}>
                                Needs Revision
                            </option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('yashodarshi.task.evaluate', ['batchId' => $submission->batch_id, 'taskId' => $submission->task_id]) }}" class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200 inline-flex items-center">
                            <i class="fas fa-times mr-1"></i>Cancel
                        </a>
                        <button type="submit" class="px-8 py-3 gradient-bg hover:opacity-90 text-white rounded-lg font-semibold transition-all duration-200 text-lg">
                            <i class="fas fa-save mr-2"></i>Save Detailed Evaluation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function updateTotalScore() {
            let total = 0;
            const scoreInputs = document.querySelectorAll('.score-input');
            
            scoreInputs.forEach(input => {
                let score = parseFloat(input.value) || 0;
                const max = parseFloat(input.dataset.max) || 0;
                
                // Enforce maximum score limit
                if (score > max) {
                    score = max;
                    input.value = max;
                }
                
                // Handle both nested and direct attribute names
                let progressBarId = '';
                const nameMatch = input.name.match(/attribute_scores\[([^\]]+)\](?:\[([^\]]+)\])?/);
                
                if (nameMatch) {
                    if (nameMatch[2]) {
                        // Nested attribute: attribute_scores[mainAttribute][subAttribute]
                        progressBarId = 'progress-' + nameMatch[1] + '-' + nameMatch[2];
                    } else {
                        // Direct attribute: attribute_scores[attribute]
                        progressBarId = 'progress-' + nameMatch[1];
                    }
                }
                
                // Update progress bar
                const progressBar = document.getElementById(progressBarId);
                if (progressBar) {
                    const percentage = max > 0 ? (score / max) * 100 : 0;
                    progressBar.style.width = percentage + '%';
                    
                    // Change progress bar color if at maximum
                    if (score >= max) {
                        progressBar.classList.remove('bg-primary');
                        progressBar.classList.add('bg-green-500');
                    } else {
                        progressBar.classList.remove('bg-green-500');
                        progressBar.classList.add('bg-primary');
                    }
                }
                
                total += score;
            });
            
            document.getElementById('totalScoreDisplay').textContent = total;
        }

        // Add input event listeners for real-time validation and score updates
        document.addEventListener('DOMContentLoaded', function() {
            const scoreInputs = document.querySelectorAll('.score-input');
            
            scoreInputs.forEach(input => {
                // Update total score on input change
                input.addEventListener('input', function() {
                    const max = parseFloat(this.dataset.max) || 0;
                    const value = parseFloat(this.value) || 0;
                    
                    // Visual validation feedback
                    if (value > max) {
                        this.classList.add('border-red-500', 'bg-red-50');
                        this.classList.remove('border-gray-200');
                    } else {
                        this.classList.remove('border-red-500', 'bg-red-50');
                        this.classList.add('border-gray-200');
                    }
                    
                    updateTotalScore();
                });
                
                // Enforce maximum on blur
                input.addEventListener('blur', function() {
                    const max = parseFloat(this.dataset.max) || 0;
                    let value = parseFloat(this.value) || 0;
                    
                    if (value > max) {
                        this.value = max;
                    }
                    updateTotalScore();
                });
            });
            
            updateTotalScore();
        });
    </script>
</body>
</html>
