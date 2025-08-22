<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Evaluation Score - {{ $submission->student->name }} - IrisePro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#667eea',
                        secondary: '#764ba2'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Full Evaluation Score</h1>
                    <p class="text-gray-600">Complete evaluation details for {{ $submission->student->name }}</p>
                </div>
                <a href="{{ route('yashodarshi.task.evaluate', ['batchId' => $submission->batch_id, 'taskId' => $submission->task_id]) }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Evaluations
                </a>
            </div>
        </div>

        <!-- Student & Task Info -->
        <div class="bg-white rounded-2xl card-shadow mb-8">
            <div class="gradient-bg text-white rounded-t-2xl p-6">
                <h3 class="text-xl font-semibold mb-0">
                    <i class="fas fa-user mr-2"></i>Student & Task Information
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center mr-3 text-sm font-semibold">
                                {{ strtoupper(substr($submission->student->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $submission->student->name }}</p>
                                <p class="text-sm text-gray-500">{{ $submission->student->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Task</label>
                        <p class="font-semibold text-gray-900">{{ $submission->task->title }}</p>
                        <p class="text-sm text-gray-500">{{ $submission->batch->challenge->title }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Submitted At</label>
                        <p class="font-semibold text-gray-900">{{ $submission->submitted_at->format('M d, Y') }}</p>
                        <p class="text-sm text-gray-500">{{ $submission->submitted_at->format('H:i A') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Reviewed
                        </span>
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
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold mb-3"><i class="fas fa-comment mr-2"></i>Response</h5>
                        <div class="bg-gray-50 rounded-xl p-6 border-l-4 border-primary">
                            <p class="text-gray-800 leading-relaxed">{{ $submission->submission_response }}</p>
                        </div>
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
                                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                                        @if(str_contains($file, '.jpg') || str_contains($file, '.jpeg') || str_contains($file, '.png') || str_contains($file, '.gif'))
                                            <img src="{{ asset('storage/' . $file) }}" alt="Submission" class="w-full h-32 object-cover rounded-lg mb-2">
                                        @else
                                            <div class="w-full h-32 bg-gray-100 rounded-lg flex items-center justify-center mb-2">
                                                <i class="fas fa-file text-3xl text-gray-400"></i>
                                            </div>
                                        @endif
                                        <a href="{{ asset('storage/' . $file) }}" target="_blank" class="block text-center bg-primary text-white py-2 px-3 rounded-lg text-sm hover:bg-primary-dark transition-colors duration-200">
                                            <i class="fas fa-download mr-1"></i>View/Download
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Evaluation Results -->
        @if($evaluationResult)
        <div class="bg-white rounded-2xl card-shadow mb-8">
            <div class="gradient-bg text-white rounded-t-2xl p-6">
                <h3 class="text-xl font-semibold mb-0">
                    <i class="fas fa-star mr-2"></i>Evaluation Results
                </h3>
            </div>
            <div class="p-6">
                <!-- Total Score Display -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-32 h-32 bg-gradient-to-br from-green-400 to-green-600 rounded-full text-white mb-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold">{{ $evaluationResult->total_score }}</div>
                            <div class="text-sm opacity-90">/ {{ $maxScore }}</div>
                        </div>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-2">Total Score</h4>
                    <p class="text-gray-600">Overall evaluation score</p>
                </div>

                <!-- Category Scores -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    @if($evaluationResult->aptitude_score > 0)
                    <div class="text-center p-6 bg-blue-50 rounded-xl border border-blue-200">
                        <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-brain text-xl"></i>
                        </div>
                        <h5 class="font-semibold text-gray-900 mb-1">Aptitude</h5>
                        <p class="text-2xl font-bold text-blue-600">{{ $evaluationResult->aptitude_score }}</p>
                    </div>
                    @endif

                    @if($evaluationResult->attitude_score > 0)
                    <div class="text-center p-6 bg-green-50 rounded-xl border border-green-200">
                        <div class="w-16 h-16 bg-green-600 text-white rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-heart text-xl"></i>
                        </div>
                        <h5 class="font-semibold text-gray-900 mb-1">Attitude</h5>
                        <p class="text-2xl font-bold text-green-600">{{ $evaluationResult->attitude_score }}</p>
                    </div>
                    @endif

                    @if($evaluationResult->communication_score > 0)
                    <div class="text-center p-6 bg-purple-50 rounded-xl border border-purple-200">
                        <div class="w-16 h-16 bg-purple-600 text-white rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-comments text-xl"></i>
                        </div>
                        <h5 class="font-semibold text-gray-900 mb-1">Communication</h5>
                        <p class="text-2xl font-bold text-purple-600">{{ $evaluationResult->communication_score }}</p>
                    </div>
                    @endif

                    @if($evaluationResult->execution_score > 0)
                    <div class="text-center p-6 bg-orange-50 rounded-xl border border-orange-200">
                        <div class="w-16 h-16 bg-orange-600 text-white rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-cogs text-xl"></i>
                        </div>
                        <h5 class="font-semibold text-gray-900 mb-1">Execution</h5>
                        <p class="text-2xl font-bold text-orange-600">{{ $evaluationResult->execution_score }}</p>
                    </div>
                    @endif
                </div>

                <!-- Detailed Attribute Scores -->
                @if($evaluationResult->attribute_scores)
                <div class="mb-6">
                    <h5 class="text-lg font-semibold mb-4"><i class="fas fa-list mr-2"></i>Detailed Attribute Scores</h5>
                    <div class="space-y-4">
                        @php
                            $attributeScores = is_array($evaluationResult->attribute_scores) 
                                ? $evaluationResult->attribute_scores 
                                : json_decode($evaluationResult->attribute_scores, true);
                        @endphp
                        @if($attributeScores)
                            @foreach($attributeScores as $mainAttribute => $scores)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h6 class="font-semibold text-gray-900 mb-3 capitalize">{{ str_replace('_', ' ', $mainAttribute) }}</h6>
                                    @if(is_array($scores))
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                            @foreach($scores as $subAttribute => $score)
                                                <div class="flex justify-between items-center bg-white rounded-lg p-3">
                                                    <span class="text-sm font-medium text-gray-700 capitalize">{{ str_replace('_', ' ', $subAttribute) }}</span>
                                                    <span class="font-bold text-primary">{{ $score }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="flex justify-between items-center bg-white rounded-lg p-3">
                                            <span class="text-sm font-medium text-gray-700">Score</span>
                                            <span class="font-bold text-primary">{{ $scores }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                @endif

                <!-- Feedback -->
                @if($evaluationResult->feedback)
                <div class="bg-yellow-50 rounded-xl p-6 border-l-4 border-yellow-400 mb-6">
                    <h5 class="text-lg font-semibold mb-3"><i class="fas fa-comment-dots mr-2"></i>Evaluator Feedback</h5>
                    <p class="text-gray-800 leading-relaxed">{{ $evaluationResult->feedback }}</p>
                </div>
                @endif

                <!-- Audio Feedback -->
                @if($evaluationResult->audio_feedback)
                <div class="bg-blue-50 rounded-xl p-6 border-l-4 border-blue-400 mb-6">
                    <h5 class="text-lg font-semibold mb-4"><i class="fas fa-microphone mr-2"></i>Audio Feedback</h5>
                    
                    <!-- Custom Audio Player -->
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <div class="flex items-center space-x-4">
                            <!-- Play/Pause Button -->
                            <button id="playPauseBtn" onclick="togglePlayPause()" class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition-colors duration-200">
                                <i id="playPauseIcon" class="fas fa-play"></i>
                            </button>
                            
                            <!-- Progress Bar Container -->
                            <div class="flex-1">
                                <div class="flex items-center justify-between text-sm text-gray-600 mb-1">
                                    <span id="currentTime">0:00</span>
                                    <span id="duration">0:00</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 cursor-pointer" onclick="seekAudio(event)">
                                    <div id="progressBar" class="bg-blue-600 h-2 rounded-full transition-all duration-100" style="width: 0%"></div>
                                </div>
                            </div>
                            
                            <!-- Volume Control -->
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-volume-up text-gray-600"></i>
                                <input type="range" id="volumeSlider" min="0" max="100" value="100" 
                                       class="w-20 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                                       onchange="changeVolume(this.value)">
                            </div>
                            
                        </div>
                        
                        <!-- Hidden Audio Element -->
                        <audio id="audioPlayer" preload="metadata">
                            <source src="{{ asset('storage/' . $evaluationResult->audio_feedback) }}" type="audio/mpeg">
                            <source src="{{ asset('storage/' . $evaluationResult->audio_feedback) }}" type="audio/wav">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                    
                    <p class="text-sm text-gray-600 mt-3">
                        <i class="fas fa-info-circle mr-1"></i>
                        Personal audio feedback from your evaluator
                    </p>
                </div>
                @endif

                <!-- Evaluation Metadata -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-medium">Evaluated on:</span> 
                            {{ $evaluationResult->evaluated_at ? $evaluationResult->evaluated_at->format('M d, Y H:i A') : 'N/A' }}
                        </div>
                        <div>
                            <span class="font-medium">Evaluator:</span> 
                            {{ $yashodarshi->name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white rounded-2xl card-shadow mb-8">
            <div class="p-6 text-center">
                <i class="fas fa-exclamation-triangle text-4xl text-yellow-500 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Evaluation Results Found</h3>
                <p class="text-gray-600">This submission has not been evaluated yet or evaluation data is missing.</p>
            </div>
        </div>
        @endif

    </div>
</div>

<style>
.gradient-bg {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card-shadow {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.primary {
    color: #667eea;
}

.bg-primary {
    background-color: #667eea;
}

.bg-primary-dark {
    background-color: #5a67d8;
}

.border-primary {
    border-color: #667eea;
}

.text-primary {
    color: #667eea;
}

/* Volume Slider Styling */
#volumeSlider::-webkit-slider-thumb {
    appearance: none;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #667eea;
    cursor: pointer;
}

#volumeSlider::-moz-range-thumb {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #667eea;
    cursor: pointer;
    border: none;
}
</style>

<script>
let audioPlayer = document.getElementById('audioPlayer');
let playPauseBtn = document.getElementById('playPauseBtn');
let playPauseIcon = document.getElementById('playPauseIcon');
let progressBar = document.getElementById('progressBar');
let currentTimeSpan = document.getElementById('currentTime');
let durationSpan = document.getElementById('duration');
let volumeSlider = document.getElementById('volumeSlider');

// Initialize audio player when page loads
document.addEventListener('DOMContentLoaded', function() {
    if (audioPlayer) {
        // Set initial volume
        audioPlayer.volume = 1.0;
        
        // Update duration when metadata is loaded
        audioPlayer.addEventListener('loadedmetadata', function() {
            durationSpan.textContent = formatTime(audioPlayer.duration);
        });
        
        // Update progress bar and current time during playback
        audioPlayer.addEventListener('timeupdate', function() {
            if (audioPlayer.duration) {
                const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
                progressBar.style.width = progress + '%';
                currentTimeSpan.textContent = formatTime(audioPlayer.currentTime);
            }
        });
        
        // Reset play button when audio ends
        audioPlayer.addEventListener('ended', function() {
            playPauseIcon.className = 'fas fa-play';
            progressBar.style.width = '0%';
            currentTimeSpan.textContent = '0:00';
        });
        
        // Handle audio loading errors
        audioPlayer.addEventListener('error', function() {
            console.error('Error loading audio file');
            playPauseBtn.disabled = true;
            playPauseBtn.classList.add('opacity-50', 'cursor-not-allowed');
        });
    }
});

function togglePlayPause() {
    if (audioPlayer.paused) {
        audioPlayer.play().then(() => {
            playPauseIcon.className = 'fas fa-pause';
        }).catch((error) => {
            console.error('Error playing audio:', error);
        });
    } else {
        audioPlayer.pause();
        playPauseIcon.className = 'fas fa-play';
    }
}

function seekAudio(event) {
    if (audioPlayer.duration) {
        const progressContainer = event.currentTarget;
        const clickX = event.offsetX;
        const width = progressContainer.offsetWidth;
        const newTime = (clickX / width) * audioPlayer.duration;
        audioPlayer.currentTime = newTime;
    }
}

function changeVolume(value) {
    audioPlayer.volume = value / 100;
    
    // Update volume icon based on level
    const volumeIcon = document.querySelector('.fa-volume-up');
    if (value == 0) {
        volumeIcon.className = 'fas fa-volume-mute text-gray-600';
    } else if (value < 50) {
        volumeIcon.className = 'fas fa-volume-down text-gray-600';
    } else {
        volumeIcon.className = 'fas fa-volume-up text-gray-600';
    }
}

function formatTime(seconds) {
    if (isNaN(seconds)) return '0:00';
    
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    return minutes + ':' + (remainingSeconds < 10 ? '0' : '') + remainingSeconds;
}
</script>
</body>
</html>
