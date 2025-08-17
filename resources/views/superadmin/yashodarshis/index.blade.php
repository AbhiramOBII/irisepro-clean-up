@extends('superadmin.layout')

@section('title', 'Yashodarshi Management')
@section('page-title', 'Yashodarshi Management')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Yashodarshi Management</h2>
    <div class="flex space-x-3">
        <a href="{{ route('yashodarshis.bulk-upload') }}" class="bg-accent hover:bg-accent-dark text-white px-4 py-2 rounded-md font-medium transition duration-200">
            Bulk Upload
        </a>
        <a href="{{ route('yashodarshis.create') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md font-medium transition duration-200">
            Add New Yashodarshi
        </a>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-card-bg rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($yashodarshis as $yashodarshi)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $yashodarshi->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $yashodarshi->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $yashodarshi->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($yashodarshi->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $yashodarshi->created_at->format('M d, Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('yashodarshis.show', $yashodarshi->id) }}" class="text-info hover:text-blue-600 mr-3">View</a>
                        <a href="{{ route('yashodarshis.edit', $yashodarshi->id) }}" class="text-accent hover:text-accent-dark mr-3">Edit</a>
                        <form action="{{ route('yashodarshis.destroy', $yashodarshi->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No yashodarshis found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $yashodarshis->links('custom.pagination') }}
</div>
@endsection
