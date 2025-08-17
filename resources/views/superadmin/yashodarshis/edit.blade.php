@extends('superadmin.layout')

@section('title', 'Edit Yashodarshi')
@section('page-title', 'Edit Yashodarshi')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Edit Yashodarshi</h2>
    <a href="{{ route('yashodarshis.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-medium transition duration-200">
        Back to Yashodarshis
    </a>
</div>

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-card-bg rounded-lg shadow p-6">
    <form action="{{ route('yashodarshis.update', $yashodarshi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <input type="text" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $yashodarshi->name) }}" 
                       required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $yashodarshi->email) }}" 
                       required>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                        id="status" 
                        name="status" 
                        required>
                    <option value="active" {{ old('status', $yashodarshi->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $yashodarshi->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <label for="biodata" class="block text-sm font-medium text-gray-700 mb-2">Biodata</label>
            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                      id="biodata" 
                      name="biodata" 
                      rows="6" 
                      placeholder="Enter biodata information...">{{ old('biodata', $yashodarshi->biodata) }}</textarea>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('yashodarshis.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-medium transition duration-200">
                Cancel
            </a>
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md font-medium transition duration-200">
                Update Yashodarshi
            </button>
        </div>
    </form>
</div>
@endsection
