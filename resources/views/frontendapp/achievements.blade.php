@extends('frontendapp.partials.app')

@section('title', 'Achievements')

@section('content')
<!-- Main Content -->
<div class="p-4 bg-gradient-to-b from-white to-[#EFCAA6]">
    <!-- Achievement Stats Card -->
    <div class="bg-[#FEE4D1] rounded-xl p-5 mb-6 shadow-sm relative overflow-hidden transition-all duration-300 hover:shadow-lg hover:bg-gradient-to-r hover:from-[#FEE4D1] hover:to-[#FFD6B8] transform hover:-translate-y-1 cursor-pointer group">
        <!-- Decorative circle elements that appear on hover -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#F58321]/5 rounded-full -mr-16 -mt-16 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#F58321]/5 rounded-full -ml-12 -mb-12 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
        
        <div class="flex relative z-10">
            <div class="flex-1 pr-16">
                <div class="text-sm text-primary font-medium mb-1 group-hover:text-[#E57311] transition-colors duration-300">Achievement Collection</div>
                <div class="text-2xl font-bold text-primary mb-2 group-hover:scale-105 origin-left transition-transform duration-300">My Badges</div>
                <div>
                    <div class="text-sm text-gray-700 group-hover:text-gray-800 transition-colors duration-300">You're making great progress!</div>
                    <div class="flex items-center mt-2">
                        <div class="bg-[#FF8A3D]/10 rounded-full px-3 py-1 text-xs text-[#FF8A3D] font-medium flex items-center">
                            <i class="fas fa-trophy mr-1"></i> {{ $totalUnlocked }} Badges Earned
                        </div>
                        <div class="bg-[#FFC107]/10 rounded-full px-3 py-1 text-xs text-[#FFC107] font-medium flex items-center ml-2">
                            <i class="fas fa-star mr-1"></i> {{ $completionPercentage }}% Complete
                        </div>
                    </div>
                </div>
            </div>
            <!-- Medal illustration -->
            <div class="absolute right-4 top-1/2 transform -translate-y-1/2 transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-6">
                <i class="fas fa-medal text-4xl text-[#FF8A3D]"></i>
            </div>
        </div>
    </div>

    @foreach($achievementsByDomain as $domain => $achievements)
    <!-- {{ ucfirst($domain) }} Achievement Badges Collection -->
    <div class="mb-3 bg-white p-5 rounded-xl shadow-sm transition-all duration-300 hover:shadow-lg hover:bg-gradient-to-r hover:from-white hover:to-[#FFF8F3] transform hover:-translate-y-1 cursor-pointer group relative overflow-hidden">
        <!-- Decorative elements that appear on hover -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#F58321]/5 rounded-full -mr-16 -mt-16 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#F58321]/5 rounded-full -ml-12 -mb-12 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-gray-800">{{ ucfirst($domain) }} Achievement Badges</h3>
                <div class="text-sm font-bold text-[#F58321] group-hover:scale-110 transition-transform duration-300 origin-right">
                    {{ $achievements->where('status', 'unlocked')->count() }}/{{ $achievements->count() }} Unlocked
                </div>
            </div>
            
            <!-- Badge Collection Description -->
            <p class="text-sm text-gray-600 mb-5">Collect all {{ $achievements->count() }} futuristic achievement badges as you progress through your {{ $domain }} transformation journey.</p>
            
            <!-- Badge Grid -->
            <div class="grid grid-cols-3 gap-6">
                @foreach($achievements as $achievement)
                <div class="flex flex-col items-center group/badge cursor-pointer">
                    <div class="relative">
                        <!-- Achievement Badge -->
                        <div class="w-16 h-16 relative transform transition-transform duration-300 group-hover/badge:scale-110">
                            @if($achievement->image && file_exists(public_path($achievement->image)))
                                <img src="{{ asset($achievement->image) }}" alt="{{ $achievement->title }} Badge" 
                                     class="w-full h-full object-contain filter drop-shadow-md 
                                            @if($achievement->status == 'locked') grayscale opacity-60 
                                            @elseif($achievement->status == 'in_progress') opacity-70 
                                            @endif">
                            @else
                                <img src="{{ asset('new-rewards.svg') }}" alt="{{ $achievement->title }} Badge" 
                                     class="w-full h-full object-contain filter drop-shadow-md 
                                            @if($achievement->status == 'locked') grayscale opacity-60 
                                            @elseif($achievement->status == 'in_progress') opacity-70 
                                            @endif">
                            @endif
                            
                            @if($achievement->status == 'unlocked')
                                <!-- Shimmer effect for unlocked badge -->
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent shimmer-animation"></div>
                            @elseif($achievement->status == 'in_progress')
                                <!-- Pulsing border for in-progress -->
                                <div class="absolute inset-0 border-2 border-[#FFC107] animate-pulse-slow"></div>
                            @endif
                        </div>
                        
                        <!-- Badge Status Indicator -->
                        <div class="absolute -bottom-1 -right-1 w-5 h-5 
                                    @if($achievement->status == 'unlocked') bg-[#4CAF50] 
                                    @elseif($achievement->status == 'in_progress') bg-[#FFC107] 
                                    @else bg-gray-500 
                                    @endif 
                                    rounded-full border-2 border-white flex items-center justify-center">
                            @if($achievement->status == 'unlocked')
                                <i class="fas fa-check text-white text-[10px]"></i>
                            @elseif($achievement->status == 'in_progress')
                                <i class="fas fa-spinner fa-spin text-white text-[10px]"></i>
                            @else
                                <i class="fas fa-lock text-white text-[10px]"></i>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Badge Title -->
                    <span class="text-xs font-bold text-gray-800 mt-2">
                        {{ str_replace(ucfirst($domain) . ' ', '', $achievement->title) }}
                    </span>
                    
                    <!-- Badge Status -->
                    <span class="text-[10px] 
                                @if($achievement->status == 'unlocked') text-[#4CAF50] 
                                @elseif($achievement->status == 'in_progress') text-[#FFC107] 
                                @else text-gray-500 
                                @endif">
                        {{ ucfirst(str_replace('_', ' ', $achievement->status)) }}
                    </span>
                    
                    <!-- Badge Threshold -->
                    <span class="text-[10px] text-gray-600">{{ $achievement->threshold }}%</span>
                </div>
                @endforeach
            </div>
            
            <!-- Badge Legend -->
            <div class="mt-6 flex items-center justify-between text-xs text-gray-600">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-[#4CAF50] rounded-full mr-1"></div>
                    <span>Unlocked</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-[#FFC107] rounded-full mr-1"></div>
                    <span>In Progress</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-gray-500 rounded-full mr-1"></div>
                    <span>Locked</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<style>
@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.shimmer-animation {
    animation: shimmer 2s infinite;
}

@keyframes pulse-slow {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.animate-pulse-slow {
    animation: pulse-slow 2s infinite;
}
</style>
@endsection
