@extends('superadmin.layout')

@section('title', 'Student Details')
@section('page-title', 'Student Details')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Student Details</h2>
    <div class="flex space-x-3">
        <a href="{{ route('students.edit', $student->id) }}" class="bg-accent hover:bg-accent-dark text-white px-4 py-2 rounded-md font-medium transition duration-200">
            Edit Student
        </a>
        <a href="{{ route('students.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md font-medium transition duration-200">
            Back to Students
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
                            <label class="block text-sm font-medium text-gray-500">Full Name</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $student->full_name }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $student->email }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Date of Birth</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $student->date_of_birth->format('F d, Y') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Gender</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst($student->gender) }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone Number</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $student->phone_number }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Partner Institution</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $student->partner_institution ?? 'Not specified' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status</label>
                            <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $student->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email Verified</label>
                            <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $student->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $student->email_verified_at ? 'Verified' : 'Not Verified' }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Has Seen Welcome</label>
                            <span class="mt-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $student->has_seen_welcome ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $student->has_seen_welcome ? 'Yes' : 'No' }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Created At</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $student->created_at->format('F d, Y H:i:s') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Last Updated</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $student->updated_at->format('F d, Y H:i:s') }}</p>
                        </div>

                        @if($student->email_verified_at)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email Verified At</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $student->email_verified_at->format('F d, Y H:i:s') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


<div class="mt-6 flex justify-end space-x-3">
    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-medium transition duration-200" 
                onclick="return confirm('Are you sure you want to delete this student?')">
            Delete Student
        </button>
    </form>
</div>
@endsection
