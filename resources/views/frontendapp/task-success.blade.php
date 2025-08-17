@extends('frontendapp.partials.app')

@section('content')
<style>
    @keyframes pulse-scale {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    @keyframes pulse-slow {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    .animate-pulse-scale {
        animation: pulse-scale 2s ease-in-out infinite;
    }
    
    .animate-pulse-slow {
        animation: pulse-slow 2s ease-in-out infinite;
    }
    
    .points-badge {
        animation: pulse-scale 3s ease-in-out infinite;
    }
    
    /* Confetti styles */
    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background: #FF8A3D;
        animation: confetti-fall 3s linear infinite;
    }
    
    .confetti:nth-child(odd) {
        background: #F9A949;
        width: 8px;
        height: 8px;
        animation-delay: -0.5s;
    }
    
    .confetti:nth-child(3n) {
        background: #FFB366;
        width: 6px;
        height: 6px;
        animation-delay: -1s;
    }
    
    @keyframes confetti-fall {
        0% {
            transform: translateY(-100vh) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(360deg);
            opacity: 0;
        }
    }
</style>

<!-- Main Content -->
<div class="px-4 mb-24">
    <!-- Task Header with Title and Points -->
    <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-xl p-6 mb-5 shadow-md relative overflow-hidden transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 group">
        <!-- Decorative circle elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF8A3D]/5 rounded-full -mr-16 -mt-16 group-hover:bg-[#FF8A3D]/10 transition-all duration-500"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#FF8A3D]/5 rounded-full -ml-12 -mb-12 group-hover:bg-[#FF8A3D]/10 transition-all duration-500"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-[#FF8A3D]/3 rounded-full blur-3xl opacity-0 group-hover:opacity-20 transition-all duration-500"></div>
        
        <div class="relative z-10 text-center py-4">
            <!-- Success Icon with Animation -->
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse-scale relative">
                <i class="fas fa-check-circle text-green-500 text-5xl"></i>
                <!-- Animated rings around the success icon -->
                <div class="absolute inset-0 w-full h-full rounded-full border-4 border-green-200 animate-ping opacity-75"></div>
            </div>
            
            <!-- Confetti container -->
            <div id="confetti-container" class="absolute inset-0 overflow-hidden pointer-events-none"></div>
            
            <!-- Success Message -->
            <div class="mb-6">
                <div class="text-2xl font-bold text-gray-800 mb-2">Task Submitted!</div>
                <div class="text-base text-gray-600 mb-3">Great job, {{ $student->full_name }}! Your {{ $task->title }} task has been successfully submitted.</div>
            </div>
            
            <!-- Divider -->
            <div class="border-b border-[#FF8A3D]/10 mb-6 max-w-xs mx-auto"></div>
            
            <!-- Points Earned -->
            <div class="bg-white rounded-xl p-4 shadow-sm mb-6 inline-block points-badge">
                <div class="flex items-center justify-center">
                    <div class="w-12 h-12 rounded-full bg-[#FFF5E9] flex items-center justify-center mr-3 shadow-sm">
                        <i class="fas fa-award text-[#FF8A3D] text-xl"></i>
                    </div>
                    <div class="text-left">
                       
                        <div class="text-sm text-gray-500">You have a chance to score</div>
                        <span class="text-xl font-bold text-[#FF8A3D]">+{{ intval($task->taskScore->total_score ?? 20) }} points</span>
                    </div>
                </div>
            </div>
            
            <!-- Next Steps -->
            <a href="{{ route('mobile.dashboard') }}" class="bg-gradient-to-r from-[#FF8A3D] to-[#F9A949] text-white px-8 py-3 rounded-xl text-base font-bold hover:opacity-90 transition-all duration-200 inline-flex items-center shadow-md">
                Continue to Home
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
    
    <!-- Deadline Timer Card -->
    <div class="bg-white rounded-xl p-5 mb-4 shadow-md">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-[#FFF5E9] flex items-center justify-center mr-3">
                    <i class="fas fa-hourglass-half text-[#FF8A3D] animate-pulse-slow"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500">You submitted the task at</div>
                    <div class="text-base font-bold text-gray-700" id="submissionTime">{{ $taskSubmission->submitted_at }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Submission Review Section -->
    <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-xl p-5 mb-6 shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">Your Submission</h3>
            <div class="bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full flex items-center">
                <i class="fas fa-check-circle mr-1"></i>
                Submitted
            </div>
        </div>
        
        <!-- Text Response Review -->
        <div class="mb-5">
            <div class="flex justify-between items-center mb-2">
                <label class="block text-sm font-medium text-gray-700">Your Response</label>
                <span class="text-xs text-green-600 font-medium">{{ strlen($taskSubmission->submission_response) }} characters</span>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <p class="text-sm text-gray-700 whitespace-pre-line">{{ $taskSubmission->submission_response }}</p>
            </div>
        </div>
        
        <!-- Attached Files Review -->
        @php
            $multimediaFiles = $taskSubmission->submission_multimedia ? json_decode($taskSubmission->submission_multimedia, true) : [];
        @endphp
        @if($multimediaFiles && is_array($multimediaFiles) && count($multimediaFiles) > 0)
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Attached Files</label>
            
            @foreach($multimediaFiles as $file)
            <div class="bg-white border border-gray-200 rounded-lg p-3 mb-3">
                <div class="flex items-center mb-2">
                    <div class="w-8 h-8 bg-[#FF8A3D]/10 rounded flex items-center justify-center mr-2">
                        @if(str_contains($file['type'], 'image'))
                            <i class="fas fa-image text-[#FF8A3D]"></i>
                        @elseif(str_contains($file['type'], 'pdf'))
                            <i class="fas fa-file-pdf text-[#FF8A3D]"></i>
                        @else
                            <i class="fas fa-file text-[#FF8A3D]"></i>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-medium text-gray-800">{{ $file['name'] }}</div>
                        <div class="text-xs text-gray-500">{{ number_format($file['size'] / 1024 / 1024, 1) }} MB • {{ ucfirst(explode('/', $file['type'])[0]) }}</div>
                    </div>
                </div>
                
                @if(str_contains($file['type'], 'image'))
                <div class="rounded-lg overflow-hidden border border-gray-200 h-32 bg-white flex items-center justify-center">
                    <img src="{{ asset('uploads/tasks/' . $file['path']) }}" alt="{{ $file['name'] }}" class="h-full w-auto object-contain">
                </div>
                @else
                <div class="rounded-lg overflow-hidden border border-gray-200 h-24 bg-white flex items-center justify-center p-3">
                    <div class="flex items-center justify-center w-full">
                        @if(str_contains($file['type'], 'pdf'))
                            <i class="fas fa-file-pdf text-[#FF8A3D] text-2xl mr-3"></i>
                            <span class="text-sm text-gray-600">PDF Document Preview</span>
                        @else
                            <i class="fas fa-file text-[#FF8A3D] text-2xl mr-3"></i>
                            <span class="text-sm text-gray-600">File Attachment</span>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create confetti animation
    function createConfetti() {
        const container = document.getElementById('confetti-container');
        const colors = ['#FF8A3D', '#F9A949', '#FFB366', '#FFC999'];
        
        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.animationDelay = Math.random() * 3 + 's';
            confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
            container.appendChild(confetti);
        }
        
        // Remove confetti after animation
        setTimeout(() => {
            container.innerHTML = '';
        }, 5000);
    }
    
    // Start confetti animation
    setTimeout(createConfetti, 500);
    
    // Reset local database after successful submission
    function resetLocalDatabase() {
        // Clear localStorage
        localStorage.removeItem('timer_start_time');
        
        // Clear IndexedDB
        const deleteRequest = indexedDB.deleteDatabase('TaskSubmissions');
        
        deleteRequest.onsuccess = function() {
            console.log('✅ Local database cleared successfully');
        };
        
        deleteRequest.onerror = function(event) {
            console.error('❌ Error clearing local database:', event.target.error);
        };
        
        deleteRequest.onblocked = function() {
            console.warn('⚠️ Database deletion blocked - close other tabs');
        };
    }
    
    // Reset local database after page loads
    setTimeout(resetLocalDatabase, 1000);
    
    // Mobile touch interactions
    document.querySelectorAll('.group').forEach(element => {
        element.addEventListener('touchstart', function() {
            this.classList.add('active');
        });
        
        element.addEventListener('touchend', function() {
            this.classList.remove('active');
        });
    });
});
</script>


@endsection
