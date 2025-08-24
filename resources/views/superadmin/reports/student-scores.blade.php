@extends('superadmin.layout')

@section('title', 'Student Scores Report')
@section('page-title', 'Student Scores Report')

@section('content')
<div class="space-y-6">
    <!-- Header with Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Student Performance Report</h3>
                <p class="text-sm text-gray-600 mt-1">Detailed scores and performance metrics for all students</p>
            </div>
            
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                <!-- Batch Filter -->
                <form method="GET" action="{{ route('superadmin.reports.student-scores') }}" class="flex items-center space-x-2">
                    <select name="batch_id" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" onchange="this.form.submit()">
                        <option value="">All Batches</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}" {{ $batchId == $batch->id ? 'selected' : '' }}>
                                {{ $batch->batch_name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                
                <!-- Export Button -->
                <a href="{{ route('superadmin.reports.export.student-scores', ['batch_id' => $batchId]) }}" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition duration-200 font-medium text-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export CSV
                </a>
            </div>
        </div>
    </div>

    <!-- Results Summary -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="text-center">
                <p class="text-2xl font-bold text-primary">{{ $studentsData->count() }}</p>
                <p class="text-sm text-gray-600">Total Students</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-bold text-blue-600">{{ number_format($studentsData->sum('completed_tasks')) }}</p>
                <p class="text-sm text-gray-600">Total Tasks Completed</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-bold text-green-600">{{ $studentsData->count() > 0 ? number_format($studentsData->avg('avg_total'), 1) : '0' }}</p>
                <p class="text-sm text-gray-600">Average Score</p>
            </div>
            <div class="text-center">
                <p class="text-2xl font-bold text-orange-600">{{ $studentsData->count() > 0 ? number_format($studentsData->avg('completed_tasks'), 1) : '0' }}</p>
                <p class="text-sm text-gray-600">Avg Tasks per Student</p>
            </div>
        </div>
    </div>

    <!-- Student Scores Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h4 class="text-md font-semibold text-gray-900">Student Performance Details</h4>
        </div>
        
        @if($studentsData->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Batch(es)</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tasks</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-100">Total Score</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-blue-500 uppercase tracking-wider bg-blue-50">Aptitude</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-red-500 uppercase tracking-wider bg-red-50">Attitude</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-green-500 uppercase tracking-wider bg-green-50">Communication</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-purple-500 uppercase tracking-wider bg-purple-50">Execution</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($studentsData->sortByDesc('avg_total') as $data)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-primary flex items-center justify-center">
                                                <span class="text-sm font-medium text-white">
                                                    {{ strtoupper(substr($data['student']->full_name, 0, 2)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $data['student']->full_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $data['student']->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded-full">
                                        
                                        {{ $batchtitle }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="text-sm font-semibold text-gray-900">{{ $data['completed_tasks'] }}</span>
                                </td>
                                <td class="px-4 py-4 text-center bg-gray-25">
                                    <div class="text-sm">
                                        <div class="font-bold text-gray-900">{{ number_format($data['avg_total'], 1) }}</div>
                                        <div class="text-xs text-gray-500">({{ number_format($data['total_score'], 1) }} total)</div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center bg-blue-25">
                                    <div class="text-sm">
                                        <div class="font-bold text-blue-700">{{ number_format($data['avg_aptitude'], 1) }}</div>
                                        <div class="text-xs text-blue-500">({{ number_format($data['aptitude_score'], 1) }} total)</div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center bg-red-25">
                                    <div class="text-sm">
                                        <div class="font-bold text-red-700">{{ number_format($data['avg_attitude'], 1) }}</div>
                                        <div class="text-xs text-red-500">({{ number_format($data['attitude_score'], 1) }} total)</div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center bg-green-25">
                                    <div class="text-sm">
                                        <div class="font-bold text-green-700">{{ number_format($data['avg_communication'], 1) }}</div>
                                        <div class="text-xs text-green-500">({{ number_format($data['communication_score'], 1) }} total)</div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center bg-purple-25">
                                    <div class="text-sm">
                                        <div class="font-bold text-purple-700">{{ number_format($data['avg_execution'], 1) }}</div>
                                        <div class="text-xs text-purple-500">({{ number_format($data['execution_score'], 1) }} total)</div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-8 text-center">
                <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Data Available</h3>
                <p class="text-gray-500">No student scores found for the selected criteria.</p>
            </div>
        @endif
    </div>
</div>
@endsection
