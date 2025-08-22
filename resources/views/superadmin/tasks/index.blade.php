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


<div class="bg-white rounded-xl shadow-lg overflow-x-auto border border-gray-100">
    <table class="w-full table-fixed divide-y divide-gray-200 min-w-[1200px]">
        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
            <tr>
                <th class="w-12 px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-r border-gray-200">ID</th>
                <th class="w-64 px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider border-r border-gray-200">Task Title</th>
                <th class="w-20 px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider border-r border-gray-200">Task Type</th>
                <th class="w-24 px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider border-r border-gray-200">Status</th>
                <th class="w-28 px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider border-r border-gray-200 bg-gray-100">Total Score</th>
                <th class="w-24 px-4 py-4 text-center text-xs font-bold text-blue-700 uppercase tracking-wider border-r border-gray-200 bg-blue-50">Aptitude</th>
                <th class="w-24 px-4 py-4 text-center text-xs font-bold text-red-700 uppercase tracking-wider border-r border-gray-200 bg-red-50">Attitude</th>
                <th class="w-32 px-4 py-4 text-center text-xs font-bold text-green-700 uppercase tracking-wider border-r border-gray-200 bg-green-50">Communication</th>
                <th class="w-24 px-4 py-4 text-center text-xs font-bold text-purple-700 uppercase tracking-wider border-r border-gray-200 bg-purple-50">Execution</th>
                <th class="w-20 px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
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

                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('superadmin.tasks.edit', $task) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit Task">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('superadmin.tasks.score', $task) }}" class="text-blue-600 hover:text-blue-900" title="Score Task">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('superadmin.tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete Task">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="px-6 py-4 text-center text-gray-500">No tasks found.</td>
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
