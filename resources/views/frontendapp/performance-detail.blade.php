@extends('frontendapp.partials.app')

@section('title', 'Performance Detail')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] relative overflow-hidden">
  
    <!-- Single Day Performance Detail -->
    <div class="px-4 py-2">
        <!-- Day Header with Number Badge -->
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center">
                <div class="bg-[#FF8A3D] text-white h-14 w-14 rounded-full flex items-center justify-center font-bold mr-3 shadow-md">
                    <span class="text-xl">{{ $performanceDetail['task_number'] }}<sup>{{ $performanceDetail['task_number'] == 1 ? 'st' : ($performanceDetail['task_number'] == 2 ? 'nd' : ($performanceDetail['task_number'] == 3 ? 'rd' : 'th')) }}</sup></span>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $performanceDetail['task_title'] }}</h2>
                    <p class="text-sm text-gray-500">{{ $performanceDetail['evaluated_at'] }}</p>
                </div>
            </div>
            <div class="bg-[#FFF1E6] px-4 py-2 rounded-full">
                <span class="text-sm font-bold text-[#FF8A3D]">{{ $performanceDetail['student_scores']['total'] }}/{{ $performanceDetail['max_scores']['total'] }}</span>
            </div>
        </div>
        
        <!-- Task Details Card -->
        <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-xl shadow-md p-5 mb-6">
            <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $performanceDetail['task_title'] }}</h3>
            <p class="text-gray-600 mb-4">{{ $performanceDetail['task_description'] }}</p>
        </div>
        
        <!-- AACE Scores Card -->
        <div class="bg-white rounded-xl shadow-md p-5 mb-6">
            <h3 class="font-bold text-lg text-gray-800 mb-4">AACE Scores</h3>
            
         
            <!-- Imperative Attributes Toggle Section -->
            <div class="mt-5">
              
                
               
                
          
            
            <!-- Aptitude Score -->
            <div class="mb-4">
                <div class="flex justify-between items-center mb-1">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-[#FF8A3D] mr-2"></div>
                        <span class="text-sm font-medium">Aptitude</span>
                    </div>
                    <span class="text-sm font-bold">{{ $performanceDetail['student_scores']['aptitude'] }}/{{ $performanceDetail['max_scores']['aptitude'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-[#FF8A3D] h-2 rounded-full" style="width: {{ $performanceDetail['percentages']['aptitude'] }}%"></div>
                </div>
            </div>
            
            <!-- Attitude Score -->
            <div class="mb-4">
                <div class="flex justify-between items-center mb-1">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-[#FFC107] mr-2"></div>
                        <span class="text-sm font-medium">Attitude</span>
                    </div>
                    <span class="text-sm font-bold">{{ $performanceDetail['student_scores']['attitude'] }}/{{ $performanceDetail['max_scores']['attitude'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-[#FFC107] h-2 rounded-full" style="width: {{ $performanceDetail['percentages']['attitude'] }}%"></div>
                </div>
            </div>
            
            <!-- Communication Score -->
            <div class="mb-4">
                <div class="flex justify-between items-center mb-1">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-[#FF8A3D] mr-2"></div>
                        <span class="text-sm font-medium">Communication</span>
                    </div>
                    <span class="text-sm font-bold">{{ $performanceDetail['student_scores']['communication'] }}/{{ $performanceDetail['max_scores']['communication'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-[#FF8A3D] h-2 rounded-full" style="width: {{ $performanceDetail['percentages']['communication'] }}%"></div>
                </div>
            </div>
            
            <!-- Execution Score -->
            <div class="mb-4">
                <div class="flex justify-between items-center mb-1">
                    <div class="flex items-center">
                        <div class="w-3 h-3 rounded-full bg-[#F58321] mr-2"></div>
                        <span class="text-sm font-medium">Execution</span>
                    </div>
                    <span class="text-sm font-bold">{{ $performanceDetail['student_scores']['execution'] }}/{{ $performanceDetail['max_scores']['execution'] }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-[#F58321] h-2 rounded-full" style="width: {{ $performanceDetail['percentages']['execution'] }}%"></div>
                </div>
            </div>
            
            <!-- Total Score -->
            <div class="flex justify-between items-center bg-[#FFF9F5] p-3 rounded-lg mt-5">
                <span class="font-semibold text-gray-700">Total Score:</span>
                <div class="flex items-center">
                    <span class="text-lg font-bold text-[#FF8A3D] mr-2">{{ $performanceDetail['percentages']['total'] }}%</span>
                    <span class="text-sm text-green-600"><i class="fas fa-arrow-up mr-1"></i>3.2%</span>
                </div>
            </div>
        </div>

        <button id="toggleImperativeBtn" class="w-full flex justify-between items-center py-2 px-3 bg-[#FFF9F5] rounded-lg text-gray-800 font-medium">
                    <span>Imperative Attributes</span>
                    <i id="toggleIcon" class="fas fa-chevron-down text-[#FF8A3D]"></i>
                </button>
        <div id="imperativeContent" class=" mt-3">
                    @if(isset($performanceDetail['attribute_scores']['attitude']) && is_array($performanceDetail['attribute_scores']['attitude']))
                    <!-- Attitude Toggle -->
                    <div class="mb-2">
                        <button class="aace-toggle w-full flex justify-between items-center py-2 px-3 bg-gray-100 rounded-lg text-gray-800 font-medium" data-target="attitudeAttributes">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-[#FFC107] mr-2"></div>
                                <span>Attitude ({{ count($performanceDetail['attribute_scores']['attitude']) }})</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>
                        <div id="attitudeAttributes" class="hidden mt-2 pl-5">
                            <!-- Attitude attributes list -->
                            <div class="space-y-3">
                                @foreach($performanceDetail['attribute_scores']['attitude'] as $attributeName => $score)
                                <div class="py-1 border-b border-gray-100">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium">{{ ucwords(str_replace('_', ' ', $attributeName)) }}</span>
                                        <span class="text-xs font-bold text-[#FF8A3D]">{{ $score }}/10</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-[#FFC107] h-1.5 rounded-full" style="width: {{ $score*10 }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($performanceDetail['attribute_scores']['aptitude']) && is_array($performanceDetail['attribute_scores']['aptitude']))
                    <!-- Aptitude Toggle -->
                    <div class="mb-2">
                        <button class="aace-toggle w-full flex justify-between items-center py-2 px-3 bg-gray-100 rounded-lg text-gray-800 font-medium" data-target="aptitudeAttributes">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-[#FF8A3D] mr-2"></div>
                                <span>Aptitude ({{ count($performanceDetail['attribute_scores']['aptitude']) }})</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>
                        <div id="aptitudeAttributes" class="hidden mt-2 pl-5">
                            <!-- Aptitude attributes list -->
                            <div class="space-y-3">
                                @foreach($performanceDetail['attribute_scores']['aptitude'] as $attributeName => $score)
                                <div class="py-1 border-b border-gray-100">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium">{{ ucwords(str_replace('_', ' ', $attributeName)) }}</span>
                                        <span class="text-xs font-bold text-[#FF8A3D]">{{ $score }}/10</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-[#FF8A3D] h-1.5 rounded-full" style="width: {{ $score*10 }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($performanceDetail['attribute_scores']['communication']) && is_array($performanceDetail['attribute_scores']['communication']))
                    <!-- Communication Toggle -->
                    <div class="mb-2">
                        <button class="aace-toggle w-full flex justify-between items-center py-2 px-3 bg-gray-100 rounded-lg text-gray-800 font-medium" data-target="communicationAttributes">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-[#FF8A3D] mr-2"></div>
                                <span>Communication ({{ count($performanceDetail['attribute_scores']['communication']) }})</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>
                        <div id="communicationAttributes" class="hidden mt-2 pl-5">
                            <!-- Communication attributes list -->
                            <div class="space-y-3">
                                @foreach($performanceDetail['attribute_scores']['communication'] as $attributeName => $score)
                                <div class="py-1 border-b border-gray-100">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium">{{ ucwords(str_replace('_', ' ', $attributeName)) }}</span>
                                        <span class="text-xs font-bold text-[#FF8A3D]">{{ $score }}/10</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-[#FF8A3D] h-1.5 rounded-full" style="width: {{ $score*10 }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if(isset($performanceDetail['attribute_scores']['execution']) && is_array($performanceDetail['attribute_scores']['execution']))
                    <!-- Execution Toggle -->
                    <div class="mb-2">
                        <button class="aace-toggle w-full flex justify-between items-center py-2 px-3 bg-gray-100 rounded-lg text-gray-800 font-medium" data-target="executionAttributes">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-[#F58321] mr-2"></div>
                                <span>Execution ({{ count($performanceDetail['attribute_scores']['execution']) }})</span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-500"></i>
                        </button>
                        <div id="executionAttributes" class="hidden mt-2 pl-5">
                            <!-- Execution attributes list -->
                            <div class="space-y-3">
                                @foreach($performanceDetail['attribute_scores']['execution'] as $attributeName => $score)
                                <div class="py-1 border-b border-gray-100">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium">{{ ucwords(str_replace('_', ' ', $attributeName)) }}</span>
                                        <span class="text-xs font-bold text-[#FF8A3D]">{{ $score }}/100</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-[#FF8A3D] h-1.5 rounded-full" style="width: {{ $score }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        
        <!-- Evaluator Comment -->
        <div class="bg-white rounded-xl shadow-md p-5 mb-6">
            <h3 class="font-bold text-lg text-gray-800 mb-3">Evaluator Comment</h3>
            
            <!-- Text Comment -->
            <div class="bg-[#FFF9F5] p-4 rounded-lg border-l-4 border-[#FF8A3D] italic text-gray-600 mb-4">
                "{{ $performanceDetail['feedback'] }}"
            </div>
            
            <!-- Audio Comment -->
            @if($performanceDetail['audio_feedback_url'])
            <div class="mt-4">
                <div class="flex items-center justify-between bg-[#FFF9F5] p-3 rounded-lg border border-[#FF8A3D]/20">
                    <div class="flex items-center">
                        <button id="audioPlayBtn" class="w-10 h-10 bg-[#FF8A3D] rounded-full flex items-center justify-center shadow-md hover:bg-[#E67E35] transition-all duration-200">
                            <i class="fas fa-play text-white"></i>
                        </button>
                        <div class="ml-3">
                            <div class="text-sm font-medium">Audio Feedback</div>
                            <div class="text-xs text-gray-500">1:24 • Recorded yesterday</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Decorative elements -->
    <div class="absolute top-0 right-0 w-24 h-24 bg-[#F58321]/5 rounded-full -mr-8 -mt-8"></div>
    <div class="absolute bottom-0 left-0 w-16 h-16 bg-[#F58321]/5 rounded-full -ml-6 -mb-6"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle Imperative Attributes
    const toggleBtn = document.getElementById('toggleImperativeBtn');
    const toggleIcon = document.getElementById('toggleIcon');
    const imperativeContent = document.getElementById('imperativeContent');
    
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            imperativeContent.classList.toggle('hidden');
            toggleIcon.classList.toggle('fa-chevron-down');
            toggleIcon.classList.toggle('fa-chevron-up');
        });
    }
    
    // Toggle AACE sections
    const aaceToggles = document.querySelectorAll('.aace-toggle');
    aaceToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const targetElement = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (targetElement) {
                targetElement.classList.toggle('hidden');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            }
        });
    });
    
    // Audio player functionality
    const audioPlayBtn = document.getElementById('audioPlayBtn');
    if (audioPlayBtn) {
        audioPlayBtn.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (icon.classList.contains('fa-play')) {
                icon.classList.remove('fa-play');
                icon.classList.add('fa-pause');
                // Add audio play logic here
            } else {
                icon.classList.remove('fa-pause');
                icon.classList.add('fa-play');
                // Add audio pause logic here
            }
        });
    }
});
</script>
@endsection
