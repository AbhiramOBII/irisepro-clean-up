@extends('superadmin.layout')

@section('title', 'Settings')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-card-bg rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Administrator Settings</h3>
        </div>
        <div class="p-6">
            @if(session('success'))
                <div class="bg-success text-white px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="text-white hover:text-gray-200" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-600 text-white px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                    <button type="button" class="text-white hover:text-gray-200" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-card-bg rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h4 class="text-md font-semibold text-gray-900">Change Password</h4>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('superadmin.settings.password') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                <input type="password" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('current_password') border-red-500 @enderror" 
                                       id="current_password" 
                                       name="current_password" 
                                       required>
                                @error('current_password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input type="password" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('new_password') border-red-500 @enderror" 
                                       id="new_password" 
                                       name="new_password" 
                                       required
                                       minlength="8">
                                @error('new_password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-gray-500 text-sm mt-1">Password must be at least 8 characters long.</p>
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                <input type="password" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('new_password_confirmation') border-red-500 @enderror" 
                                       id="new_password_confirmation" 
                                       name="new_password_confirmation" 
                                       required
                                       minlength="8">
                                @error('new_password_confirmation')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex space-x-3 pt-4">
                                <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md transition duration-200 flex items-center">
                                    <i class="fas fa-save mr-2"></i> Update Password
                                </button>
                                <a href="{{ route('superadmin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200 flex items-center">
                                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-card-bg rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h4 class="text-md font-semibold text-gray-900">Security Guidelines</h4>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h5 class="flex items-center text-blue-800 font-medium mb-3">
                                <i class="fas fa-info-circle mr-2"></i> Password Security Tips
                            </h5>
                            <ul class="text-blue-700 text-sm space-y-1 list-disc list-inside">
                                <li>Use at least 8 characters</li>
                                <li>Include uppercase and lowercase letters</li>
                                <li>Include numbers and special characters</li>
                                <li>Avoid using personal information</li>
                                <li>Don't reuse old passwords</li>
                                <li>Change your password regularly</li>
                            </ul>
                        </div>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <h5 class="flex items-center text-yellow-800 font-medium mb-2">
                                <i class="fas fa-exclamation-triangle mr-2"></i> Important Notice
                            </h5>
                            <p class="text-yellow-700 text-sm">
                                Changing your password will not log you out of your current session, 
                                but you will need to use the new password for future logins.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password confirmation validation
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('new_password_confirmation');
    
    function validatePassword() {
        if (newPassword.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Passwords do not match');
        } else {
            confirmPassword.setCustomValidity('');
        }
    }
    
    newPassword.addEventListener('input', validatePassword);
    confirmPassword.addEventListener('input', validatePassword);
});
</script>
@endsection
