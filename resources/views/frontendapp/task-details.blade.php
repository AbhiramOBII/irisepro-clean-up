@extends('frontendapp.partials.app')

@section('title', 'Task Details - iRisePro')

@section('content')
<div class="bg-gradient-to-b from-white to-[#EFCAA6] min-h-screen">
    <!-- Back Navigation -->
    <div class="p-4 pb-0">
        <button onclick="history.back()" class="flex items-center text-[#F58321] hover:text-[#E67E35] transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            <span class="font-medium">Back to Dashboard</span>
        </button>
    </div>

    <!-- Main Content -->
    <div class="px-4 mb-24">
        <!-- Task Header with Title and Points -->
        <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-xl p-6 mb-5 shadow-md relative overflow-hidden transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 group">
            <!-- Decorative circle elements -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF8A3D]/5 rounded-full -mr-16 -mt-16 group-hover:bg-[#FF8A3D]/10 transition-all duration-500"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#FF8A3D]/5 rounded-full -ml-12 -mb-12 group-hover:bg-[#FF8A3D]/10 transition-all duration-500"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-[#FF8A3D]/3 rounded-full blur-3xl opacity-0 group-hover:opacity-20 transition-all duration-500"></div>
            
            <div class="relative z-10">
                <!-- Personal Greeting and Task Badge -->
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <div class="text-2xl font-bold text-gray-800 mb-1">{{ strtoupper($student->full_name ?? $student->name ?? 'STUDENT') }},</div>
                        <div class="text-sm text-gray-600 mb-3">Here is today's  task!</div>
                    </div>
                </div>
                
                <!-- Task Title with Icon -->
                <div class="flex items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800 group-hover:text-[#F58321] transition-colors duration-300">{{ $task->task_title ?? 'Focus Session' }}</h2>
                </div>
            </div>
        </div>

        <!-- Task Impact Card -->
        <div class="bg-white rounded-xl p-5 mb-4 shadow-md">
            <h3 class="text-lg font-bold text-gray-800 mb-3">Points You'll Earn</h3>
            <p class="text-sm text-gray-600 mb-4">Completing this task will boost your scores in these areas:</p>
            
            <div class="grid grid-cols-2 gap-4">
                <!-- Aptitude Points -->
                <div class="bg-gradient-to-br from-[#FFF9F5] to-white rounded-lg p-3 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-[#FF8A3D]/5 rounded-full -mr-8 -mt-8 group-hover:bg-[#FF8A3D]/10 transition-all duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-sm font-medium text-gray-700">Aptitude</div>
                            <div class="w-6 h-6 rounded-full bg-[#FFF5E9] flex items-center justify-center">
                                <i class="fas fa-brain text-[#FF8A3D] text-xs"></i>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex items-center mr-2">
                                <i class="fas fa-plus text-xs text-[#FF8A3D] mr-1"></i>
                                <span class="text-lg font-bold text-[#FF8A3D]">{{ intval($task->taskScore->aptitude_score ?? 8) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Attitude Points -->
                <div class="bg-gradient-to-br from-[#FFF9F5] to-white rounded-lg p-3 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-[#FF8A3D]/5 rounded-full -mr-8 -mt-8 group-hover:bg-[#FF8A3D]/10 transition-all duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-sm font-medium text-gray-700">Attitude</div>
                            <div class="w-6 h-6 rounded-full bg-[#FFF5E9] flex items-center justify-center">
                                <i class="fas fa-smile text-[#FF8A3D] text-xs"></i>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex items-center mr-2">
                                <i class="fas fa-plus text-xs text-[#FF8A3D] mr-1"></i>
                                <span class="text-lg font-bold text-[#FF8A3D]">{{ intval($task->taskScore->attitude_score ?? 5) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Communication Points -->
                <div class="bg-gradient-to-br from-[#FFF9F5] to-white rounded-lg p-3 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-[#FF8A3D]/5 rounded-full -mr-8 -mt-8 group-hover:bg-[#FF8A3D]/10 transition-all duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-sm font-medium text-gray-700">Communication</div>
                            <div class="w-6 h-6 rounded-full bg-[#FFF5E9] flex items-center justify-center">
                                <i class="fas fa-comments text-[#FF8A3D] text-xs"></i>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex items-center mr-2">
                                <i class="fas fa-plus text-xs text-[#FF8A3D] mr-1"></i>
                                <span class="text-lg font-bold text-[#FF8A3D]">{{ intval($task->taskScore->communication_score ?? 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Execution Points -->
                <div class="bg-gradient-to-br from-[#FFF9F5] to-white rounded-lg p-3 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-[#FF8A3D]/5 rounded-full -mr-8 -mt-8 group-hover:bg-[#FF8A3D]/10 transition-all duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-sm font-medium text-gray-700">Execution</div>
                            <div class="w-6 h-6 rounded-full bg-[#FFF5E9] flex items-center justify-center">
                                <i class="fas fa-check-circle text-[#FF8A3D] text-xs"></i>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex items-center mr-2">
                                <i class="fas fa-plus text-xs text-[#FF8A3D] mr-1"></i>
                                <span class="text-lg font-bold text-[#FF8A3D]">{{ intval($task->taskScore->execution_score ?? 10) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 pt-3 border-t border-gray-100">
                <div class="flex justify-between items-center">
                    <div class="text-sm font-medium text-gray-700">Total Skill Points</div>
                    <div class="flex items-center">
                        <i class="fas fa-award text-[#FF8A3D] mr-2"></i>
                        <span class="text-lg font-bold text-[#FF8A3D]">{{ intval($task->taskScore->total_score ?? 25) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Task Description Card -->
        <div class="bg-white rounded-xl p-5 mb-4 shadow-md">
            <h3 class="text-lg font-bold text-gray-800 mb-3">Description</h3>
            <div class="text-gray-600 mb-4 prose prose-sm max-w-none">{!! $task->task_description ?? 'Complete a focused work session without distractions to improve productivity and earn points for your daily challenge.' !!}</div>
            <hr>
            <h3 class="text-lg font-bold text-gray-800 mb-3 mt-2">Instructions</h3>
            <div class="text-gray-600 mb-4 prose prose-sm max-w-none">{!! $task->task_instructions ?? 'Complete a focused work session without distractions to improve productivity and earn points for your daily challenge.' !!}</div>
            
            
            <!-- Multimedia Content Section -->
            @if($task->task_multimedia && is_array($task->task_multimedia) && count($task->task_multimedia) > 0)
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center mb-4">
                    <h4 class="text-base font-medium text-gray-800">Learning Materials</h4>
                </div>
                
                @foreach($task->task_multimedia as $media)
                    @if(isset($media['type']) && $media['type'] === 'image')
                    <!-- Image Content Card -->
                    <div class="mb-4">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-image text-[#FF8A3D] mr-2"></i>
                            <div class="text-sm font-medium text-gray-700">{{ $media['title'] ?? 'Image Resource' }}</div>
                        </div>
                        <div class="rounded-lg overflow-hidden bg-gray-50 border border-gray-100 hover:shadow-md transition-all duration-300">
                            <img src="{{ $media['url'] ?? 'https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" 
                                 alt="{{ $media['alt'] ?? 'Task Resource' }}" 
                                 class="w-full h-40 object-cover">
                            <div class="p-3 bg-white">
                                <p class="text-xs text-gray-600">{{ $media['description'] ?? 'Visual guide for task completion' }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            @endif
        </div>

        <!-- Deadline Timer Card -->
        <div class="bg-white rounded-xl p-5 mb-4 shadow-md">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-[#FFF5E9] flex items-center justify-center mr-3">
                        <i class="fas fa-hourglass-half text-[#FF8A3D] animate-pulse-slow"></i>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Deadline</div>
                        <div class="text-base font-bold text-gray-700" id="countdown">24:00:00</div>
                    </div>
                </div>
                <div class="text-sm font-medium text-[#FF8A3D]">Today</div>
            </div>
        </div>
        
        <!-- Start Button -->
        @if($isTaskCompleted)
            <!-- Completed State -->
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Task Completed!</h3>
                <p class="text-gray-600 text-sm mb-4">Great job! You've successfully completed this task.</p>
                
            </div>
        @elseif($isTaskAvailable)
            <!-- Available State -->
            <div class="text-center">
                <div class="w-16 h-16 bg-[#FFF5E9] rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tasks text-[#FF8A3D] text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Task Available</h3>
                <p class="text-gray-600 text-sm mb-6">This task is ready to be completed. Review the details above and start when you're ready.</p>
                
                <!-- Submit Now Button -->
                <a href="{{ route('mobile.task.submission' , ['task_id' => $task->id, 'batch_id' => $batch->id]) }}" class="inline-block bg-gradient-to-r from-[#FF8A3D] to-[#F9A949] text-white px-10 py-4 rounded-xl text-base font-bold hover:opacity-90 transition-all duration-200 shadow-lg">
                    Submit Now
                    <i class="fas fa-play ml-2"></i>
                </a>
            </div>
        @else
            <!-- Locked State -->
            <div class="text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lock text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Task Locked</h3>
                <p class="text-gray-600 text-sm">Complete the previous tasks in your challenge to unlock this task.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let countdownInterval = null;
    
    // Initialize 24-hour countdown timer based on saved timer_start_time
    function initCountdownTimer() {
        const countdownElement = document.getElementById('countdown');
        if (!countdownElement) return;
        
        // Check if timer was started from localStorage
        const savedStartTime = localStorage.getItem('timer_start_time');
        if (!savedStartTime) {
            countdownElement.textContent = '24:00:00';
            return;
        }
        
        // Calculate deadline from saved start time
        const startTime = new Date(savedStartTime);
        const deadline = new Date(startTime);
        deadline.setHours(deadline.getHours() + 24);
        
        function updateCountdown() {
            const now = new Date();
            const timeLeft = deadline - now;
            
            if (timeLeft <= 0) {
                countdownElement.textContent = '00:00:00';
                clearInterval(countdownInterval);
                localStorage.removeItem('timer_start_time');
                return;
            }
            
            const hours = Math.floor(timeLeft / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            
            countdownElement.textContent = 
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        updateCountdown(); // Initial call
        countdownInterval = setInterval(updateCountdown, 1000);
    }
    
    // Start countdown timer
    initCountdownTimer();
    
});
</script>
@endpush
