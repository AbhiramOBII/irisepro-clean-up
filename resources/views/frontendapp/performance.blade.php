@extends('frontendapp.partials.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-white to-[#EFCAA6]">
    
    <div class="px-4 pb-20">
     
        @if($performanceData['student_total_score'] == 0 && $performanceData['completed_tasks'] == 0 && !isset($performanceData['has_submitted_responses']))
            <!-- No Evaluation Started Experience -->

            @if($hasSubmittedResponses)
                 <!-- Review Pending Experience -->
                 <div class="flex flex-col items-center justify-center min-h-[70vh] text-center">
                <!-- Review Pending Card -->
                <div class="bg-gradient-to-br from-[#E8F5E8] to-[#C8E6C9] rounded-3xl p-8 mb-6 shadow-xl relative overflow-hidden max-w-md w-full">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-green-500/10 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative z-10">
                        <!-- Icon with animation -->
                        <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
                            <i class="fas fa-clock text-white text-3xl"></i>
                        </div>
                        
                        <!-- Review Message -->
                        <h2 class="text-2xl font-bold text-gray-800 mb-3">Review in Progress</h2>
                        <p class="text-gray-600 mb-6">Our Yashodarshi's are on it. Your performance will be reviewed shortly.</p>
                        
                        <!-- Student Info -->
                        <div class="bg-white rounded-xl p-4 mb-6">
                            <div class="text-sm text-gray-500 mb-1">Student</div>
                            <div class="text-lg font-semibold text-gray-800">{{ $performanceData['student_name'] }}</div>
                        </div>
                        
                        <!-- What's Happening -->
                        <div class="text-left">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">What's happening:</h3>
                            <div class="space-y-2">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                    Your task responses have been submitted
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-eye text-green-600 mr-2"></i>
                                    Yashodarshi's are reviewing your work
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-chart-line text-green-600 mr-2"></i>
                                    AACE scores will be calculated soon
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-bell text-green-600 mr-2"></i>
                                    You'll be notified when results are ready
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Status Info -->
                <div class="bg-white rounded-2xl p-6 shadow-lg max-w-md w-full">
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">What to do next?</h3>
                        <p class="text-gray-600 mb-4">While you wait, you can continue with other tasks or check your habit completion progress.</p>
                        <a href="{{ route('mobile.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-colors duration-200 font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Go to Dashboard
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="flex flex-col items-center justify-center min-h-[70vh] text-center">
                <!-- Welcome Card -->
                <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-3xl p-8 mb-6 shadow-xl relative overflow-hidden max-w-md w-full">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#F58321]/5 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#F58321]/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative z-10">
                        <!-- Icon -->
                        <div class="w-20 h-20 bg-[#F58321] rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-chart-line text-white text-3xl"></i>
                        </div>
                        
                        <!-- Welcome Message -->
                        <h2 class="text-2xl font-bold text-gray-800 mb-3">Welcome to Performance!</h2>
                        <p class="text-gray-600 mb-6">Your performance journey hasn't started yet. Complete your first task to see your progress and AACE scores here.</p>
                        
                        <!-- Student Info -->
                        <div class="bg-white rounded-xl p-4 mb-6">
                            <div class="text-sm text-gray-500 mb-1">Student</div>
                            <div class="text-lg font-semibold text-gray-800">{{ $performanceData['student_name'] }}</div>
                        </div>
                        
                        <!-- What to Expect -->
                        <div class="text-left">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">What you'll see here:</h3>
                            <div class="space-y-2">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-check-circle text-[#F58321] mr-2"></i>
                                    Your overall performance scores
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-chart-bar text-[#F58321] mr-2"></i>
                                    AACE breakdown (Aptitude, Attitude, Communication, Execution)
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-trophy text-[#F58321] mr-2"></i>
                                    Leaderboard position and rankings
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-history text-[#F58321] mr-2"></i>
                                    Task completion history and detailed scores
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Call to Action -->
                <div class="bg-white rounded-2xl p-6 shadow-lg max-w-md w-full">
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Ready to get started?</h3>
                        <p class="text-gray-600 mb-4">Head back to your dashboard and complete your first task to unlock your performance insights.</p>
                        <a href="{{ route('mobile.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-[#F58321] text-white rounded-xl hover:bg-[#E5751E] transition-colors duration-200 font-medium">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Go to Dashboard
                        </a>
                    </div>
                </div>
            </div>
            @endif
        
       
        @else
            <!-- Regular Performance Dashboard -->
        <!-- Performance Header Card -->
        <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-xl p-5 mb-4 shadow-md relative overflow-hidden transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 cursor-pointer group">
            <!-- Decorative circle elements -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF8A3D]/5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#FF8A3D]/5 rounded-full -ml-12 -mb-12"></div>
            
            <div class="flex relative z-10">
                <div class="flex-1 pr-16">
                    <div class="text-sm text-gray-800 font-medium mb-1">Performance Dashboard</div>
                    <div class="text-2xl font-bold text-gray-800 mb-2">{{ $performanceData['student_name'] }}</div>
                    <div>
                        <div class="text-sm text-gray-600">Your performance is improving! Based on {{ $performanceData['completed_tasks'] }} completed tasks.</div>
                        <div class="flex items-center mt-2">
                            <div class="bg-[#FF8A3D]/10 rounded-full px-3 py-1 text-xs text-[#FF8A3D] font-medium flex items-center">
                                <i class="fas fa-tasks mr-1"></i> {{ $performanceData['completed_tasks'] }} Tasks Done
                            </div>
                            <div class="bg-[#FFC107]/10 rounded-full px-3 py-1 text-xs text-[#FFC107] font-medium flex items-center ml-2">
                                <i class="fas fa-chart-line mr-1"></i> @if($performanceData['total_score'] > 0){{ round(($performanceData['student_total_score']/$performanceData['total_score'])*100,0)}}@else 0 @endif%
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Trophy illustration -->
                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-6 bg-[#FF8A3D]/10 rounded-full p-3">
                    <i class="fas fa-trophy text-4xl text-[#FF8A3D]"></i>
                </div>
            </div>
        </div>
        
        <!-- Performance Stats Overview -->
        <div class="mb-6 px-2">
            <div class="bg-white rounded-2xl shadow-md p-4 overflow-hidden relative">
                <h2 class="text-lg font-bold text-gray-800 mb-3">Performance Overview</h2>
                
                <!-- Stats Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Total Score -->
                    <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] p-3 rounded-xl">
                        <div class="text-sm text-gray-600 mb-1">Total Score</div>
                        <div class="flex items-end">
                            <span class="text-2xl font-bold text-[#F58321]">@if($performanceData['total_score'] > 0){{ round(($performanceData['student_total_score']/$performanceData['total_score'])*100,0) }}@else 0 @endif%</span>
                            <span class="text-xs text-green-600 ml-2 mb-1 flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i>3.2%
                            </span>
                        </div>
                    </div>
                    
                    <!-- Highest Task Score -->
                    <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] p-3 rounded-xl">
                        <div class="text-sm text-gray-600 mb-1">Highest Task Score</div>
                        <div class="flex items-end">
                            <span class="text-2xl font-bold text-[#F58321]">{{ $performanceData['highestScorePercentage'] }}%</span>
                            <span class="text-xs text-gray-500 ml-2 mb-1">{{ $performanceData['highest_score_task'] }}</span>
                        </div>
                    </div>
                    
                    <!-- Leaderboard Position -->
                    <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] p-3 rounded-xl">
                        <div class="text-sm text-gray-600 mb-1">Leaderboard Position</div>
                        <div class="flex items-end">
                            <span class="text-2xl font-bold text-[#F58321]">#{{ $currentPosition }}</span>
                            
                        </div>
                    </div>
                    
                    <!-- Tasks Completed -->
                    <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] p-3 rounded-xl">
                        <div class="text-sm text-gray-600 mb-1">Tasks Completed</div>
                        <div class="flex items-end">
                            <span class="text-2xl font-bold text-[#F58321]">{{ $performanceData['completed_tasks'] }}</span>
                            <span class="text-xs text-gray-500 ml-2 mb-1">out of {{ $performanceData['total_tasks'] }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-24 h-24 bg-[#F58321]/5 rounded-full -mr-8 -mt-8"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-[#F58321]/5 rounded-full -ml-6 -mb-6"></div>
            </div>
        </div>
        <!-- Challenge Points Progress Section -->
        <div class="mb-6 px-2">
            <div class="bg-white rounded-2xl shadow-md p-4 overflow-hidden relative">
                <h2 class="text-lg font-bold text-gray-800 mb-3">Challenge Progress</h2>
                
                <!-- Points Display -->
                <div class="flex justify-between items-center mb-2">
                    <div>
                        <div class="text-sm text-gray-500">Your Score</div>
                        <div class="text-2xl font-bold text-[#F58321]">{{ number_format($performanceData['current_score']) }} pts</div>
                    </div>
                    
                    <div class="text-right">
                        <div class="text-sm text-gray-500">Maximum Possible</div>
                        <div class="text-lg font-semibold text-gray-700">{{ number_format($performanceData['total_possible_score']) }} pts</div>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="mt-4 mb-2">
                    <div class="relative w-full h-4 mb-1">
                        <!-- Bar 3: Total_score of the Challenge (total_score of all the tasks put together) -->
                        <div class="absolute top-0 left-0 w-full bg-gray-200 rounded-full h-4"></div>
                        
                        <!-- Bar 2: Total Score of the Tasks Attended by the Student So far -->
                        <div class="absolute top-0 left-0 bg-[#fa0b0b] h-4 rounded-full" style="width: @if($performanceData['total_possible_score'] > 0){{ ($performanceData['total_score']/$performanceData['total_possible_score'])*100 }}@else 0 @endif%"></div>
                        
                        <!-- Bar 1: Total Student's Score -->
                        <div class="absolute top-0 left-0 bg-gradient-to-r from-[#FF8A3D] to-[#FFC107] h-4 rounded-full" style="width: @if($performanceData['total_possible_score'] > 0){{ ($performanceData['student_total_score']/$performanceData['total_possible_score'])*100 }}@else 0 @endif%"></div>
                    </div>
                   
                    <div class="flex justify-between text-xs mt-3">
                        <span class="text-[#FF8A3D] font-medium">Task 1</span>
                        <span class="text-gray-600">  <span class="text-[#FF8A3D] font-medium text-xs">{{ $performanceData['total_score']}}/{{ $performanceData['total_possible_score'] }}</span><br>Task {{ $performanceData['completed_tasks'] }} (Current)</span>
                        <span class="text-gray-500">Total: {{ number_format($performanceData['total_possible_score']) }} pts<br> Task {{ $performanceData['total_tasks'] }} (Final)</span>
                    </div>
                </div>
                
                <!-- Additional Stats -->
                <div class="flex justify-between mt-4 text-center">
                    <div class="bg-[#FF8A3D]/10 rounded-lg px-3 py-2">
                        <div class="text-xs text-gray-600">Completed Tasks</div>
                        <div class="text-sm font-bold text-[#FF8A3D]">{{ $performanceData['completed_tasks'] }}</div>
                    </div>
                    <div class="bg-[#FF8A3D]/10 rounded-lg px-3 py-2">
                        <div class="text-xs text-gray-600">Remaining Tasks</div>
                        <div class="text-sm font-bold text-[#FF8A3D]">{{ $performanceData['remaining_tasks'] }}</div>
                    </div>
                    <div class="bg-[#FF8A3D]/10 rounded-lg px-3 py-2">
                        <div class="text-xs text-gray-600">Overall Avg AACE</div>
                        <div class="text-sm font-bold text-[#FF8A3D]">@if($performanceData['total_score'] > 0){{ round(($performanceData['student_total_score']/$performanceData['total_score'])*100,0) }}@else 0 @endif%</div>
                    </div>
                </div>
            </div>
        </div>
    

   
        <!-- Today's tasks section -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-2 p-2">
                <h2 class="text-xl font-bold text-gray-800">Overall AACE Performance</h2>
            </div>
            <p class="text-sm text-gray-700 mb-4 pl-2">Your AACE scores across all completed tasks</p>
            
            <!-- Pie Chart -->
            <div class="relative bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] p-6 rounded-3xl shadow-lg mb-6">
                <!-- Decorative elements for the background card -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-[#F58321]/5 rounded-full -mr-10 -mt-10"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-[#F58321]/5 rounded-full -ml-10 -mb-10"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-[#F58321]/3 rounded-full blur-3xl opacity-20"></div>
                
                <!-- AACE Scores Chart Container -->
                <div class="relative z-10">
                    <div class="flex flex-col items-center justify-between space-y-6">
                        <!-- AACE Breakdown in bottom row -->
                        <div class="w-full">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 text-center">AACE Breakdown</h3>
                            
                            <div class="space-y-4">
                                <!-- Aptitude Score -->
                                <div class="mb-4">
                                    <div class="flex justify-between items-center mb-1">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-[#FF8A3D] mr-2"></div>
                                            <span class="text-sm font-medium">Aptitude</span>
                                        </div>
                                        <span class="text-sm font-bold"> @if($performanceData['total_aptitude_score'] > 0){{ round(($performanceData['student_aptitude_total']/$performanceData['total_aptitude_score'])*100,0) }}@else 0 @endif %</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-[#FF8A3D] h-2 rounded-full" style="width: @if($performanceData['total_aptitude_score'] > 0){{ round(($performanceData['student_aptitude_total']/$performanceData['total_aptitude_score'])*100,0) }}@else 0 @endif%"></div>
                                    </div>
                                </div>
                                
                                <!-- Attitude Score -->
                                <div class="mb-4">
                                    <div class="flex justify-between items-center mb-1">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-[#FFC107] mr-2"></div>
                                            <span class="text-sm font-medium">Attitude</span>
                                        </div>
                                        <span class="text-sm font-bold">@if($performanceData['total_attitude_score'] > 0){{ round(($performanceData['student_attitude_total']/$performanceData['total_attitude_score'])*100,0) }}@else 0 @endif %</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-[#FFC107] h-2 rounded-full" style="width: @if($performanceData['total_attitude_score'] > 0){{ round(($performanceData['student_attitude_total']/$performanceData['total_attitude_score'])*100,0) }}@else 0 @endif%"></div>
                                    </div>
                                </div>
                                
                                <!-- Communication Score -->
                                <div class="mb-4">
                                    <div class="flex justify-between items-center mb-1">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-[#FF8A3D] mr-2"></div>
                                            <span class="text-sm font-medium">Communication</span>
                                        </div>
                                        <span class="text-sm font-bold">@if($performanceData['total_communication_score'] > 0){{ round(($performanceData['student_communication_total']/$performanceData['total_communication_score'])*100,0) }}@else 0 @endif %</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-[#FF8A3D] h-2 rounded-full" style="width: @if($performanceData['total_communication_score'] > 0){{ round(($performanceData['student_communication_total']/$performanceData['total_communication_score'])*100,0) }}@else 0 @endif%"></div>
                                    </div>
                                </div>
                                
                                <!-- Execution Score -->
                                <div class="mb-4">
                                    <div class="flex justify-between items-center mb-1">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-[#F58321] mr-2"></div>
                                            <span class="text-sm font-medium">Execution</span>
                                        </div>
                                        <span class="text-sm font-bold">@if($performanceData['total_execution_score'] > 0){{ round(($performanceData['student_execution_total']/$performanceData['total_execution_score'])*100,0) }}@else 0 @endif %</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-[#F58321] h-2 rounded-full" style="width: @if($performanceData['total_execution_score'] > 0){{ round(($performanceData['student_execution_total']/$performanceData['total_execution_score'])*100,0) }}@else 0 @endif%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End of Background Card -->
        </div>
        
        <!-- Activity History Table Section -->
        <div class="mb-20">
            <div class="flex justify-between items-center mb-4 p-2">
                <h2 class="text-xl font-bold text-gray-800">Task Performance History</h2>
            </div>
            
            <div class="relative bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] p-6 rounded-3xl shadow-lg mb-6">
                <!-- Decorative elements for the background card -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-[#F58321]/5 rounded-full -mr-10 -mt-10"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-[#F58321]/5 rounded-full -ml-10 -mb-10"></div>
                
                <!-- Task Cards -->
                <div class="relative z-10 space-y-4">
                    @foreach($performanceData['task_history'] as $task)
                        @if($task['status'] === 'completed')
                      
                            <!-- Completed Task -->
                            <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow" style="border: 1px solid {{ $task['border_color'] }};">
                               
                                <div class="flex items-center justify-between mb-3">
                                    <div class="bg-[#F58321]/10 rounded-lg px-3 py-1 flex items-center justify-center">
                                        <span class="text-xs font-bold text-[#F58321]">Task {{ $task['task_number'] }}</span>
                                    </div>
                                    <span class="text-white text-sm font-bold px-3 py-1 rounded-full" style="background-color: {{ $task['border_color'] }};">{{round((($performanceData['alltasktotalscore'][$task['task_id']]['Student_total_score'])/($task['total_score']))*100,0)}}%</span>
                                </div>
                                
                                <!-- Row 2: Task Title -->
                                <h4 class="font-medium text-lg mb-2">{{ $task['task_title'] }}</h4>
                                
                                <!-- Row 3: Task Description -->
                                <p class="text-xs text-gray-600 mb-3">{{ Str::limit(strip_tags($task['task_description']), 100) }}</p>
                                
                                <!-- Row 5: CTA -->
                                <div class="flex justify-between items-center">
                                    <a href="{{ route('mobile.performance.detail', $task['task_id']) }}" class="text-xs font-medium text-[#FF8A3D] hover:underline flex items-center">
                                        View Details
                                        <i class="fas fa-chevron-right ml-1 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        </div>
        @endif
    </div>
</div>
@endsection
