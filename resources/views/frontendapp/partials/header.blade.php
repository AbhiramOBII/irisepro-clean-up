<!-- Header section with user info -->
<div class="bg-gradient-to-br from-secondary to-white p-4 rounded-b-3xl shadow-sm">
    <!-- App logo and user profile -->
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
            <a href="{{ route('mobile.dashboard') }}"><img src="{{ asset('images/irisepro-logo.png') }}" alt="iRisePro Logo" class="h-20"></a>
        </div>
        <div class="flex items-center space-x-3">
            <!-- Notifications Button -->
            <button id="notificationBtn" class="w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-card hover:bg-gray-50 transition-all duration-200 relative">
                <i class="fas fa-bell text-gray-500"></i>
                @if(isset($studentData['unread_notifications']) && $studentData['unread_notifications'] > 0)
                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                @endif
            </button>
           
            <!-- Settings Button -->
            <a href="{{ route('mobile.support') }}" id="settingsBtn" class="w-9 h-9 bg-white rounded-full flex items-center justify-center shadow-card hover:bg-gray-50 transition-all duration-200">
                <i class="fas fa-cog text-gray-500"></i>
            </a>
            
            <!-- User Avatar Dropdown -->
            <div class="relative">
                <div id="userAvatar" class="w-9 h-9 bg-gradient-to-br from-primary to-primary-dark rounded-full overflow-hidden flex items-center justify-center shadow-card border-2 border-white cursor-pointer">
                    <!-- User avatar with initials or profile picture -->
                    @if(isset($student['profile_picture']) && $student['profile_picture'])
                        <img src="{{ asset('storage/profile_pictures/' . $student['profile_picture']) }}" alt="{{ $student['full_name'] ?? 'Profile' }}" class="w-full h-full object-cover">
                    @else
                        @php
                            $fullName = $student['full_name'] ?? $student['name'] ?? 'User';
                            $nameParts = explode(' ', trim($fullName));
                            $initials = '';
                            foreach($nameParts as $part) {
                                if(!empty($part)) {
                                    $initials .= strtoupper(substr($part, 0, 1));
                                }
                            }
                            $initials = substr($initials, 0, 2); // Limit to 2 characters
                        @endphp
                        <span class="text-xs font-medium text-white">{{ $initials ?: 'U' }}</span>
                    @endif
                </div>
                
                <!-- Dropdown menu (hidden by default) -->
                <div id="userDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 hidden">
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">{{ $student['full_name'] ?? 'Student' }}</p>
                        <p class="text-xs text-gray-500">{{ $student['email'] ?? $student['phone'] ?? '' }}</p>
                    </div>
                    
                    <a href="{{route('mobile.profile')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                        <i class="fas fa-user mr-2 text-primary"></i> My Profile
                    </a>
                    <a href="{{route('mobile.support')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                        <i class="fas fa-trophy mr-2 text-primary"></i> Support
                    </a>

              
                    <div class="border-t border-gray-100"></div>
                    
                    <form method="POST" action="{{ route('mobile.logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                            <i class="fas fa-sign-out-alt mr-2 text-primary"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

