@extends('frontendapp.partials.app')

@section('content')

    <!-- Main Content -->
    <div class="p-4 bg-gradient-to-b from-white to-[#EFCAA6] min-h-screen">
        <div
            class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-xl p-5 mb-4 shadow-md relative overflow-hidden transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 cursor-pointer group">
            <!-- Decorative circle elements -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF8A3D]/5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#FF8A3D]/5 rounded-full -ml-12 -mb-12"></div>

            <div class="flex relative z-10">
                <div class="flex-1 pr-16">
                    <div class="text-sm text-gray-800 font-medium mb-1">Leadership Board</div>
                    <div class="text-2xl font-bold text-gray-800 mb-2">{{ strtoupper($student->full_name) }}</div>
                    <div>
                        <div class="text-sm text-gray-600">Your performance is improving!</div>
                        <div class="text-sm text-gray-600 batch-info">Batch:
                            {{ isset($leaderboardData['current_user']['batch_name']) ? $leaderboardData['current_user']['batch_name'] : 'Ongoing' }}
                        </div>
                        <div class="flex items-center mt-2">
                            <div
                                class="bg-[#FF8A3D]/10 rounded-full px-3 py-1 text-xs text-[#FF8A3D] font-medium flex items-center">
                                <i class="fas fa-fire mr-1"></i> <span
                                    class="user-streak">{{ $leaderboardData['current_user']['streak'] }} &nbsp;</span> Day Streak
                            </div>
                            <div
                                class="bg-[#FFC107]/10 rounded-full px-3 py-1 text-xs text-[#FFC107] font-medium flex items-center ml-2">
                                <i class="fas fa-chart-line mr-1"></i> +<span
                                    class="user-improvement">{{ $leaderboardData['current_user']['weekly_improvement'] }} &nbsp;</span>
                                This Week
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Trophy illustration -->
                <div
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-6 bg-[#FF8A3D]/10 rounded-full p-3">
                    <i class="fas fa-trophy text-4xl text-[#FF8A3D]"></i>
                </div>
            </div>
        </div>

        <!-- Filter and Time Period Selection -->
        <div class="flex justify-around items-center mb-4">
            <div class="flex space-x-2">
                <a href="{{ route('mobile.leaderboard', ['period' => '7days']) }}" data-period="7days"
                    class="border text-xs px-3 py-1 rounded-full hover:bg-gray-50
   {{ $timePeriod == '7days' ? 'bg-[#FF8A3D] border-[#FF8A3D] text-white' : 'bg-white border-gray-300 text-black' }}">
                    Last 7 Days
                </a>

                <a href="{{ route('mobile.leaderboard', ['period' => '14days']) }}" data-period="14days"
                    class="border text-xs px-3 py-1 rounded-full hover:bg-gray-50
   {{ $timePeriod == '14days' ? 'bg-[#FF8A3D] border-[#FF8A3D] text-white' : 'bg-white border-gray-300 text-black' }}">
                    14 Days
                </a>

                <a href="{{ route('mobile.leaderboard', ['period' => 'alltime']) }}" data-period="alltime"
                    class="border text-xs px-3 py-1 rounded-full hover:bg-gray-50
   {{ $timePeriod == 'alltime' ? 'bg-[#FF8A3D] border-[#FF8A3D] text-white' : 'bg-white border-gray-300 text-black' }}">
                    Since Beginning
                </a>

            </div>
        </div>

        <!-- User Rank Summary Strip - Enhanced Version -->
        <div class="relative bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] p-6 rounded-3xl shadow-lg mb-6 overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#F58321]/5 rounded-full -mr-10 -mt-10"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-[#F58321]/5 rounded-full -ml-10 -mb-10"></div>

            <!-- User Profile Section -->
            <div class="flex items-center justify-between mb-4 relative z-10">
                <div class="flex items-center">
                    <div class="ml-3">
                        <h3 class="font-bold text-gray-800 text-lg">Your Performance</h3>
                        <p class="text-sm text-gray-600">Leaderboard stats are as <br>of Day
                            {{ isset($leaderboardData['current_user']['day']) ? $leaderboardData['current_user']['day'] : '4' }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center bg-white rounded-xl px-4 py-2 shadow-md stat-card">
                    <span class="text-xs text-gray-500">Overall Rank</span>
                    <div class="flex items-center">
                        <span
                            class="text-2xl font-bold text-[#FF8A3D] user-rank">{{ isset($leaderboardData['current_user']['rank']) && $leaderboardData['current_user']['rank'] ? $leaderboardData['current_user']['rank'] : '-' }}</span>
                        @if (isset($leaderboardData['current_user']['data']) &&
                                isset($leaderboardData['current_user']['data']['change_direction']) &&
                                $leaderboardData['current_user']['data']['change_direction'] == 'up')
                            <div class="flex items-center ml-1 text-green-500">
                                <i class="fas fa-arrow-up text-xs mr-1"></i>
                                <span
                                    class="text-xs user-rank-change">{{ $leaderboardData['current_user']['data']['change_percentage'] ?? '-' }}</span>
                            </div>
                        @elseif(isset($leaderboardData['current_user']['data']) &&
                                isset($leaderboardData['current_user']['data']['change_direction']) &&
                                $leaderboardData['current_user']['data']['change_direction'] == 'down')
                            <div class="flex items-center ml-1 text-red-500">
                                <i class="fas fa-arrow-down text-xs mr-1"></i>
                                <span
                                    class="text-xs">{{ $leaderboardData['current_user']['data']['change_percentage'] ?? '-' }}</span>
                            </div>
                        @else
                            <!-- No change data available -->
                        @endif
                    </div>
                </div>
            </div>

            <!-- Row 1: Aptitude and Attitude -->
            <div class="grid grid-cols-2 gap-4 mb-4 relative z-10">
                <!-- Aptitude Rank -->
                <div class="bg-white rounded-xl p-4 text-center shadow-md transform transition-transform hover:scale-105">
                    <div class="w-10 h-10 bg-[#FF8A3D]/10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-brain text-[#FF8A3D]"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Aptitude</p>
                    <div class="flex items-center justify-center">
                        @if (isset($leaderboardData['current_user']['aace_ranks']['aptitude']['rank']) && $leaderboardData['current_user']['aace_ranks']['aptitude']['rank'])
                            <span class="text-xl font-bold text-[#FF8A3D] mr-1 aptitude-rank">{{ $leaderboardData['current_user']['aace_ranks']['aptitude']['rank'] }}</span>
                            @if (isset($leaderboardData['current_user']['aace_ranks']['aptitude']['change_direction']) && isset($leaderboardData['current_user']['aace_ranks']['aptitude']['change_value']) && $leaderboardData['current_user']['aace_ranks']['aptitude']['change_direction'] == 'up')
                                <div class="flex items-center text-green-500">
                                    <i class="fas fa-arrow-up text-xs"></i>
                                    <span class="text-xs aptitude-change">{{ $leaderboardData['current_user']['aace_ranks']['aptitude']['change_value'] }}</span>
                                </div>
                            @elseif(isset($leaderboardData['current_user']['aace_ranks']['aptitude']['change_direction']) && isset($leaderboardData['current_user']['aace_ranks']['aptitude']['change_value']) && $leaderboardData['current_user']['aace_ranks']['aptitude']['change_direction'] == 'down')
                                <div class="flex items-center text-red-500">
                                    <i class="fas fa-arrow-down text-xs"></i>
                                    <span class="text-xs">{{ $leaderboardData['current_user']['aace_ranks']['aptitude']['change_value'] }}</span>
                                </div>
                            @endif
                        @else
                            <span class="text-xl font-bold text-[#FF8A3D]">-</span>
                        @endif
                    </div>
                </div>

                <!-- Attitude Rank -->
                <div class="bg-white rounded-xl p-4 text-center shadow-md transform transition-transform hover:scale-105">
                    <div class="w-10 h-10 bg-[#FF8A3D]/10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-smile text-[#FF8A3D]"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Attitude</p>
                    <div class="flex items-center justify-center">
                        @if (isset($leaderboardData['current_user']['aace_ranks']['attitude']['rank']) && $leaderboardData['current_user']['aace_ranks']['attitude']['rank'])
                            <span class="text-xl font-bold text-[#FF8A3D] mr-1 attitude-rank">{{ $leaderboardData['current_user']['aace_ranks']['attitude']['rank'] }}</span>
                            @if (isset($leaderboardData['current_user']['aace_ranks']['attitude']['change_direction']) && isset($leaderboardData['current_user']['aace_ranks']['attitude']['change_value']) && $leaderboardData['current_user']['aace_ranks']['attitude']['change_direction'] == 'up')
                                <div class="flex items-center text-green-500">
                                    <i class="fas fa-arrow-up text-xs"></i>
                                    <span class="text-xs attitude-change">{{ $leaderboardData['current_user']['aace_ranks']['attitude']['change_value'] }}</span>
                                </div>
                            @elseif(isset($leaderboardData['current_user']['aace_ranks']['attitude']['change_direction']) && isset($leaderboardData['current_user']['aace_ranks']['attitude']['change_value']) && $leaderboardData['current_user']['aace_ranks']['attitude']['change_direction'] == 'down')
                                <div class="flex items-center text-red-500">
                                    <i class="fas fa-arrow-down text-xs"></i>
                                    <span class="text-xs">{{ $leaderboardData['current_user']['aace_ranks']['attitude']['change_value'] }}</span>
                                </div>
                            @endif
                        @else
                            <span class="text-xl font-bold text-[#FF8A3D]">-</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Row 2: Communication and Execution -->
            <div class="grid grid-cols-2 gap-4 mb-4 relative z-10">
                <!-- Communication Rank -->
                <div class="bg-white rounded-xl p-4 text-center shadow-md transform transition-transform hover:scale-105">
                    <div class="w-10 h-10 bg-[#FF8A3D]/10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-comments text-[#FF8A3D]"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Communication</p>
                    <div class="flex items-center justify-center">
                        @if (isset($leaderboardData['current_user']['aace_ranks']['communication']['rank']) && $leaderboardData['current_user']['aace_ranks']['communication']['rank'])
                            <span class="text-xl font-bold text-[#FF8A3D] mr-1 communication-rank">{{ $leaderboardData['current_user']['aace_ranks']['communication']['rank'] }}</span>
                            @if (isset($leaderboardData['current_user']['aace_ranks']['communication']['change_direction']) && isset($leaderboardData['current_user']['aace_ranks']['communication']['change_value']) && $leaderboardData['current_user']['aace_ranks']['communication']['change_direction'] == 'up')
                                <div class="flex items-center text-green-500">
                                    <i class="fas fa-arrow-up text-xs"></i>
                                    <span class="text-xs communication-change">{{ $leaderboardData['current_user']['aace_ranks']['communication']['change_value'] }}</span>
                                </div>
                            @elseif(isset($leaderboardData['current_user']['aace_ranks']['communication']['change_direction']) && isset($leaderboardData['current_user']['aace_ranks']['communication']['change_value']) && $leaderboardData['current_user']['aace_ranks']['communication']['change_direction'] == 'down')
                                <div class="flex items-center text-red-500">
                                    <i class="fas fa-arrow-down text-xs"></i>
                                    <span class="text-xs">{{ $leaderboardData['current_user']['aace_ranks']['communication']['change_value'] }}</span>
                                </div>
                            @endif
                        @else
                            <span class="text-xl font-bold text-[#FF8A3D]">-</span>
                        @endif
                    </div>
                </div>

                <!-- Execution Rank -->
                <div class="bg-white rounded-xl p-4 text-center shadow-md transform transition-transform hover:scale-105">
                    <div class="w-10 h-10 bg-[#FF8A3D]/10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-tasks text-[#FF8A3D]"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Execution</p>
                    <div class="flex items-center justify-center">
                        @if (isset($leaderboardData['current_user']['aace_ranks']['execution']['rank']) && $leaderboardData['current_user']['aace_ranks']['execution']['rank'])
                            <span class="text-xl font-bold text-[#FF8A3D] mr-1 execution-rank">{{ $leaderboardData['current_user']['aace_ranks']['execution']['rank'] }}</span>
                            @if (isset($leaderboardData['current_user']['aace_ranks']['execution']['change_direction']) && isset($leaderboardData['current_user']['aace_ranks']['execution']['change_value']) && $leaderboardData['current_user']['aace_ranks']['execution']['change_direction'] == 'up')
                                <div class="flex items-center text-green-500">
                                    <i class="fas fa-arrow-up text-xs"></i>
                                    <span class="text-xs">{{ $leaderboardData['current_user']['aace_ranks']['execution']['change_value'] }}</span>
                                </div>
                            @elseif(isset($leaderboardData['current_user']['aace_ranks']['execution']['change_direction']) && isset($leaderboardData['current_user']['aace_ranks']['execution']['change_value']) && $leaderboardData['current_user']['aace_ranks']['execution']['change_direction'] == 'down')
                                <div class="flex items-center text-red-500">
                                    <i class="fas fa-arrow-down text-xs"></i>
                                    <span class="text-xs">{{ $leaderboardData['current_user']['aace_ranks']['execution']['change_value'] }}</span>
                                </div>
                            @endif
                        @else
                            <span class="text-xl font-bold text-[#FF8A3D]">-</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Row 3: Empathy -->
            <div class="flex justify-center mt-4 relative z-10">
                <!-- Empathy Rank -->
                <div
                    class="bg-white rounded-xl p-4 text-center shadow-md transform transition-transform hover:scale-105 w-1/2">
                    <div class="w-10 h-10 bg-[#FF8A3D]/10 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-heart text-[#FF8A3D]"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Empathy</p>
                    <div class="flex items-center justify-center">
                        @if (isset($leaderboardData['current_user']['aace_ranks']['empathy']['rank']) && $leaderboardData['current_user']['aace_ranks']['empathy']['rank'])
                            <span class="text-xl font-bold text-[#FF8A3D] mr-1 empathy-rank">{{ $leaderboardData['current_user']['aace_ranks']['empathy']['rank'] }}</span>
                            @if (isset($leaderboardData['current_user']['aace_ranks']['empathy']['change_direction']) && isset($leaderboardData['current_user']['aace_ranks']['empathy']['change_value']) && $leaderboardData['current_user']['aace_ranks']['empathy']['change_direction'] == 'up')
                                <div class="flex items-center text-green-500">
                                    <i class="fas fa-arrow-up text-xs"></i>
                                    <span class="text-xs empathy-change">{{ $leaderboardData['current_user']['aace_ranks']['empathy']['change_value'] }}</span>
                                </div>
                            @elseif(isset($leaderboardData['current_user']['aace_ranks']['empathy']['change_direction']) && isset($leaderboardData['current_user']['aace_ranks']['empathy']['change_value']) && $leaderboardData['current_user']['aace_ranks']['empathy']['change_direction'] == 'down')
                                <div class="flex items-center text-red-500">
                                    <i class="fas fa-arrow-down text-xs"></i>
                                    <span class="text-xs">{{ $leaderboardData['current_user']['aace_ranks']['empathy']['change_value'] }}</span>
                                </div>
                            @endif
                        @else
                            <span class="text-xl font-bold text-[#FF8A3D]">-</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Performers Section -->
        @if(isset($leaderboardData['top_performers']) && count($leaderboardData['top_performers']) > 0)
        <div class="relative bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] p-6 rounded-3xl shadow-lg mb-4 overflow-hidden top-performers-container">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-[#F58321]/5 rounded-full -mr-10 -mt-10"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-[#F58321]/5 rounded-full -ml-10 -mb-10"></div>
            
            <h3 class="text-lg font-bold text-center text-gray-800 mb-6 relative z-10">Top Performers</h3>
            
            <!-- Custom Animation Styles -->
            <style>
                @keyframes pulse-gold {
                    0% { box-shadow: 0 0 0 0 rgba(255, 215, 0, 0.7); }
                    70% { box-shadow: 0 0 0 10px rgba(255, 215, 0, 0); }
                    100% { box-shadow: 0 0 0 0 rgba(255, 215, 0, 0); }
                }
                
                @keyframes pulse-silver {
                    0% { box-shadow: 0 0 0 0 rgba(192, 192, 192, 0.7); }
                    70% { box-shadow: 0 0 0 8px rgba(192, 192, 192, 0); }
                    100% { box-shadow: 0 0 0 0 rgba(192, 192, 192, 0); }
                }
                
                @keyframes pulse-bronze {
                    0% { box-shadow: 0 0 0 0 rgba(205, 127, 50, 0.7); }
                    70% { box-shadow: 0 0 0 8px rgba(205, 127, 50, 0); }
                    100% { box-shadow: 0 0 0 0 rgba(205, 127, 50, 0); }
                }
                
                @keyframes float {
                    0%, 100% { transform: translateY(0); }
                    50% { transform: translateY(-10px); }
                }
                
                /* Glow effects for medals */
                .gold-glow {
                    box-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
                    transition: box-shadow 0.3s ease;
                    animation: pulse-gold 2s infinite;
                }
                
                .silver-glow {
                    box-shadow: 0 0 8px rgba(192, 192, 192, 0.5);
                    transition: box-shadow 0.3s ease;
                    animation: pulse-silver 2.5s infinite;
                }
                
                .bronze-glow {
                    box-shadow: 0 0 8px rgba(205, 127, 50, 0.5);
                    transition: box-shadow 0.3s ease;
                    animation: pulse-bronze 3s infinite;
                }
                
                /* Podium grow animation */
                @keyframes grow-podium {
                    from { transform: scaleY(0); }
                    to { transform: scaleY(1); }
                }
                
                /* Fade in animation */
                .animate-fade-in {
                    opacity: 0;
                    animation: fadeIn 0.5s forwards;
                }
                
                @keyframes fadeIn {
                    to { opacity: 1; }
                }
                
                /* Float animation for avatar containers */
                .float-animation {
                    animation: float 3s ease-in-out infinite;
                }
                
                /* Grow animation for podium bars */
                .grow-animation {
                    transform-origin: bottom;
                    animation: grow-podium 1s ease-out forwards;
                }
                
                /* Confetti styles */
                .confetti {
                    width: 8px;
                    height: 8px;
                    border-radius: 50%;
                    position: absolute;
                    z-index: 1;
                    opacity: 0.8;
                }
            </style>

            <!-- Podium Display -->
            <div class="flex items-end justify-center space-x-4 relative z-10 mb-4">
                @php 
                    // Get top 3 performers
                    $topThree = array_slice($leaderboardData['top_performers'], 0, 3);
                    
                    // Define medal styles for each position
                    $medalStyles = [
                        1 => [
                            'avatar_size' => 'h-20 w-20',
                            'border' => 'border-[#FFD700]',
                            'glow' => 'gold-glow',
                            'badge_bg' => 'bg-[#FFD700]',
                            'badge_size' => 'w-7 h-7',
                            'podium_height' => 'h-24',
                            'podium_bg' => 'bg-[#FFD700]',
                            'delay' => '0s',
                            'icon' => '<i class="fas fa-crown text-[#FFD700] text-xl"></i>',
                            'icon_class' => 'absolute -top-4 left-1/2 transform -translate-x-1/2 animate-bounce',
                            'icon_style' => 'animation-duration: 1.5s',
                            'default_initials' => '--'
                        ],
                        2 => [
                            'avatar_size' => 'h-16 w-16',
                            'border' => 'border-[#C0C0C0]',
                            'glow' => 'silver-glow',
                            'badge_bg' => 'bg-[#C0C0C0]',
                            'badge_size' => 'w-6 h-6',
                            'podium_height' => 'h-16',
                            'podium_bg' => 'bg-[#C0C0C0]',
                            'delay' => '0.2s',
                            'icon' => '<i class="fas fa-medal text-[#C0C0C0] text-lg"></i>',
                            'icon_class' => 'absolute -top-2 -right-2 transform rotate-12 animate-bounce',
                            'icon_style' => 'animation-duration: 2s',
                            'default_initials' => '--'
                        ],
                        3 => [
                            'avatar_size' => 'h-14 w-14',
                            'border' => 'border-[#CD7F32]',
                            'glow' => 'bronze-glow',
                            'badge_bg' => 'bg-[#CD7F32]',
                            'badge_size' => 'w-6 h-6',
                            'podium_height' => 'h-12',
                            'podium_bg' => 'bg-[#CD7F32]',
                            'delay' => '0.4s',
                            'icon' => '<i class="fas fa-award text-[#CD7F32] text-lg"></i>',
                            'icon_class' => 'absolute -top-1 -right-1 transform -rotate-12 animate-bounce',
                            'icon_style' => 'animation-duration: 2.2s',
                            'default_initials' => '--'
                        ]
                    ];
                @endphp
                
                <!-- 2nd Place -->
                <div class="flex flex-col items-center top-performer top-2">
                    <div class="relative float-animation" style="animation-delay: {{ $medalStyles[2]['delay'] }}">
                        <div class="{{ $medalStyles[2]['avatar_size'] }} rounded-full bg-white p-1 border-2 {{ $medalStyles[2]['border'] }} mb-2 {{ $medalStyles[2]['glow'] }}">
                            @if(isset($topThree[1]['profile_picture']) && $topThree[1]['profile_picture'])
                                <img src="{{ $topThree[1]['profile_picture'] }}" alt="{{ $topThree[1]['name'] ?? 'Top Performer' }}" class="w-full h-full rounded-full object-cover">
                            @else
                                @php
                                    $initials = isset($topThree[1]['name']) ? 
                                        substr($topThree[1]['name'], 0, 1) . (strpos($topThree[1]['name'], ' ') !== false ? substr(strrchr($topThree[1]['name'], ' '), 1, 1) : '') : 
                                        $medalStyles[2]['default_initials'];
                                @endphp
                                <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-500 text-lg font-bold">{{ $initials }}</span>
                                </div>
                            @endif
                            <div class="absolute -bottom-1 -right-1 {{ $medalStyles[2]['badge_bg'] }} text-white rounded-full {{ $medalStyles[2]['badge_size'] }} flex items-center justify-center text-xs font-bold border-2 border-white">2</div>
                        </div>
                        <!-- Silver medal icon -->
                        <div class="{!! $medalStyles[2]['icon_class'] !!}" style="{!! $medalStyles[2]['icon_style'] !!}">
                            {!! $medalStyles[2]['icon'] !!}
                        </div>
                    </div>
                    <p class="text-xs font-semibold text-gray-800">
                        @if(isset($topThree[1]['name']))
                            {{ explode(' ', $topThree[1]['name'])[0] }} {{ isset(explode(' ', $topThree[1]['name'])[1]) ? substr(explode(' ', $topThree[1]['name'])[1], 0, 1) . '.' : '' }}
                        @else
                            -
                        @endif
                    </p>
                    <p class="text-xs font-bold text-[#F58321]">
                        {{ isset($topThree[1]['score_percentage']) ? $topThree[1]['score_percentage'] . '%' : '-' }}
                    </p>
                    <div class="w-12 {{ $medalStyles[2]['podium_height'] }} {{ $medalStyles[2]['podium_bg'] }} rounded-t-lg mt-2 grow-animation" style="animation-delay: 0.3s;"></div>
                </div>
                
                <!-- 1st Place -->
                <div class="flex flex-col items-center top-performer top-1">
                    <div class="relative float-animation">
                        <div class="{{ $medalStyles[1]['avatar_size'] }} rounded-full bg-white p-1 border-2 {{ $medalStyles[1]['border'] }} mb-2 {{ $medalStyles[1]['glow'] }}">
                            @if(isset($topThree[0]['profile_picture']) && $topThree[0]['profile_picture'])
                                <img src="{{ $topThree[0]['profile_picture'] }}" alt="{{ $topThree[0]['name'] ?? 'Top Performer' }}" class="w-full h-full rounded-full object-cover">
                            @else
                                @php
                                    $initials = isset($topThree[0]['name']) ? 
                                        substr($topThree[0]['name'], 0, 1) . (strpos($topThree[0]['name'], ' ') !== false ? substr(strrchr($topThree[0]['name'], ' '), 1, 1) : '') : 
                                        $medalStyles[1]['default_initials'];
                                @endphp
                                <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-500 text-lg font-bold">{{ $initials }}</span>
                                </div>
                            @endif
                            <div class="absolute -bottom-1 -right-1 {{ $medalStyles[1]['badge_bg'] }} text-white rounded-full {{ $medalStyles[1]['badge_size'] }} flex items-center justify-center text-xs font-bold border-2 border-white">1</div>
                        </div>
                        <!-- Crown icon -->
                        <div class="{!! $medalStyles[1]['icon_class'] !!}" style="{!! $medalStyles[1]['icon_style'] !!}">
                            {!! $medalStyles[1]['icon'] !!}
                        </div>
                        <!-- Confetti elements -->
                        <div class="confetti bg-[#FFD700] absolute -top-3 -left-3" style="animation: float 3s infinite ease-in-out; transform: rotate(15deg);"></div>
                        <div class="confetti bg-[#FF8A3D] absolute -top-2 left-5" style="animation: float 2.5s infinite ease-in-out; transform: rotate(-20deg);"></div>
                        <div class="confetti bg-[#FFC107] absolute top-0 right-0" style="animation: float 2.8s infinite ease-in-out; transform: rotate(35deg);"></div>
                    </div>
                    <p class="text-xs font-semibold text-gray-800">
                        @if(isset($topThree[0]['name']))
                            {{ explode(' ', $topThree[0]['name'])[0] }} {{ isset(explode(' ', $topThree[0]['name'])[1]) ? substr(explode(' ', $topThree[0]['name'])[1], 0, 1) . '.' : '' }}
                        @else
                            -
                        @endif
                    </p>
                    <p class="text-xs font-bold text-[#F58321]">
                        {{ isset($topThree[0]['score_percentage']) ? $topThree[0]['score_percentage'] . '%' : '-' }}
                    </p>
                    <div class="w-12 {{ $medalStyles[1]['podium_height'] }} {{ $medalStyles[1]['podium_bg'] }} rounded-t-lg mt-2 grow-animation" style="animation-delay: 0.1s;"></div>
                </div>
                
                <!-- 3rd Place -->
                <div class="flex flex-col items-center top-performer top-3">
                    <div class="relative float-animation" style="animation-delay: {{ $medalStyles[3]['delay'] }}">
                        <div class="{{ $medalStyles[3]['avatar_size'] }} rounded-full bg-white p-1 border-2 {{ $medalStyles[3]['border'] }} mb-2 {{ $medalStyles[3]['glow'] }}">
                            @if(isset($topThree[2]['profile_picture']) && $topThree[2]['profile_picture'])
                                <img src="{{ $topThree[2]['profile_picture'] }}" alt="{{ $topThree[2]['name'] ?? 'Top Performer' }}" class="w-full h-full rounded-full object-cover">
                            @else
                                @php
                                    $initials = isset($topThree[2]['name']) ? 
                                        substr($topThree[2]['name'], 0, 1) . (strpos($topThree[2]['name'], ' ') !== false ? substr(strrchr($topThree[2]['name'], ' '), 1, 1) : '') : 
                                        $medalStyles[3]['default_initials'];
                                @endphp
                                <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-500 text-lg font-bold">{{ $initials }}</span>
                                </div>
                            @endif
                            <div class="absolute -bottom-1 -right-1 {{ $medalStyles[3]['badge_bg'] }} text-white rounded-full {{ $medalStyles[3]['badge_size'] }} flex items-center justify-center text-xs font-bold border-2 border-white">3</div>
                        </div>
                        <!-- Bronze medal icon -->
                        <div class="{!! $medalStyles[3]['icon_class'] !!}" style="{!! $medalStyles[3]['icon_style'] !!}">
                            {!! $medalStyles[3]['icon'] !!}
                        </div>
                    </div>
                    <p class="text-xs font-semibold text-gray-800">
                        @if(isset($topThree[2]['name']))
                            {{ explode(' ', $topThree[2]['name'])[0] }} {{ isset(explode(' ', $topThree[2]['name'])[1]) ? substr(explode(' ', $topThree[2]['name'])[1], 0, 1) . '.' : '' }}
                        @else
                            -
                        @endif
                    </p>
                    <p class="text-xs font-bold text-[#F58321]">
                        {{ isset($topThree[2]['score_percentage']) ? $topThree[2]['score_percentage'] . '%' : '-' }}
                    </p>
                    <div class="w-12 {{ $medalStyles[3]['podium_height'] }} {{ $medalStyles[3]['podium_bg'] }} rounded-t-lg mt-2 grow-animation" style="animation-delay: 0.5s;"></div>
                </div>
            </div>
            </div>
        </div>
        @endif

        <!-- Leaderboard List -->
        @if(isset($leaderboardData['entries']) && count($leaderboardData['entries']) > 0)
        <div class="bg-white rounded-xl shadow-md overflow-hidden mx-4 mb-4 ">
            <div class="p-5 bg-[#FFF9F5] border-b border-gray-100">
                <h3 class="font-bold text-gray-800 text-lg">All Participants</h3>
            </div>

            <!-- Participant Rows - Only show participants ranked 4th and below -->
            <div class="divide-y divide-gray-100 participants-list">
                @foreach ($leaderboardData['entries'] as $entry)
                    @if ($entry['rank'] > 3)
                        <div
                            class="p-4 flex items-center {{ $entry['is_current_user'] ? 'bg-[#FFF9F5] border-l-4 border-[#FF8A3D] rounded-lg shadow-md relative overflow-hidden hover:scale-[1.01] transition-transform duration-300' : 'hover:bg-gray-50' }}">
                            @if ($entry['is_current_user'])
                                <!-- Decorative elements for current user row -->
                                <div class="absolute top-0 right-0 w-20 h-20 bg-[#F58321]/5 rounded-full -mr-5 -mt-5">
                                </div>
                                <div class="absolute bottom-0 left-0 w-12 h-12 bg-[#F58321]/5 rounded-full -ml-2 -mb-2">
                                </div>
                            @endif

                            <div class="w-8 text-center relative">
                                <div
                                    class="{{ $entry['rank'] <= 3 ? 'font-bold text-[#FF8A3D]' : 'font-bold text-gray-500' }} flex items-center justify-center">
                                    <span>{{ $entry['rank'] }}</span>
                                    @if ($entry['change_direction'] == 'up')
                                        <div class="ml-1 bg-green-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center shadow-sm"
                                            title="Moved up {{ isset($entry['change_percentage']) && $entry['change_percentage'] ? $entry['change_percentage'] : '-' }} positions">
                                            <span>+{{ isset($entry['change_percentage']) && $entry['change_percentage'] ? $entry['change_percentage'] : '-' }}</span>
                                        </div>
                                    @elseif($entry['change_direction'] == 'down')
                                        <i class="fas fa-arrow-down ml-1 text-xs text-red-500"></i>
                                    @else
                                        <i class="fas fa-minus ml-1 text-xs text-gray-400"></i>
                                    @endif
                                </div>
                            </div>
                            <div
                                class="w-10 h-10 rounded-full {{ $entry['is_current_user'] ? 'bg-gradient-to-br from-[#FF8A3D] to-[#FFC107] p-0.5 shadow-md' : 'bg-gray-100' }} mx-3">
                                @if ($entry['profile_picture'])
                                    <img src="{{ asset('storage/' . $entry['profile_picture']) }}" alt="User"
                                        class="w-full h-full rounded-full object-cover {{ $entry['is_current_user'] ? 'border-2 border-white' : '' }}">
                                @else
                                    <div
                                        class="w-full h-full rounded-full {{ $entry['is_current_user'] ? 'bg-gradient-to-br from-[#FF8A3D] to-[#FFC107]' : 'bg-gray-200' }} flex items-center justify-center {{ $entry['is_current_user'] ? 'text-white' : 'text-gray-600' }} font-bold">
                                        {{ $entry['initials'] ?? 'NA' }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 {{ $entry['is_current_user'] ? 'relative z-10' : '' }}">
                                <div class="flex items-center">
                                    <h4 class="font-medium">{{ $entry['name'] }}</h4>
                                    @if ($entry['is_current_user'])
                                        <span
                                            class="ml-2 bg-[#FF8A3D] text-white text-xs px-2 py-0.5 rounded-full font-medium">You</span>
                                    @endif
                                </div>
                                <div class="flex items-center">
                                    <span class="text-xs text-gray-500">Joined {{ $entry['joined_date'] }}</span>
                                </div>
                            </div>
                            <div class="text-right {{ $entry['is_current_user'] ? 'relative z-10' : '' }}">
                                <div class="font-bold text-[#F58321] {{ $entry['is_current_user'] ? 'text-lg' : '' }}">
                                    {{ isset($entry['score_percentage']) && $entry['score_percentage'] ? $entry['score_percentage'].'%' : '-' }}</div>
                                <div
                                    class="flex items-center justify-end text-xs {{ $entry['change_direction'] == 'up' ? 'text-green-500' : ($entry['change_direction'] == 'down' ? 'text-red-500' : 'text-gray-500') }}">
                                    @if ($entry['change_direction'] == 'up')
                                        <i class="fas fa-arrow-up mr-1"></i>
                                    @elseif($entry['change_direction'] == 'down')
                                        <i class="fas fa-arrow-down mr-1"></i>
                                    @endif
                                    <span>{{ isset($entry['change_percentage']) && $entry['change_percentage'] ? $entry['change_percentage'] : '-' }}</span>
                                </div>
                                @if ($entry['is_current_user'])
                                    <a href="{{ route('mobile.performance') }}"
                                        class="mt-2 text-xs text-[#FF8A3D] font-medium bg-white px-3 py-1 rounded-full shadow-sm hover:shadow-md transition-shadow border border-[#FF8A3D]/20 inline-block">
                                        <i class="fas fa-chart-line mr-1"></i> View Details
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/leaderboard.js') }}"></script>
    <style>
        /* Animation styles */
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Grow animation for podium bars */
        .animate-grow {
            animation: grow 1s ease-out forwards;
            transform-origin: bottom;
            opacity: 0;
            transform: scaleY(0);
        }

        @keyframes grow {
            0% {
                transform: scaleY(0);
                opacity: 0;
            }

            100% {
                transform: scaleY(1);
                opacity: 1;
            }
        }

        /* Fade in animation for performer cards */
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Bounce animation for crown */
        .animate-bounce {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(-25%) scale(1);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }
            50% {
                transform: translateY(0) scale(1.1);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        /* Pulse animation for badges */
        .top-performer:hover .w-8 {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 214, 0, 0.7);
            }
            
            70% {
                transform: scale(1.1);
                box-shadow: 0 0 0 10px rgba(255, 214, 0, 0);
            }
            
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 214, 0, 0);
            }
        }

        /* Hover effects for top performers */
        .top-performer {
            transition: all 0.3s ease;
        }

        .top-performer:hover {
            transform: translateY(-5px);
        }
    </style>
@endpush
