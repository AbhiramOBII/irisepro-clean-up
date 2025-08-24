@extends('frontendapp.partials.app')

@section('content')

{{-- Status 1: Sappe - No batch assigned --}}
@if($studentStatus['status'] === 1)
    {{-- New Sappe Design --}}
    <div class="p-4 bg-gradient-to-b from-white to-[#EFCAA6] min-h-screen">
        <!-- Motivational Banner -->
        <div class="mb-6">
            <div class="bg-gradient-to-r from-[#F58321] to-[#FFC107] p-6 rounded-3xl text-white relative overflow-hidden">
                <!-- Background pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-4 right-4 w-16 h-16 border-2 border-white rounded-full"></div>
                    <div class="absolute bottom-4 left-4 w-12 h-12 border-2 border-white rounded-full"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 border border-white rounded-full"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-rocket text-2xl mr-3"></i>
                        <h2 class="text-xl font-bold">Start Your Journey</h2>
                    </div>
                    <p class="text-sm opacity-90 mb-4">Join thousands of students who are transforming their lives through structured challenges and habit building.</p>
                </div>
            </div>
        </div>

        <!-- Available Challenges Section -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-[#F58321]">Available Challenges</h2>
                <button class="text-[#F58321] text-sm font-medium hover:text-[#E67E35] transition-colors">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>

            <!-- Challenge Cards -->
            <div class="space-y-4">
                @if(isset($studentStatus['available_challenges']) && $studentStatus['available_challenges']->count() > 0)
                    @foreach($studentStatus['available_challenges'] as $challenge)
                        <!-- Dynamic Challenge Card -->
                        <div class="challenge-card bg-white rounded-3xl p-5 shadow-card border border-gray-100">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h3 class="font-bold text-gray-800 text-lg">{{ $challenge->challenge_title ?? $challenge->title ?? 'Challenge' }}</h3>
                                    <p class="text-sm text-gray-500">60-Day Challenge</p>
                                </div>
                                <div class="text-[#F58321] font-bold text-lg">₹{{ number_format($challenge->amount) }}</div>
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($challenge->challenge_description ?? $challenge->description ?? 'Transform your life with this amazing challenge.', 80) }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <div class="text-xs text-gray-500">
                                    <i class="fas fa-clock mr-1"></i>
                                    Next batch starts: {{ \Carbon\Carbon::parse($challenge->start_date)->format('M d, Y') }}
                                </div>
                             
                            </div>
                            <hr>
                            <div class="flex items-center justify-between py-2">
                      
                                    <a href="mailto:contact@irisepro.in" class="inline-flex items-center text-[#F58321] hover:text-[#E67E35] transition-colors text-sm font-medium">
                                        <i class="fas fa-envelope mr-2"></i> contact@irisepro.in
                                    </a>
                                    <a href="tel:+918660256342" class="inline-flex items-center text-[#F58321] hover:text-[#E67E35] transition-colors text-sm font-medium">
                                        <i class="fas fa-phone mr-2"></i> +91 8660256342
                                    </a>
                              
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback when no challenges available -->
                    <div class="text-center py-8">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-calendar-times text-3xl"></i>
                        </div>
                        <p class="text-gray-500">No challenges available at the moment.</p>
                        <p class="text-sm text-gray-400">Check back soon for new opportunities!</p>
                    </div>
                @endif
              
            </div>
        </div>

        <!-- Why Choose iRisePro Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-[#F58321] mb-4">Why Choose iRisePro?</h2>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white rounded-2xl p-4 shadow-card text-center">
                    <div class="w-12 h-12 bg-[#FFF5E9] rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-trophy text-[#F58321] text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-sm mb-1">Proven Results</h3>
                    <p class="text-xs text-gray-600">95% completion rate</p>
                </div>
                
                <div class="bg-white rounded-2xl p-4 shadow-card text-center">
                    <div class="w-12 h-12 bg-[#FFF5E9] rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-users text-[#FFC107] text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-sm mb-1">Community</h3>
                    <p class="text-xs text-gray-600">Connect & grow together</p>
                </div>
                
                <div class="bg-white rounded-2xl p-4 shadow-card text-center">
                    <div class="w-12 h-12 bg-[#FFF5E9] rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-chart-line text-[#4CAF50] text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-sm mb-1">Track Progress</h3>
                    <p class="text-xs text-gray-600">Real-time analytics</p>
                </div>
                
                <div class="bg-white rounded-2xl p-4 shadow-card text-center">
                    <div class="w-12 h-12 bg-[#FFF5E9] rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-medal text-[#2196F3] text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 text-sm mb-1">Achievements</h3>
                    <p class="text-xs text-gray-600">Earn badges & rewards</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mb-20">
            <div class="bg-gradient-to-r from-[#F58321] to-[#FFC107] p-6 rounded-3xl text-white text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10">
                    <h3 class="text-xl font-bold mb-2">Ready to Transform?</h3>
                    <p class="text-sm opacity-90 mb-4">Join thousands of students on their journey to success</p>
                    <button class="bg-white text-[#F58321] px-8 py-3 rounded-xl font-bold hover:bg-gray-100 transition-colors shadow-lg">
                        Explore All Challenges
                    </button>
                </div>
            </div>
        </div>
    </div>

{{-- Status 2: Super - Batch assigned but payment unpaid --}}
@elseif($studentStatus['status'] === 2)
    {{-- New Super Design --}}
    <div class="p-4 bg-gradient-to-b from-white to-[#EFCAA6] min-h-screen">
        <!-- Payment Urgency Banner -->
        <div class="mb-6">
            <div class="bg-gradient-to-r from-[#F58321] to-[#FFC107] p-6 rounded-3xl text-white relative overflow-hidden">
                <!-- Background pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-4 right-4 w-16 h-16 border-2 border-white rounded-full"></div>
                    <div class="absolute bottom-4 left-4 w-12 h-12 border-2 border-white rounded-full"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 border border-white rounded-full"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-exclamation-triangle text-2xl mr-3 animate-bounce"></i>
                        <h2 class="text-xl font-bold">Payment Deadline Approaching</h2>
                    </div>
                    <p class="text-sm opacity-90 mb-4">Your spot in the {{ $studentStatus['batch']->title ?? 'Challenge' }} batch is reserved but payment is required to confirm your enrollment.</p>
                    
                    <!-- Countdown Timer -->
                    <div class="bg-white/20 rounded-2xl p-4 backdrop-blur-sm">
                        <div class="text-center">
                            <div class="text-3xl font-bold mb-2" id="countdown-days">
                                {{ isset($studentStatus['batch']['start_date']) ? \Carbon\Carbon::parse($studentStatus['batch']['start_date'])->diffInDays() : 3 }}
                            </div>
                            <div class="text-sm opacity-90">Days left to pay</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
        <!-- Batch Information -->
        <div class="mb-6">
            <div class="bg-white rounded-3xl p-5 shadow-card border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold text-gray-800 text-lg">{{ $studentStatus['batch']->title ?? 'Challenge' }} Batch #{{ $studentStatus['batch']->id }}</h3>
                        <p class="text-sm text-gray-500">{{ $studentStatus['batch']->duration ?? 21 }}-Day Challenge</p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-[#F58321]">₹{{ number_format($studentStatus['payment_details']['amount']) }}</div>
                        <div class="text-xs text-gray-500">One-time payment</div>
                    </div>
                </div>
                
                <div class="bg-[#FFF9F5] rounded-2xl p-4 mb-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt text-[#F58321] mr-2"></i>
                            <span class="text-sm font-medium text-gray-700">Batch starts</span>
                        </div>
                        <span class="text-sm font-bold text-[#F58321]">{{ \Carbon\Carbon::parse($studentStatus['batch']->start_date)->format('M d, Y') }}</span>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="bg-[#FFF9F5] rounded-2xl p-4 mb-4">
                    <div class="text-center mb-3">
                        <i class="fas fa-envelope text-primary text-2xl mb-2"></i>
                        <p class="text-sm text-gray-700 mb-3">Payment link has been sent to your email for making payment.</p>
                    </div>
                    <button class="w-full bg-primary text-white font-semibold py-3 px-6 rounded-xl hover:bg-blue-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-headset mr-2"></i>
                        Contact Support
                    </button>
                </div>
            </div>
        </div>

        <!-- Challenge Benefits -->
        <div class="mb-6">
            <div class="bg-white rounded-3xl p-5 shadow-card border border-gray-100">
                <h3 class="font-bold text-gray-800 text-lg mb-4">What You'll Get</h3>
                <div class="grid grid-cols-1 gap-3">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <span class="text-gray-700 text-sm">{{ $studentStatus['batch']->duration ?? 21 }}-day structured challenge with daily tasks</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <span class="text-gray-700 text-sm">Expert guidance and personalized feedback</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <span class="text-gray-700 text-sm">Progress tracking and performance analytics</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <span class="text-gray-700 text-sm">Community support and networking</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <span class="text-gray-700 text-sm">Certificate of completion</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support Information -->
        <div class="mb-20">
            <div class="bg-[#FFF9F5] rounded-3xl p-5 border border-[#F58321]/20">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-[#F58321] rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-headset text-white text-lg"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-gray-800 mb-2">Need Help with Payment?</h4>
                        <p class="text-gray-600 text-sm mb-3">Our support team is available to assist you with any payment-related queries or technical issues.</p>
                        <div class="flex flex-col gap-3">
                            <a href="mailto:contact@irisepro.in" class="inline-flex items-center text-[#F58321] hover:text-[#E67E35] transition-colors text-sm font-medium">
                                <i class="fas fa-envelope mr-2"></i> contact@irisepro.in
                            </a>
                            <a href="tel:+918660256342" class="inline-flex items-center text-[#F58321] hover:text-[#E67E35] transition-colors text-sm font-medium">
                                <i class="fas fa-phone mr-2"></i> +91 8660256342
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- Status 3: Duper - Batch assigned, payment made, but batch not started --}}
@elseif($studentStatus['status'] === 3)
    {{-- New Duper Design --}}
    
    <div class="p-4 bg-gradient-to-b from-white to-[#EFCAA6] min-h-screen">
        <div class="relative z-10 p-6 bg-white rounded-2xl">
            <!-- Status Banner -->
            <div class="flex items-center justify-center mb-6">
                <div class="bg-gradient-to-r from-primary to-accent px-6 py-3 rounded-2xl shadow-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-rocket text-white text-sm"></i>
                        </div>
                        <div class="text-white">
                            <p class="text-sm font-semibold">Your Journey Begins Soon</p>
                            <p class="text-xs opacity-90">Get ready for an amazing experience</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Batch Information Card -->
            <div class="bg-gradient-to-r from-secondary to-white rounded-2xl p-5 mb-6 border border-primary/10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Batch Details</h3>
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-primary text-lg"></i>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Challenge</span>
                        <span class="text-sm font-semibold text-gray-800">{{ $studentStatus['batch']->title ?? 'Challenge' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Start Date</span>
                        <span class="text-sm font-semibold text-gray-800">{{ \Carbon\Carbon::parse($studentStatus['batch']->start_date)->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Duration</span>
                        <span class="text-sm font-semibold text-gray-800">{{ $studentStatus['batch']->duration ?? 21 }} Days</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Batch ID</span>
                        <span class="text-sm font-semibold text-gray-800">#{{ $studentStatus['batch']->id }}</span>
                    </div>
                </div>
            </div>

            <!-- Minimalistic Countdown Timer -->
            <div class="text-center mb-6">
                <p class="text-sm text-gray-500 mb-4">Starts in</p>
                <div class="flex items-center justify-center space-x-6">
                    <!-- Days -->
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary" id="countdown-days">{{ isset($studentStatus['days_to_start']) ? $studentStatus['days_to_start'] : \Carbon\Carbon::parse($studentStatus['batch']->start_date)->diffInDays() }}</div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide">Days</div>
                    </div>
                    <!-- Separator -->
                    <div class="text-2xl text-gray-300">:</div>
                    <!-- Hours -->
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary" id="countdown-hours">{{ sprintf('%02d', \Carbon\Carbon::parse($studentStatus['batch']->start_date)->diffInHours() % 24) }}</div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide">Hours</div>
                    </div>
                    <!-- Separator -->
                    <div class="text-2xl text-gray-300">:</div>
                    <!-- Minutes -->
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary" id="countdown-minutes">{{ sprintf('%02d', \Carbon\Carbon::parse($studentStatus['batch']->start_date)->diffInMinutes() % 60) }}</div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide">Minutes</div>
                    </div>
                </div>
            </div>

            <!-- Payment Confirmation -->
            <div class="bg-green-50 rounded-2xl p-4 mb-6 border border-green-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-green-800">Payment Confirmed</h4>
                        <p class="text-green-600 text-sm">Amount: ₹{{ number_format($studentStatus['payment_details']['amount'] ?? 0) }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@else

{{-- Status 4: Running - Active batch experience --}}
<div class="main py-2 px-4">

  
    <!-- User greeting card -->
    <div class="bg-[#FEE4D1] rounded-xl p-5 mb-4 shadow-sm relative overflow-hidden transition-all duration-300 hover:shadow-lg hover:bg-gradient-to-r hover:from-[#FEE4D1] hover:to-[#FFD6B8] transform hover:-translate-y-1 cursor-pointer group">
     
    <!-- Decorative circle elements that appear on hover -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#F58321]/5 rounded-full -mr-16 -mt-16 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#F58321]/5 rounded-full -ml-12 -mb-12 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
        
        <div class="flex relative z-10">
            <div class="flex-1 pr-16">
                <div class="text-sm text-primary font-medium mb-1 group-hover:text-[#E57311] transition-colors duration-300">Namaste,</div>
                <div class="text-2xl font-bold text-primary mb-2 group-hover:scale-105 origin-left transition-transform duration-300">{{ $studentStatus['student']['full_name'] ?? 'Student' }}</div>
                <div>
                    <div class="text-sm text-gray-700 group-hover:text-gray-800 transition-colors duration-300">You are killing it.</div>
                    <div class="text-sm text-gray-700 group-hover:text-gray-800 transition-colors duration-300">Your streak is going great!</div>
                </div>
            </div>
            <!-- Character illustration -->
            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-6">
                <!-- GIF image of the character -->

              
                 @if($studentStatus['student']['gender'] == 'male')
                <img src="{{ asset('images/Boy-irisepro.gif') }}" alt="iRisePro Character" class="w-28 h-28 object-contain rounded-xl">
                @else
                <img src="{{ asset('images/Girl-irisepro.gif') }}" alt="iRisePro Character" class="w-28 h-28 object-contain rounded-xl">
                @endif
            </div>
        </div>
    </div>
    
    <!-- Challenge progress section -->
    @if(isset($studentStatus['current_task']) && $studentStatus['current_task']['task'])
        @php
            $currentTask = $studentStatus['current_task']['task'];
            $progress = $studentStatus['current_task']['progress'];
            $batchId = $studentStatus['current_task']['batch'];
        @endphp
        <div class="mb-3 bg-[#FFF1E6] p-5 rounded-xl shadow-sm transition-all duration-300 hover:shadow-lg hover:bg-gradient-to-r hover:from-[#FFF1E6] hover:to-[#FFE8D6] transform hover:-translate-y-1 cursor-pointer group relative overflow-hidden">
            <!-- Decorative elements that appear on hover -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#F58321]/5 rounded-full -mr-16 -mt-16 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
            
            <div class="relative z-10">
                <div class="flex items-start mb-4">
                    <div class="text-base font-medium text-gray-700 group-hover:text-gray-800 transition-colors duration-300">You are on <span class="font-bold text-[#F58321] group-hover:text-[#E57311] transition-colors duration-300">{{ $progress['current_position'] ?? 1 }}{{ $progress['current_position'] == 1 ? 'st' : ($progress['current_position'] == 2 ? 'nd' : ($progress['current_position'] == 3 ? 'rd' : 'th')) }} Task</span> of the {{ $progress['total_count'] ?? 21 }} Task Challenge</div>
                </div>
                <div class="flex items-center justify-between mb-1">
                    <div class="text-xs text-gray-600">{{ $progress['completed_count'] ?? 0 }} of {{ $progress['total_count'] ?? 0 }} completed</div>
                    <div class="text-sm font-bold text-[#F58321] group-hover:scale-110 transition-transform duration-300 origin-right">{{ $progress['percentage'] ?? 0 }}%</div>
                </div>
                <div class="relative">
                    <!-- Track background -->
                    <div class="h-2 w-full bg-white rounded-full overflow-hidden shadow-inner group-hover:bg-gray-50 transition-colors duration-300">
                        <!-- Filled portion -->
                        <div class="h-full bg-[#F58321] rounded-full group-hover:bg-gradient-to-r group-hover:from-[#F58321] group-hover:to-[#FF9D4D] transition-all duration-500" style="width: {{ $progress['percentage'] ?? 0 }}%"></div>
                    </div>
                    
                    <!-- Slider handle -->
                    <div class="absolute top-1/2 transform -translate-y-1/2 -translate-x-1/2 w-5 h-5 bg-[#F58321] rounded-full border-2 border-white shadow-md group-hover:shadow-lg group-hover:scale-110 transition-all duration-300" style="left: {{ $progress['percentage'] ?? 0 }}%">
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Fallback progress section -->
        <div class="mb-3 bg-[#FFF1E6] p-5 rounded-xl shadow-sm">
            <div class="text-base font-medium text-gray-700 mb-4">Challenge Progress</div>
            <div class="text-sm text-gray-600">Loading progress data...</div>
        </div>
    @endif
    
    <!-- Today's tasks section -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-2 p-2">
            <h2 class="text-xl font-bold text-[#F58321]">Today's Task</h2>
            @if(!(isset($studentStatus['current_task']) && isset($studentStatus['current_task']['progress']['all_completed']) && $studentStatus['current_task']['progress']['all_completed']))
            <div class="hourglass-container">
                <img src="{{ asset('images/hour-glass.gif') }}" alt="Hourglass" class="w-12 h-12 object-contain">
            </div>
            @endif
        </div>
        <p class="text-sm text-gray-700 mb-4 pl-2">Complete these tasks to earn points and build your daily streak</p>
        
        <style>
            /* Achievement Celebration Popup Styles */
            .achievement-popup-scale {
                animation: popupScale 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            }
            
            @keyframes popupScale {
                0% { transform: scale(0.3) rotate(-10deg); opacity: 0; }
                50% { transform: scale(1.1) rotate(5deg); opacity: 0.8; }
                100% { transform: scale(1) rotate(0deg); opacity: 1; }
            }
            
            /* Particle Animation */
            .particle {
                position: absolute;
                width: 4px;
                height: 4px;
                background: radial-gradient(circle, #FFD700, #FFA500);
                border-radius: 50%;
                animation: particleFloat 3s infinite ease-in-out;
            }
            
            .particle:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
            .particle:nth-child(2) { top: 20%; right: 15%; animation-delay: 0.3s; }
            .particle:nth-child(3) { bottom: 30%; left: 20%; animation-delay: 0.6s; }
            .particle:nth-child(4) { bottom: 20%; right: 10%; animation-delay: 0.9s; }
            .particle:nth-child(5) { top: 50%; left: 5%; animation-delay: 1.2s; }
            .particle:nth-child(6) { top: 60%; right: 5%; animation-delay: 1.5s; }
            .particle:nth-child(7) { bottom: 50%; left: 50%; animation-delay: 1.8s; }
            .particle:nth-child(8) { top: 30%; right: 50%; animation-delay: 2.1s; }
            .particle:nth-child(9) { bottom: 60%; right: 30%; animation-delay: 2.4s; }
            .particle:nth-child(10) { top: 70%; left: 30%; animation-delay: 2.7s; }
            
            @keyframes particleFloat {
                0%, 100% { transform: translateY(0px) scale(1); opacity: 0.7; }
                50% { transform: translateY(-20px) scale(1.2); opacity: 1; }
            }
            
            /* Confetti Animation */
            .confetti {
                position: absolute;
                width: 6px;
                height: 6px;
                background: linear-gradient(45deg, #FF6B6B, #4ECDC4, #45B7D1, #96CEB4, #FECA57);
                animation: confettiFall 4s infinite linear;
            }
            
            .confetti:nth-child(11) { left: 10%; animation-delay: 0s; background: #FF6B6B; }
            .confetti:nth-child(12) { left: 20%; animation-delay: 0.4s; background: #4ECDC4; }
            .confetti:nth-child(13) { left: 30%; animation-delay: 0.8s; background: #45B7D1; }
            .confetti:nth-child(14) { left: 40%; animation-delay: 1.2s; background: #96CEB4; }
            .confetti:nth-child(15) { left: 50%; animation-delay: 1.6s; background: #FECA57; }
            .confetti:nth-child(16) { left: 60%; animation-delay: 2s; background: #FF9FF3; }
            .confetti:nth-child(17) { left: 70%; animation-delay: 2.4s; background: #54A0FF; }
            .confetti:nth-child(18) { left: 80%; animation-delay: 2.8s; background: #5F27CD; }
            .confetti:nth-child(19) { left: 90%; animation-delay: 3.2s; background: #00D2D3; }
            .confetti:nth-child(20) { left: 15%; animation-delay: 3.6s; background: #FF9F43; }
            
            @keyframes confettiFall {
                0% { transform: translateY(-100vh) rotate(0deg); opacity: 1; }
                100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
            }
            
            /* Sparkle Animation */
            .sparkle {
                position: absolute;
                font-size: 12px;
                animation: sparkleShine 2s infinite ease-in-out;
            }
            
            .sparkle:nth-child(21) { top: 15%; left: 25%; animation-delay: 0s; }
            .sparkle:nth-child(22) { top: 25%; right: 20%; animation-delay: 0.3s; }
            .sparkle:nth-child(23) { bottom: 35%; left: 15%; animation-delay: 0.6s; }
            .sparkle:nth-child(24) { bottom: 25%; right: 25%; animation-delay: 0.9s; }
            .sparkle:nth-child(25) { top: 45%; left: 10%; animation-delay: 1.2s; }
            .sparkle:nth-child(26) { top: 55%; right: 15%; animation-delay: 1.5s; }
            .sparkle:nth-child(27) { bottom: 45%; left: 80%; animation-delay: 1.8s; }
            .sparkle:nth-child(28) { top: 35%; right: 80%; animation-delay: 2.1s; }
            
            @keyframes sparkleShine {
                0%, 100% { transform: scale(0.5) rotate(0deg); opacity: 0.3; }
                50% { transform: scale(1.2) rotate(180deg); opacity: 1; }
            }
            
            /* Radial Burst Effect */
            .radial-burst {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 200px;
                height: 200px;
                pointer-events: none;
            }
            
            .burst-line {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 2px;
                height: 40px;
                background: linear-gradient(to top, transparent, #FFD700, transparent);
                transform-origin: bottom center;
                animation: burstExpand 1.5s ease-out;
            }
            
            .burst-line:nth-child(1) { transform: translate(-50%, -100%) rotate(0deg); }
            .burst-line:nth-child(2) { transform: translate(-50%, -100%) rotate(45deg); }
            .burst-line:nth-child(3) { transform: translate(-50%, -100%) rotate(90deg); }
            .burst-line:nth-child(4) { transform: translate(-50%, -100%) rotate(135deg); }
            .burst-line:nth-child(5) { transform: translate(-50%, -100%) rotate(180deg); }
            .burst-line:nth-child(6) { transform: translate(-50%, -100%) rotate(225deg); }
            .burst-line:nth-child(7) { transform: translate(-50%, -100%) rotate(270deg); }
            .burst-line:nth-child(8) { transform: translate(-50%, -100%) rotate(315deg); }
            
            @keyframes burstExpand {
                0% { height: 0px; opacity: 0; }
                50% { height: 60px; opacity: 1; }
                100% { height: 40px; opacity: 0; }
            }
            
            /* Achievement Badge Styles */
            .achievement-badge-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .achievement-badge {
                position: relative;
                animation: badgePulse 2s infinite ease-in-out;
            }
            
            .badge-glow {
                position: absolute;
                top: -10px;
                left: -10px;
                right: -10px;
                bottom: -10px;
                background: radial-gradient(circle, rgba(255, 215, 0, 0.4), transparent 70%);
                border-radius: 50%;
                animation: glowPulse 2s infinite ease-in-out;
            }
            
            .achievement-badge-svg {
                position: relative;
                z-index: 2;
                filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
            }
            
            .achievement-badge-image {
                position: relative;
                z-index: 2;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(255, 215, 0, 0.2), transparent 70%);
                padding: 8px;
            }
            
            @keyframes badgePulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
            
            @keyframes glowPulse {
                0%, 100% { opacity: 0.6; transform: scale(1); }
                50% { opacity: 1; transform: scale(1.1); }
            }
            
            /* Text Animations */
            .achievement-bounce {
                animation: achievementBounce 1s ease-out;
            }
            
            .achievement-slide-up {
                animation: slideUp 0.8s ease-out 0.3s both;
            }
            
            .achievement-slide-up-delay {
                animation: slideUp 0.8s ease-out 0.6s both;
            }
            
            .achievement-fade-in-slow {
                animation: fadeInSlow 1s ease-out 1s both;
            }
            
            @keyframes achievementBounce {
                0% { transform: translateY(-50px) scale(0.3); opacity: 0; }
                50% { transform: translateY(-10px) scale(1.1); opacity: 0.8; }
                100% { transform: translateY(0) scale(1); opacity: 1; }
            }
            
            @keyframes slideUp {
                0% { transform: translateY(30px); opacity: 0; }
                100% { transform: translateY(0); opacity: 1; }
            }
            
            @keyframes fadeInSlow {
                0% { opacity: 0; }
                100% { opacity: 1; }
            }
            
            /* Carousel Styles */
            .carousel-dots .dot {
                cursor: pointer;
            }
            
            .carousel-dots .dot.active {
                background: white;
                transform: scale(1.2);
            }
            
            .carousel-dots .dot:hover {
                background: rgba(255, 255, 255, 0.8);
                transform: scale(1.1);
            }
            
            /* Responsive adjustments */
            @media (max-width: 640px) {
                .achievement-popup-scale {
                    margin: 1rem;
                    padding: 1.5rem;
                }
                
                .achievement-badge-svg {
                    width: 60px;
                    height: 60px;
                }
                
                .radial-burst {
                    width: 150px;
                    height: 150px;
                }
            }

            .hourglass-container {
                width: 48px;
                height: 48px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .gradient-button {
                background: linear-gradient(93.75deg, #F6821F 2.31%, rgba(246, 130, 31, 0.9) 43.6%, #F9A949 99.5%);
                box-shadow: 0px 4px 8px rgba(246, 130, 31, 0.25);
            }
        </style>
        
        <!-- Background Card to highlight task cards -->
        <div class="relative bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] p-6 rounded-3xl shadow-lg mb-6">
           
        <!-- Decorative elements for the background card -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-[#F58321]/5 rounded-full -mr-10 -mt-10"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-[#F58321]/5 rounded-full -ml-10 -mb-10"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-[#F58321]/3 rounded-full blur-3xl opacity-20"></div>
            
            <!-- Task Cards Container with relative positioning to appear above the background -->
            <div class="space-y-4 relative z-10">
                @if(isset($studentStatus['current_task']) && $studentStatus['current_task']['task'])
                    @php
                        $task = $studentStatus['current_task']['task'];
                        $totalScore = $task->taskScore->total_score ?? 0;
                        $progress = $studentStatus['current_task']['progress'];
                        $batch = $studentStatus['current_task']['batch'];
                    @endphp
                   
                    <!-- Current Task Card - Dynamic from getCurrentTask -->
                    <div class="bg-gradient-to-br from-white to-orange-50 rounded-xl p-6 shadow-xl transform transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl relative overflow-hidden group">
                        <!-- Decorative elements -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#F58321]/5 rounded-full -mr-16 -mt-16 group-hover:bg-[#F58321]/10 transition-all duration-500"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#F58321]/5 rounded-full -ml-12 -mb-12 group-hover:bg-[#F58321]/10 transition-all duration-500"></div>
                        
                        <div class="relative z-10">
                            <!-- Task position and points badges -->
                            <div class="flex justify-between items-start mb-3">
                                <span class="bg-gradient-to-r from-[#F58321] to-[#F9A949] text-white text-sm font-bold px-3 py-1.5 rounded-full shadow-md border-2 border-white transform transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg">{{ intval($totalScore ?? 20) }} pts</span>
                                <span class="bg-blue-500 text-white text-xs font-semibold px-2 py-1 rounded-full">Task {{ $progress['current_position'] ?? 1 }} of {{ $progress['total_count'] ?? 1 }}</span>
                            </div>
                            
                            <!-- Task title with more prominence -->
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $studentStatus['current_task']['task']['task_title'] }}</h3>
                            
                            <!-- Task description -->
                            <p class="text-sm text-gray-500 mb-4">{{ $task->description ?? 'Complete this task to earn points and progress in your challenge' }}</p>
                            
                            <!-- Task duration if available -->
                            @if(isset($task->duration) && $task->duration)
                            <div class="flex items-center text-xs text-gray-600 mb-4">
                                <i class="fas fa-clock mr-1"></i>
                                <span>{{ $task->duration }} minutes</span>
                            </div>
                            @endif
                            
                            <!-- Progress indicator -->
                            <div class="mb-4">
                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                    <span>Challenge Progress</span>
                                    <span>{{ $progress['completed_count'] ?? 0 }}/{{ $progress['total_count'] ?? 1 }} tasks completed</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-[#F58321] to-[#F9A949] h-2 rounded-full transition-all duration-300" style="width: {{ $progress['percentage'] ?? 0 }}%"></div>
                                </div>
                            </div>
                            
                            <!-- Buttons centered for better visual balance -->
                            <div class="flex justify-center">
                                <!-- Start Timer Button - Shows initially, disappears after timer starts -->
                                <button onclick="startTaskTimer('{{ route('mobile.task.details', [$studentStatus['batch']['id'], $task->id]) }}')" 
                                        id="startTimerBtn" 
                                        style="background: linear-gradient(93.75deg, #F6821F 2.31%, rgba(246, 130, 31, 0.9) 43.6%, #F9A949 99.5%); box-shadow: 0px 4px 8px rgba(246, 130, 31, 0.25);" 
                                        class="text-white px-8 py-3 rounded-lg text-sm font-semibold hover:opacity-90 transition-all duration-200 flex items-center">
                                    <i class="fas fa-play mr-2"></i>
                                    Start Timer
                                </button>
                                
                                <!-- Task Details Button - Hidden initially, shows after timer starts -->
                                <a href="{{ route('mobile.task.details', [$studentStatus['batch']['id'], $task->id]) }}" 
                                   id="taskDetailsBtn" 
                                   style="background: linear-gradient(93.75deg, #F6821F 2.31%, rgba(246, 130, 31, 0.9) 43.6%, #F9A949 99.5%); box-shadow: 0px 4px 8px rgba(246, 130, 31, 0.25); display: none;" 
                                   class="text-white px-8 py-3 rounded-lg text-sm font-semibold hover:opacity-90 transition-all duration-200 flex items-center">
                                    Task Details
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @elseif(isset($studentStatus['current_task']) && isset($studentStatus['current_task']['progress']['all_completed']) && $studentStatus['current_task']['progress']['all_completed'])
                    <!-- All Tasks Completed Card -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 shadow-xl relative overflow-hidden">
                        <!-- Decorative elements -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/5 rounded-full -mr-16 -mt-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-green-500/5 rounded-full -ml-12 -mb-12"></div>
                        
                        <div class="relative z-10 text-center">
                            <!-- Success icon -->
                            <div class="mb-4">
                                <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto">
                                    <i class="fas fa-trophy text-white text-2xl"></i>
                                </div>
                            </div>
                            
                            <!-- Congratulations message -->
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Congratulations!</h3>
                            <p class="text-sm text-gray-600 mb-4">You've completed all tasks in this challenge. Great work!</p>
                            
                            <!-- Progress indicator showing 100% -->
                            <div class="mb-4">
                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                    <span>Challenge Progress</span>
                                    <span>{{ $studentStatus['current_task']['progress']['completed_count'] ?? 0 }}/{{ $studentStatus['current_task']['progress']['total_count'] ?? 0 }} tasks completed</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                            
                            <div class="text-green-600 font-semibold">
                                <i class="fas fa-check-circle mr-1"></i>
                                Challenge Complete
                            </div>
                        </div>
                    </div>
                @else
                    <!-- No Tasks Available Card -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 shadow-xl relative overflow-hidden">
                        <div class="text-center">
                            <div class="mb-4">
                                <div class="w-16 h-16 bg-gray-400 rounded-full flex items-center justify-center mx-auto">
                                    <i class="fas fa-tasks text-white text-2xl"></i>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">No Tasks Available</h3>
                            <p class="text-sm text-gray-600">Tasks will appear here when your batch starts.</p>
                        </div>
                    </div>
                @endif
            </div> <!-- End of Task Cards Container -->

            <!-- Single Timer Card - This will start when the user clicks on the start now button -->
            @if(!(isset($studentStatus['current_task']) && isset($studentStatus['current_task']['progress']['all_completed']) && $studentStatus['current_task']['progress']['all_completed']))
            <div class="bg-white rounded-3xl p-4 mt-4 shadow-md hover:shadow-lg transition-all duration-300 border border-[#FFF1E6]">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-[#F58321]/10 flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-[#F58321]"></i>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-gray-800 countdown-timer">24:00:00</div>
                            <div class="text-xs text-gray-500">Time remaining</div>
                        </div>
                    </div>
                    
                </div>
            </div>
            @endif
        </div> <!-- End of Background Card -->
    </div>

    <!-- Display habit selected by the student -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-4 p-2">
            <h2 class="text-xl font-bold text-[#F58321]">Daily Habits</h2>
            <div class="text-sm font-medium text-gray-500">Track your progress</div>
        </div>
        
        <!-- Habits Card -->
        <div class="bg-white rounded-3xl p-6 mb-6 shadow-xl hover:shadow-2xl transition-all duration-300 border border-[#FFF1E6] relative overflow-hidden group">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#F58321]/5 rounded-full -mr-16 -mt-16 group-hover:bg-[#F58321]/10 transition-all duration-500"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#F58321]/5 rounded-full -ml-12 -mb-12 group-hover:bg-[#F58321]/10 transition-all duration-500"></div>
            
            <div class="relative z-10">
                <p class="text-sm text-gray-500 mb-4">Check off your completed habit and share a photo of your progress</p>
                
                @if(isset($studentStatus['student_habits']) && count($studentStatus['student_habits']) > 0)
                    @foreach($studentStatus['student_habits'] as $habit)
                    <!-- Habit Item -->
                    <div class="habit-item flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-[#FFF9F5] transition-all duration-200 mb-3 @if($habit->completed_today) bg-green-50 border-green-200 @endif">
                        <div class="flex items-center">
                            <input type="checkbox" id="habit-{{ $habit->id }}" class="habit-checkbox hidden" @if($habit->completed_today) checked disabled @endif>
                            <label for="habit-{{ $habit->id }}" class="habit-checkbox-label w-6 h-6 border-2 @if($habit->completed_today) border-green-500 bg-green-500 @else border-[#F58321] @endif rounded-md flex items-center justify-center mr-3 @if($habit->can_submit) cursor-pointer @else cursor-not-allowed opacity-50 @endif" data-habit-id="{{ $habit->id }}" data-habit-title="{{ $habit->title ?? 'Daily Habit' }}" @if($habit->can_submit && !$habit->completed_today) onclick="openHabitModal({{ $habit->id }}, '{{ $habit->title ?? 'Daily Habit' }}')" @endif>
                                <i class="fas fa-check text-white @if($habit->completed_today) scale-100 @else scale-0 @endif transition-transform duration-200"></i>
                            </label>
                            <div class="ml-2">
                                <span class="text-gray-800 font-medium">{{ $habit->title ?? 'Daily Habit' }}</span>
                                <div class="text-xs text-gray-500 mt-1">
                                    @if($habit->completed_today)
                                        ✅ Completed! Available again {{ $habit->next_available ? $habit->next_available->format('M j, g:i A') : 'soon' }}
                                    @elseif(!$habit->can_submit)
                                        ⏰ Available again {{ $habit->next_available ? $habit->next_available->format('M j, g:i A') : 'soon' }}
                                    @else
                                        {{ $habit->description ?? 'Complete your daily habit' }}
                                    @endif
                                </div>
                            </div>
                        </div>
                
                    </div>
                    @endforeach
                @else
                    <!-- Default Single Habit Item -->
                    <div class="habit-item flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-[#FFF9F5] transition-all duration-200">
                        <div class="flex items-center">
                            <input type="checkbox" id="habit-1" class="habit-checkbox hidden">
                            <label for="habit-1" class="habit-checkbox-label w-6 h-6 border-2 border-[#F58321] rounded-md flex items-center justify-center mr-6 cursor-pointer" data-habit-id="1" data-habit-title="30 minutes of exercise" onclick="openHabitModal(1, '30 minutes of exercise')">
                                <i class="fas fa-check text-white scale-0 transition-transform duration-200"></i>
                            </label>
                            <div class="ml-2">
                                <span class="text-gray-800 font-medium">30 minutes of exercise</span>
                                <div class="text-xs text-gray-500 mt-1">Complete your daily workout routine</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-[#F58321]/10 rounded-full p-2 mr-2">
                                <i class="fas fa-dumbbell text-[#F58321] text-sm"></i>
                            </div>
                        </div>
                    </div>
                @endif
                
               
            </div>
        </div>
    </div>

    <!-- Habit Submission Modal -->
    <div id="habitModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl p-6 max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="habitModalContent">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-[#F58321] rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-camera text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2" id="habitModalTitle">Complete Your Habit</h3>
                <p class="text-gray-600 text-sm">Take a photo to show your progress and complete this habit</p>
            </div>
            
            <form id="habitSubmissionForm" action="{{ route('habit.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="habitIdInput" name="habit_id" value="">
                <input type="hidden" name="datestamp" value="{{ now() }}">
                
                <!-- Image Upload Area -->
                <div class="mb-6">
                    <div class="border-2 border-dashed border-[#F58321] rounded-xl p-6 text-center hover:bg-[#FFF9F5] transition-colors duration-200" id="imageUploadArea">
                        <input type="file" id="habitImage" name="image" accept="image/*" class="hidden" required>
                        <div id="uploadPrompt">
                            <i class="fas fa-cloud-upload-alt text-[#F58321] text-3xl mb-3"></i>
                            <p class="text-gray-600 mb-2">Click to upload your progress photo</p>
                            <p class="text-xs text-gray-500">JPG, PNG, GIF up to 2MB</p>
                        </div>
                        <div id="imagePreview" class="hidden">
                            <img id="previewImg" src="" alt="Preview" class="max-w-full h-32 object-cover rounded-lg mx-auto mb-2">
                            <p class="text-sm text-gray-600" id="fileName"></p>
                            <button type="button" onclick="clearImage()" class="text-red-500 text-xs hover:text-red-700">Remove</button>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button type="button" onclick="closeHabitModal()" class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-colors duration-200 font-medium">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-[#F58321] text-white rounded-xl hover:bg-[#E5751E] transition-colors duration-200 font-medium" id="submitBtn">
                        <span id="submitText">Complete Habit</span>
                        <i class="fas fa-spinner fa-spin hidden" id="submitSpinner"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Progress Card with Bar Graph -->
    <div class="bg-white rounded-3xl p-6 mb-16 shadow-xl hover:shadow-2xl transition-all duration-300 border border-[#FFF1E6] relative overflow-hidden group">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#F58321]/5 rounded-full -mr-16 -mt-16 group-hover:bg-[#F58321]/10 transition-all duration-500"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#F58321]/5 rounded-full -ml-12 -mb-12 group-hover:bg-[#F58321]/10 transition-all duration-500"></div>
        
        <div class="relative z-10">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Last 8 Tasks Performance</h3>
            
            @php
                // Get last 8 task performances for the student
                $lastTaskPerformances = [];
                if (isset($studentStatus['last_8_tasks'])) {
                    $lastTaskPerformances = $studentStatus['last_8_tasks'];
                } 
                
                else {
                    // Default data if no tasks available
                    $lastTaskPerformances = [
                        ['task_number' => 1, 'percentage' => 0],
                        ['task_number' => 2, 'percentage' => 0],
                        ['task_number' => 3, 'percentage' => 0],
                        ['task_number' => 4, 'percentage' => 0],
                        ['task_number' => 5, 'percentage' => 0],
                        ['task_number' => 6, 'percentage' => 0],
                        ['task_number' => 7, 'percentage' => 0],
                        ['task_number' => 8, 'percentage' => 0],
                    ];
                }
             
                
                // Ensure we have exactly 8 items
                while (count($lastTaskPerformances) < 8) {
                    $lastTaskPerformances[] = ['task_number' => count($lastTaskPerformances) + 1, 'percentage' => 0];
                }
                $lastTaskPerformances = array_slice($lastTaskPerformances, -8);
                
                // Calculate average and best performance
                $completedTasks = array_filter($lastTaskPerformances, function($task) {
                    return $task['percentage'] > 0;
                });
                $totalPercentage = array_sum(array_column($completedTasks, 'percentage'));
                $averagePercentage = count($completedTasks) > 0 ? round($totalPercentage / count($completedTasks), 1) : 0;
                $bestTask = collect($lastTaskPerformances)->sortByDesc('percentage')->first();
                $bestPercentage = $bestTask ? $bestTask['percentage'] : 0;
                $bestTaskNumber = $bestTask ? $bestTask['task_number'] : 1;
            @endphp
            
            <!-- SVG Bar Graph -->
            <svg width="100%" height="180" style="margin-bottom: 16px;">
                <!-- Gradient definition -->
                <defs>
                    <linearGradient id="barGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" style="stop-color:#F58321;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#FF6B35;stop-opacity:1" />
                    </linearGradient>
                </defs>
                
                @foreach($lastTaskPerformances as $index => $task)
                    @php
                        $xPosition = 4 + ($index * 12); // 12% spacing between bars
                        $barHeight = $task['percentage']; // Height as percentage
                        $yPosition = 100 - $barHeight; // Y position (SVG coordinates are inverted)
                        $textY = $yPosition > 10 ? $yPosition - 5 : $yPosition + 15; // Text position
                    @endphp
                    
                    <!-- Task Bar -->
                    <rect x="{{ $xPosition }}%" y="{{ $yPosition }}%" width="6%" height="{{ $barHeight }}%" rx="3" fill="url(#barGradient)" />
                    
                    @if($task['percentage'] > 0)
                        <text x="{{ $xPosition + 3 }}%" y="{{ $textY }}%" text-anchor="middle" font-size="11" font-weight="bold" fill="#F58321">{{ $task['percentage'] }}%</text>
                    @endif
                @endforeach
            </svg>
            
            <!-- Task labels -->
            <div class="flex justify-between mb-4 px-2">
                @foreach($lastTaskPerformances as $task)
                    <span class="text-xs font-medium text-gray-500">T{{ $task['task_number'] }}</span>
                @endforeach
            </div>
            
            <!-- Score Summary -->
            <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                <div>
                    <div class="text-sm text-gray-500">Average Score</div>
                    <div class="text-xl font-bold text-gray-800">{{ $averagePercentage }}%</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500">Best Task</div>
                    <div class="text-xl font-bold text-[#F58321]">Task {{ $bestTaskNumber }} ({{ $bestPercentage }}%)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Photo Upload Modal/Popup -->
<div id="photoUploadModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-6 w-10/12 max-w-sm shadow-2xl transform transition-all duration-300">
        <form id="habitSubmissionForm" action="{{ route('habit.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Share Your Progress</h3>
                <button type="button" id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <p class="text-gray-600 mb-4">Take a photo or upload an image to celebrate completing this habit.</p>
            
            <div id="currentHabitInfo" class="bg-[#FFF9F5] p-3 rounded-xl mb-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-[#F58321] mr-2"></i>
                    <span id="habitName" class="text-gray-800 font-medium">Habit Name</span>
                </div>
            </div>
            
            <input type="hidden" id="habitIdInput" name="habit_id" value="">
            <input type="hidden" name="datestamp" value="{{ now()->toDateTimeString() }}">
            
            <div class="mb-4">
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#F58321] transition-colors duration-200 cursor-pointer" id="dropArea">
                    <input type="file" id="fileInput" name="image" class="hidden" accept="image/*" required>
                    <div id="uploadPlaceholder">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                        <p class="text-gray-500">Drag & drop an image here or click to browse</p>
                        <button type="button" class="mt-3 px-4 py-2 bg-[#F58321] text-white rounded-lg hover:bg-[#E57311] transition-colors duration-200">
                            Select Image
                        </button>
                    </div>
                    <div id="previewContainer" class="hidden">
                        <img id="imagePreview" class="max-h-48 mx-auto rounded-lg">
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancelUpload" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Cancel
                </button>
                <button type="submit" id="submitUpload" class="px-4 py-2 bg-[#F58321] text-white rounded-lg hover:bg-[#E57311] transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

@endif 

<!-- Achievement Celebration Modal -->
<div id="achievementCelebration" onclick="if(event.target === this) hideAchievementPopup()" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="achievement-popup-scale bg-gradient-to-br from-orange-500 via-red-500 to-pink-500 rounded-3xl p-8 max-w-sm w-full mx-4 relative overflow-hidden shadow-2xl">
        <!-- Close Button -->
        <button id="closeAchievement" onclick="hideAchievementPopup()" class="absolute top-4 right-4 w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-all duration-300 z-20">
            <i class="fas fa-times text-sm"></i>
        </button>
        
        <!-- Animated Background Effects -->
        <!-- Particles -->
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        
        <!-- Confetti -->
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        
        <!-- Sparkles -->
        <div class="sparkle">✨</div>
        <div class="sparkle">⭐</div>
        <div class="sparkle">✨</div>
        <div class="sparkle">⭐</div>
        <div class="sparkle">✨</div>
        <div class="sparkle">⭐</div>
        <div class="sparkle">✨</div>
        <div class="sparkle">⭐</div>
        
        <!-- Radial Burst Effect -->
        <div class="radial-burst">
            <div class="burst-line"></div>
            <div class="burst-line"></div>
            <div class="burst-line"></div>
            <div class="burst-line"></div>
            <div class="burst-line"></div>
            <div class="burst-line"></div>
            <div class="burst-line"></div>
            <div class="burst-line"></div>
        </div>
        
        <!-- Main Achievement Content -->
        <div class="relative z-10 text-center p-6">
            <!-- Achievement Unlocked Header -->
            <div class="achievement-header mb-4">
                <div class="text-4xl mb-3 achievement-bounce">🏆</div>
                <h1 class="text-2xl font-bold text-white mb-1 achievement-slide-up" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    <span id="achievementCount">1</span> ACHIEVEMENT
                </h1>
                <h2 class="text-lg font-bold text-yellow-100 achievement-slide-up-delay" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    UNLOCKED!
                </h2>
            </div>
            
            <!-- Achievement Carousel Container -->
            <div class="achievement-carousel-container mb-6 relative">
                <!-- Carousel Wrapper -->
                <div class="achievement-carousel overflow-hidden">
                    <div class="achievement-slides flex transition-transform duration-500 ease-in-out" id="achievementSlides">
                        
                        <!-- Achievement Slide Template (will be populated by JavaScript) -->
                        <div class="achievement-slide flex-shrink-0 w-full">
                            <!-- Achievement Badge with Glow Effect -->
                            <div class="achievement-badge-container mb-4">
                                <div class="achievement-badge">
                                    <div class="badge-glow"></div>
                                    <svg width="80" height="80" viewBox="0 0 120 120" class="achievement-badge-svg">
                                        <defs>
                                            <linearGradient id="badgeGradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" style="stop-color:#FFD700"/>
                                                <stop offset="50%" style="stop-color:#FFA500"/>
                                                <stop offset="100%" style="stop-color:#FF8A3D"/>
                                            </linearGradient>
                                        </defs>
                                        <circle cx="60" cy="60" r="50" fill="url(#badgeGradient1)" stroke="#FFD700" stroke-width="3"/>
                                        <circle cx="60" cy="60" r="35" fill="none" stroke="#FFF" stroke-width="2" opacity="0.8"/>
                                        <text x="60" y="70" text-anchor="middle" font-size="24" fill="white" id="achievementIcon">🌟</text>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Achievement Details -->
                            <div class="achievement-details">
                                <h3 class="text-xl font-bold text-white mb-2" id="achievementName">Achievement Name</h3>
                                <p class="text-sm text-yellow-100 mb-3" id="achievementDescription">Achievement description</p>
                                <div class="text-lg font-bold text-yellow-100" id="achievementThreshold">Threshold reached!</div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Navigation Dots -->
                <div class="carousel-dots flex justify-center mt-4 space-x-2" id="carouselDots">
                    <button class="dot w-2 h-2 rounded-full bg-white/50 transition-all duration-300 active" data-slide="0"></button>
                </div>
                
                <!-- Navigation Arrows (hidden for single achievement) -->
                <button class="carousel-prev absolute left-0 top-1/2 transform -translate-y-1/2 w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-all duration-300 hidden">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button class="carousel-next absolute right-0 top-1/2 transform -translate-y-1/2 w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-all duration-300 hidden">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>
            
            <!-- Motivational Message -->
            <div class="motivational-message mb-6 achievement-fade-in-slow">
                <p class="text-sm text-white/90 italic leading-relaxed">
                    "Outstanding progress! Keep rising!"
                </p>
                <p class="text-xs text-yellow-100 mt-1">
                    🚀 Achievement unlocked
                </p>
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons space-y-3">
                <button id="continueJourney" onclick="hideAchievementPopup()" class="w-full bg-white/20 backdrop-blur-sm text-white font-semibold py-2 px-4 rounded-xl border border-white/30 hover:bg-white/30 transition-all duration-300 text-sm">
                    Continue Journey
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Global variables and functions for achievement popup
let currentSlide = 0;
let totalSlides = 0;
let achievementData = [];
let autoAdvanceInterval = null;

// Global function to hide achievement popup
function hideAchievementPopup() {
    const popup = document.getElementById('achievementCelebration');
    if (popup) {
        popup.classList.add('hidden');
        stopAutoAdvance();
    }
}

// Global function to stop auto advance
function stopAutoAdvance() {
    if (autoAdvanceInterval) {
        clearInterval(autoAdvanceInterval);
        autoAdvanceInterval = null;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Achievement Celebration Popup Functionality

    // Initialize achievement popup if recent achievements exist
    @if(isset($recentAchievements) && count($recentAchievements) > 0)
        achievementData = @json($recentAchievements);
        initializeAchievementPopup();
    @endif

    function initializeAchievementPopup() {
        if (achievementData.length === 0) return;
        
        totalSlides = achievementData.length;
        currentSlide = 0;
        
        // Update achievement count
        document.getElementById('achievementCount').textContent = totalSlides;
        if (totalSlides > 1) {
            document.getElementById('achievementCount').textContent += ' ACHIEVEMENTS';
        } else {
            document.getElementById('achievementCount').textContent += ' ACHIEVEMENT';
        }
        
        // Build carousel slides
        buildCarouselSlides();
        
        // Show the popup
        showAchievementPopup();
        
        // Setup event listeners
        setupAchievementEventListeners();
    }

    function buildCarouselSlides() {
        const slidesContainer = document.getElementById('achievementSlides');
        const dotsContainer = document.getElementById('carouselDots');
        
        // Clear existing content
        slidesContainer.innerHTML = '';
        dotsContainer.innerHTML = '';
        
        // Build slides
        achievementData.forEach((achievement, index) => {
            // Create slide
            const slide = document.createElement('div');
            slide.className = 'achievement-slide flex-shrink-0 w-full';
            slide.innerHTML = `
                <div class="achievement-badge-container mb-4">
                    <div class="achievement-badge">
                        <div class="badge-glow"></div>
                        ${achievement.image ? 
                            `<img src="{{ asset('') }}${achievement.image}" alt="${achievement.title}" class="achievement-badge-image w-20 h-20 object-contain filter drop-shadow-lg" />` :
                            `<svg width="80" height="80" viewBox="0 0 120 120" class="achievement-badge-svg">
                                <defs>
                                    <linearGradient id="badgeGradient${index}" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#FFD700"/>
                                        <stop offset="50%" style="stop-color:#FFA500"/>
                                        <stop offset="100%" style="stop-color:#FF8A3D"/>
                                    </linearGradient>
                                </defs>
                                <circle cx="60" cy="60" r="50" fill="url(#badgeGradient${index})" stroke="#FFD700" stroke-width="3"/>
                                <circle cx="60" cy="60" r="35" fill="none" stroke="#FFF" stroke-width="2" opacity="0.8"/>
                                <text x="60" y="70" text-anchor="middle" font-size="24" fill="white">${getDomainIcon(achievement.domain)}</text>
                            </svg>`
                        }
                    </div>
                </div>
                <div class="achievement-details">
                    <h3 class="text-xl font-bold text-white mb-2">${achievement.title}</h3>
                    <p class="text-sm text-yellow-100 mb-3">${achievement.domain.charAt(0).toUpperCase() + achievement.domain.slice(1)} Domain</p>
                    <div class="text-lg font-bold text-yellow-100">${achievement.threshold}% Threshold Reached!</div>
                </div>
            `;
            slidesContainer.appendChild(slide);
            
            // Create dot
            const dot = document.createElement('button');
            dot.className = `dot w-2 h-2 rounded-full bg-white/50 transition-all duration-300 ${index === 0 ? 'active' : ''}`;
            dot.setAttribute('data-slide', index);
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });
        
        // Show/hide navigation arrows
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');
        
        if (totalSlides > 1) {
            prevBtn.classList.remove('hidden');
            nextBtn.classList.remove('hidden');
            prevBtn.addEventListener('click', previousSlide);
            nextBtn.addEventListener('click', nextSlide);
        } else {
            prevBtn.classList.add('hidden');
            nextBtn.classList.add('hidden');
        }
    }

    function getDomainIcon(domain) {
        const icons = {
            'attitude': '💪',
            'aptitude': '🧠',
            'communication': '💬',
            'execution': '⚡',
            'aace': '🌟',
            'leadership': '👑'
        };
        return icons[domain.toLowerCase()] || '🏆';
    }

    function showAchievementPopup() {
        const popup = document.getElementById('achievementCelebration');
        popup.classList.remove('hidden');
        
        // Auto-advance slides if multiple achievements
        if (totalSlides > 1) {
            startAutoAdvance();
        }
    }

    // Remove duplicate function - using global one now

    function goToSlide(slideIndex) {
        if (slideIndex < 0 || slideIndex >= totalSlides) return;
        
        currentSlide = slideIndex;
        const slidesContainer = document.getElementById('achievementSlides');
        const translateX = -currentSlide * 100;
        slidesContainer.style.transform = `translateX(${translateX}%)`;
        
        // Update dots
        document.querySelectorAll('.dot').forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
    }

    function nextSlide() {
        const nextIndex = (currentSlide + 1) % totalSlides;
        goToSlide(nextIndex);
    }

    function previousSlide() {
        const prevIndex = (currentSlide - 1 + totalSlides) % totalSlides;
        goToSlide(prevIndex);
    }

    function startAutoAdvance() {
        autoAdvanceInterval = setInterval(() => {
            nextSlide();
        }, 4000); // Change slide every 4 seconds
    }

    // Remove duplicate function - using global one now

    function setupAchievementEventListeners() {
        // Close button
        const closeBtn = document.getElementById('closeAchievement');
        if (closeBtn) {
            closeBtn.addEventListener('click', hideAchievementPopup);
        }
        
        // Continue journey button
        const continueBtn = document.getElementById('continueJourney');
        if (continueBtn) {
            continueBtn.addEventListener('click', hideAchievementPopup);
        }
        
        // Close on backdrop click
        const modal = document.getElementById('achievementCelebration');
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    hideAchievementPopup();
                }
            });
        }
        
        // Pause auto-advance on hover
        const popup = document.querySelector('.achievement-popup-scale');
        if (popup) {
            popup.addEventListener('mouseenter', stopAutoAdvance);
            popup.addEventListener('mouseleave', () => {
                if (totalSlides > 1) {
                    startAutoAdvance();
                }
            });
        }
    }

    // Note: Habit click handling is now done via onclick attributes in the HTML
    // This prevents the double popup issue
    let timerInterval = null;
    let timerStartTime = null;
    
    // Initialize timer functionality
    function initTimer() {
        const startTimerBtn = document.getElementById('startTimerBtn');
        const countdownTimer = document.querySelector('.countdown-timer');
        
        if (!startTimerBtn || !countdownTimer) return;
        
        // Check if timer is already running from localStorage
        const savedStartTime = localStorage.getItem('timer_start_time');
        if (savedStartTime) {
            timerStartTime = new Date(savedStartTime);
            startTimer();
            startTimerBtn.textContent = 'Running...';
            startTimerBtn.disabled = true;
            startTimerBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
        
        startTimerBtn.addEventListener('click', function() {
            if (timerStartTime) return; // Timer already running
            
            // Store timer start time
            timerStartTime = new Date();
            localStorage.setItem('timer_start_time', timerStartTime.toISOString());
            
            // Update button state
            this.textContent = 'Running...';
            this.disabled = true;
            this.classList.add('opacity-50', 'cursor-not-allowed');
            
            // Start the countdown
            startTimer();
            
            // Optional: Send to server to store in database
            fetch('/mobile/timer/start', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    start_time: timerStartTime.toISOString()
                })
            }).catch(error => {
                console.log('Timer start logged locally');
            });
        });
    }
    
    function startTimer() {
        if (timerInterval) clearInterval(timerInterval);
        
        const countdownTimer = document.querySelector('.countdown-timer');
        const deadline = new Date(timerStartTime);
        deadline.setHours(deadline.getHours() + 24); // 24 hour timer
        
        function updateTimer() {
            const now = new Date();
            const timeLeft = deadline - now;
            
            if (timeLeft <= 0) {
                countdownTimer.textContent = '00:00:00';
                clearInterval(timerInterval);
                localStorage.removeItem('timer_start_time');
                
                // Reset button
                const startTimerBtn = document.getElementById('startTimerBtn');
                if (startTimerBtn) {
                    startTimerBtn.textContent = 'Start Now';
                    startTimerBtn.disabled = false;
                    startTimerBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
                return;
            }
            
            const hours = Math.floor(timeLeft / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            
            countdownTimer.textContent = 
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        updateTimer();
        timerInterval = setInterval(updateTimer, 1000);
    }
    
    // Initialize timer on page load
    initTimer();
    
    // Check timer state and show appropriate buttons
    checkTimerState();
});

// Handle task timer start
function startTaskTimer(url) {
    console.log('Starting 24-hour timer for task');
    
    // Set timer start time in localStorage
    const startTime = new Date().getTime();
    localStorage.setItem('timer_start_time', startTime);
    
    // Hide Start Timer button and show Task Details button
    document.getElementById('startTimerBtn').style.display = 'none';
    document.getElementById('taskDetailsBtn').style.display = 'flex';
    
    console.log('24-hour timer started at:', new Date(startTime));
    console.log('Buttons toggled - Start Timer hidden, Task Details shown');
}

// Check timer state on page load and show appropriate button
function checkTimerState() {
    const timerStartTime = localStorage.getItem('timer_start_time');
    
    if (timerStartTime) {
        // Timer already started, show Task Details button
        const startBtn = document.getElementById('startTimerBtn');
        const detailsBtn = document.getElementById('taskDetailsBtn');
        
        if (startBtn) startBtn.style.display = 'none';
        if (detailsBtn) detailsBtn.style.display = 'flex';
        
        console.log('Timer already active, showing Task Details button');
    } else {
        // Timer not started, show Start Timer button
        const startBtn = document.getElementById('startTimerBtn');
        const detailsBtn = document.getElementById('taskDetailsBtn');
        
        if (startBtn) startBtn.style.display = 'flex';
        if (detailsBtn) detailsBtn.style.display = 'none';
        
        console.log('No active timer, showing Start Timer button');
    }
}

// Habit Modal Functions
function openHabitModal(habitId, habitTitle) {
    const modal = document.getElementById('habitModal');
    const modalContent = document.getElementById('habitModalContent');
    const modalTitle = document.getElementById('habitModalTitle');
    const habitIdInput = document.getElementById('habitIdInput');
    
    // Set habit data
    habitIdInput.value = habitId;
    modalTitle.textContent = `Complete: ${habitTitle}`;
    
    // Show modal with animation
    modal.classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeHabitModal() {
    const modal = document.getElementById('habitModal');
    const modalContent = document.getElementById('habitModalContent');
    
    // Hide modal with animation
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        clearImage();
    }, 300);
}

// Image upload handling
document.addEventListener('DOMContentLoaded', function() {
    const imageUploadArea = document.getElementById('imageUploadArea');
    const habitImage = document.getElementById('habitImage');
    const uploadPrompt = document.getElementById('uploadPrompt');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const fileName = document.getElementById('fileName');
    const habitModal = document.getElementById('habitModal');
    
    // Only proceed if elements exist
    if (!imageUploadArea || !habitImage || !habitModal) {
        console.log('Habit modal elements not found');
        return;
    }
    
    // Click to upload
    imageUploadArea.addEventListener('click', function() {
        habitImage.click();
    });
    
    // Handle file selection
    habitImage.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 2MB');
                habitImage.value = '';
                return;
            }
            
            // Validate file type
            if (!file.type.match(/^image\/(jpeg|png|jpg|gif)$/)) {
                alert('Please select a valid image file (JPG, PNG, GIF)');
                habitImage.value = '';
                return;
            }
            
            // Show preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                fileName.textContent = file.name;
                uploadPrompt.classList.add('hidden');
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Form submission
    const form = document.getElementById('habitSubmissionForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Validate image is selected
            if (!habitImage.files || habitImage.files.length === 0) {
                e.preventDefault();
                alert('Please select an image to upload');
                return false;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            submitSpinner.classList.remove('hidden');
        });
    }
    
    // Close modal when clicking outside
    habitModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeHabitModal();
        }
    });
    
    // Escape key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !habitModal.classList.contains('hidden')) {
            closeHabitModal();
        }
    });
});

function clearImage() {
    const habitImage = document.getElementById('habitImage');
    const uploadPrompt = document.getElementById('uploadPrompt');
    const imagePreview = document.getElementById('imagePreview');
    
    habitImage.value = '';
    uploadPrompt.classList.remove('hidden');
    imagePreview.classList.add('hidden');
}

</script>
@endpush
