@extends('superadmin.layout')

@section('title', 'Task Management')
@section('page-title', 'Task Management')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Task Management</h2>
    <div class="flex space-x-3">
        <a href="{{ route('superadmin.tasks.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md font-medium transition duration-200">
            Create New Task
        </a>
    </div>
</div>

@if(session('success'))
    <div class="bg-success text-white px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-lg overflow-x-auto border border-gray-100">
    <table class="w-full table-fixed divide-y divide-gray-200">
        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
            <tr>
                <th class="w-12 px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-r border-gray-200">ID</th>
                <th class="w-20 px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-r border-gray-200">Task Title</th>
                <th class="w-20 px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider border-r border-gray-200">Status</th>
                <th class="w-24 px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider border-r border-gray-200 bg-gray-100">Total Score</th>
                <th class="w-20 px-4 py-4 text-center text-xs font-bold text-blue-700 uppercase tracking-wider border-r border-gray-200 bg-blue-50">Aptitude</th>
                <th class="w-20 px-4 py-4 text-center text-xs font-bold text-red-700 uppercase tracking-wider border-r border-gray-200 bg-red-50">Attitude</th>
                <th class="w-28 px-4 py-4 text-center text-xs font-bold text-green-700 uppercase tracking-wider border-r border-gray-200 bg-green-50">Communication</th>
                <th class="w-20 px-4 py-4 text-center text-xs font-bold text-purple-700 uppercase tracking-wider border-r border-gray-200 bg-purple-50">Execution</th>
                <th class="w-32 px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($tasks as $task)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-4 py-5 whitespace-nowrap text-sm font-semibold text-gray-900 border-r border-gray-100">{{ $task->id }}</td>
                    <td class="px-6 py-5 whitespace-nowrap text-sm font-bold text-gray-900 border-r border-gray-100">{{ $task->task_title }}</td>
                  
                    <td class="px-4 py-5 whitespace-nowrap text-center border-r border-gray-100">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full shadow-sm {{ $task->status == 'active' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-gray-100 text-gray-800 border border-gray-200' }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-5 whitespace-nowrap text-center text-lg font-black text-gray-900 border-r border-gray-100 bg-gray-50">
                        {{ $task->taskScore ? number_format($task->taskScore->total_score, 1) : '-' }}
                    </td>
                    <td class="px-4 py-5 whitespace-nowrap text-center text-sm font-bold text-blue-700 border-r border-gray-100 bg-blue-25">
                        {{ $task->taskScore ? number_format($task->taskScore->aptitude_score, 1) : '-' }}
                    </td>
                    <td class="px-4 py-5 whitespace-nowrap text-center text-sm font-bold text-red-700 border-r border-gray-100 bg-red-25">
                        {{ $task->taskScore ? number_format($task->taskScore->attitude_score, 1) : '-' }}
                    </td>
                    <td class="px-4 py-5 whitespace-nowrap text-center text-sm font-bold text-green-700 border-r border-gray-100 bg-green-25">
                        {{ $task->taskScore ? number_format($task->taskScore->communication_score, 1) : '-' }}
                    </td>
                    <td class="px-4 py-5 whitespace-nowrap text-center text-sm font-bold text-purple-700 border-r border-gray-100 bg-purple-25">
                        {{ $task->taskScore ? number_format($task->taskScore->execution_score, 1) : '-' }}
                    </td>
                  
                    <td class="px-6 py-5 whitespace-nowrap text-center">
                        <div class="flex justify-center space-x-3">
                            <a href="{{ route('superadmin.tasks.edit', $task) }}" 
                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 rounded-md transition-colors duration-200 border border-indigo-200">
                                Edit
                            </a>
                            <a href="{{ route('superadmin.tasks.score', $task) }}" 
                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-green-700 bg-green-100 hover:bg-green-200 rounded-md transition-colors duration-200 border border-green-200">
                                Score
                            </a>
                            <form action="{{ route('superadmin.tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-md transition-colors duration-200 border border-red-200" 
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="px-6 py-4 text-center text-gray-500">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $tasks->links() }}
</div>
@endsection
