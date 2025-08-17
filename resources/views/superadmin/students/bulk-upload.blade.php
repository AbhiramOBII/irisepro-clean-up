@extends('superadmin.layout')

@section('title', 'Bulk Upload Students')
@section('page-title', 'Bulk Upload Students')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Bulk Upload Students</h2>
    <a href="{{ route('students.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-medium transition duration-200">
        Back to Students
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('errors') && is_array(session('errors')) && count(session('errors')) > 0)
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <h4 class="font-bold mb-2">Upload Errors:</h4>
        <ul class="list-disc list-inside max-h-40 overflow-y-auto">
            @foreach(session('errors') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($errors && $errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Upload Form -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Upload CSV File</h3>
        
        <form action="{{ route('students.process-bulk-upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="csv_file" class="block text-sm font-medium text-gray-700 mb-2">
                    Select CSV File
                </label>
                <input type="file" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                       id="csv_file" 
                       name="csv_file" 
                       accept=".csv,.txt"
                       required>
                <p class="mt-1 text-sm text-gray-500">
                    Maximum file size: 2MB. Accepted formats: CSV, TXT
                </p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-md font-medium transition duration-200">
                    Upload Students
                </button>
            </div>
        </form>
    </div>

    <!-- Instructions -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Instructions</h3>
        
        <div class="space-y-4">
            <div>
                <h4 class="font-medium text-gray-800 mb-2">CSV Format Requirements:</h4>
                <ul class="text-sm text-gray-600 space-y-1 list-disc list-inside">
                    <li>First row must contain column headers</li>
                    <li>Required columns: Full Name, Email, Date of Birth, Gender, Phone Number</li>
                    <li>Optional columns: Partner Institution, Status</li>
                    <li>Date format: YYYY-MM-DD (e.g., 1995-05-15)</li>
                    <li>Gender values: male, female, other</li>
                    <li>Status values: active, inactive (defaults to active)</li>
                </ul>
            </div>

            <div>
                <h4 class="font-medium text-gray-800 mb-2">Column Order:</h4>
                <ol class="text-sm text-gray-600 space-y-1 list-decimal list-inside">
                    <li>Full Name</li>
                    <li>Email</li>
                    <li>Date of Birth</li>
                    <li>Gender</li>
                    <li>Phone Number</li>
                    <li>Partner Institution (Optional)</li>
                    <li>Status (Optional)</li>
                </ol>
            </div>

            <div class="pt-4 border-t">
                <a href="{{ route('students.download-template') }}" 
                   class="inline-flex items-center bg-accent hover:bg-accent-dark text-white px-4 py-2 rounded-md font-medium transition duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download CSV Template
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Sample Data Preview -->
<div class="mt-6 bg-card-bg rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Sample CSV Data</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Partner Institution</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">john.doe@example.com</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1995-05-15</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">male</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">+1234567890</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">ABC University</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">active</td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jane Smith</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">jane.smith@example.com</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1998-12-03</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">female</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">+9876543210</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">active</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
