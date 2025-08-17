@extends('superadmin.layout')

@section('title', 'Yashodarshi Details')
@section('page-title', 'Yashodarshi Details')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Yashodarshi Details</h2>
    <div class="flex space-x-3">
        <a href="{{ route('yashodarshis.edit', $yashodarshi->id) }}" class="bg-accent hover:bg-accent-dark text-white px-4 py-2 rounded-md font-medium transition duration-200">
            Edit Yashodarshi
        </a>
        <a href="{{ route('yashodarshis.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-medium transition duration-200">
            Back to Yashodarshis
        </a>
    </div>
</div>

<div class="bg-card-bg rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500">Name</label>
                <p class="mt-1 text-sm text-gray-900">{{ $yashodarshi->name }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">Email</label>
                <p class="mt-1 text-sm text-gray-900">{{ $yashodarshi->email }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">Status</label>
                <p class="mt-1">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $yashodarshi->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($yashodarshi->status) }}
                    </span>
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">Created At</label>
                <p class="mt-1 text-sm text-gray-900">{{ $yashodarshi->created_at->format('F d, Y H:i:s') }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">Updated At</label>
                <p class="mt-1 text-sm text-gray-900">{{ $yashodarshi->updated_at->format('F d, Y H:i:s') }}</p>
            </div>
        </div>

        @if($yashodarshi->biodata)
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-500 mb-2">Biodata</label>
            <div class="bg-gray-50 rounded-md p-4">
                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $yashodarshi->biodata }}</p>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="mt-6 flex justify-end space-x-3">
    <form action="{{ route('yashodarshis.destroy', $yashodarshi->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-medium transition duration-200" 
                onclick="return confirm('Are you sure you want to delete this yashodarshi?')">
            Delete Yashodarshi
        </button>
    </form>
</div>
@endsection
