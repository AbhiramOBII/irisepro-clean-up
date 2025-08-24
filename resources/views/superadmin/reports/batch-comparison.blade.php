@extends('superadmin.layout')

@section('title', 'Batch Comparison Report')
@section('page-title', 'Batch Comparison Report')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Batch Performance Comparison</h3>
                <p class="text-sm text-gray-600 mt-1">Compare average performance metrics across all batches</p>
            </div>
            <a href="{{ route('superadmin.reports.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 font-medium text-sm">
                ← Back to Reports
            </a>
        </div>
    </div>

    @if($batchData->count() > 0)
        <!-- Performance Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h4 class="text-md font-semibold text-gray-900 mb-4">Average Scores Comparison</h4>
            <div class="space-y-4">
                @foreach($batchData->sortByDesc('avg_total') as $data)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h5 class="font-medium text-gray-900">{{ $data['batch']->batch_name }}</h5>
                                <p class="text-sm text-gray-500">{{ $data['student_count'] }} students • {{ $data['total_evaluations'] }} evaluations</p>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-gray-900">{{ number_format($data['avg_total'], 1) }}</div>
                                <div class="text-xs text-gray-500">Avg Total Score</div>
                            </div>
                        </div>
                        
                        <!-- Progress Bars -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Aptitude -->
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-xs font-medium text-blue-600">Aptitude</span>
                                    <span class="text-xs text-blue-600">{{ number_format($data['avg_aptitude'], 1) }}</span>
                                </div>
                                <div class="w-full bg-blue-100 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $data['avg_aptitude'] > 0 ? min(($data['avg_aptitude'] / 100) * 100, 100) : 0 }}%"></div>
                                </div>
                            </div>
                            
                            <!-- Attitude -->
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-xs font-medium text-red-600">Attitude</span>
                                    <span class="text-xs text-red-600">{{ number_format($data['avg_attitude'], 1) }}</span>
                                </div>
                                <div class="w-full bg-red-100 rounded-full h-2">
                                    <div class="bg-red-600 h-2 rounded-full" style="width: {{ $data['avg_attitude'] > 0 ? min(($data['avg_attitude'] / 100) * 100, 100) : 0 }}%"></div>
                                </div>
                            </div>
                            
                            <!-- Communication -->
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-xs font-medium text-green-600">Communication</span>
                                    <span class="text-xs text-green-600">{{ number_format($data['avg_communication'], 1) }}</span>
                                </div>
                                <div class="w-full bg-green-100 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $data['avg_communication'] > 0 ? min(($data['avg_communication'] / 100) * 100, 100) : 0 }}%"></div>
                                </div>
                            </div>
                            
                            <!-- Execution -->
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-xs font-medium text-purple-600">Execution</span>
                                    <span class="text-xs text-purple-600">{{ number_format($data['avg_execution'], 1) }}</span>
                                </div>
                                <div class="w-full bg-purple-100 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $data['avg_execution'] > 0 ? min(($data['avg_execution'] / 100) * 100, 100) : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Detailed Comparison Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-md font-semibold text-gray-900">Detailed Batch Metrics</h4>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch Name</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Evaluations</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Avg Tasks/Student</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-100">Avg Total</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-blue-500 uppercase tracking-wider bg-blue-50">Avg Aptitude</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-red-500 uppercase tracking-wider bg-red-50">Avg Attitude</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-green-500 uppercase tracking-wider bg-green-50">Avg Communication</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-purple-500 uppercase tracking-wider bg-purple-50">Avg Execution</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($batchData->sortByDesc('avg_total') as $data)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $data['batch']->batch_name }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($data['batch']->description, 40) }}</div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="text-sm font-semibold text-gray-900">{{ $data['student_count'] }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="text-sm font-semibold text-gray-900">{{ $data['total_evaluations'] }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="text-sm font-semibold text-gray-900">{{ number_format($data['avg_tasks_per_student'], 1) }}</span>
                                </td>
                                <td class="px-4 py-4 text-center bg-gray-25">
                                    <span class="text-sm font-bold text-gray-900">{{ number_format($data['avg_total'], 1) }}</span>
                                </td>
                                <td class="px-4 py-4 text-center bg-blue-25">
                                    <span class="text-sm font-bold text-blue-700">{{ number_format($data['avg_aptitude'], 1) }}</span>
                                </td>
                                <td class="px-4 py-4 text-center bg-red-25">
                                    <span class="text-sm font-bold text-red-700">{{ number_format($data['avg_attitude'], 1) }}</span>
                                </td>
                                <td class="px-4 py-4 text-center bg-green-25">
                                    <span class="text-sm font-bold text-green-700">{{ number_format($data['avg_communication'], 1) }}</span>
                                </td>
                                <td class="px-4 py-4 text-center bg-purple-25">
                                    <span class="text-sm font-bold text-purple-700">{{ number_format($data['avg_execution'], 1) }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <a href="{{ route('superadmin.reports.student-scores', ['batch_id' => $data['batch']->id]) }}" 
                                       class="text-primary hover:text-primary-dark text-sm font-medium">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Performance Insights -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h4 class="text-md font-semibold text-gray-900 mb-4">Performance Insights</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $topBatch = $batchData->sortByDesc('avg_total')->first();
                    $mostActive = $batchData->sortByDesc('total_evaluations')->first();
                    $bestEngagement = $batchData->sortByDesc('avg_tasks_per_student')->first();
                    $largestBatch = $batchData->sortByDesc('student_count')->first();
                @endphp
                
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 rounded-full">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">Top Performer</p>
                            <p class="text-xs text-green-600">{{ $topBatch['batch']->batch_name ?? 'N/A' }}</p>
                            <p class="text-xs text-green-600">{{ number_format($topBatch['avg_total'] ?? 0, 1) }} avg score</p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 rounded-full">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-blue-800">Most Active</p>
                            <p class="text-xs text-blue-600">{{ $mostActive['batch']->batch_name ?? 'N/A' }}</p>
                            <p class="text-xs text-blue-600">{{ $mostActive['total_evaluations'] ?? 0 }} evaluations</p>
                        </div>
                    </div>
                </div>

                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-orange-100 rounded-full">
                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-orange-800">Best Engagement</p>
                            <p class="text-xs text-orange-600">{{ $bestEngagement['batch']->batch_name ?? 'N/A' }}</p>
                            <p class="text-xs text-orange-600">{{ number_format($bestEngagement['avg_tasks_per_student'] ?? 0, 1) }} tasks/student</p>
                        </div>
                    </div>
                </div>

                <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-100 rounded-full">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-purple-800">Largest Batch</p>
                            <p class="text-xs text-purple-600">{{ $largestBatch['batch']->batch_name ?? 'N/A' }}</p>
                            <p class="text-xs text-purple-600">{{ $largestBatch['student_count'] ?? 0 }} students</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No Batches Available</h3>
            <p class="text-gray-500">No batch data found for comparison.</p>
        </div>
    @endif
</div>
@endsection
