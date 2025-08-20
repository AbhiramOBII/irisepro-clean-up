<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Super Admin Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#FF8A3D',
                        'primary-dark': '#E67E35',
                        'primary-light': '#FFB380',
                        'secondary': '#FFF1E6',
                        'accent': '#FFC107',
                        'accent-dark': '#FFA000',
                        'success': '#4CAF50',
                        'info': '#2196F3',
                        'card-bg': '#FFFFFF',
                    },
                    fontFamily: {
                        'sans': ['Montserrat', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-secondary min-h-screen font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-primary shadow-lg">
            <div class="p-6">
                <h2 class="text-xl font-bold text-white">Super Admin</h2>
            </div>
            <nav class="mt-6">
                <div class="px-6 py-2">
                    <a href="{{ route('superadmin.dashboard') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200 {{ request()->routeIs('superadmin.dashboard') ? 'bg-primary-dark' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        Dashboard
                    </a>
                </div>
                
                <div class="px-6 py-2">
                    <a href="{{ route('students.index') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Manage Students
                    </a>
                    
                    <a href="{{ route('yashodarshis.index') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Manage Yashodarshis
                    </a>
                </div>

                <div class="px-6 py-2">
                    <a href="{{ route('superadmin.tasks.index') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200 {{ request()->routeIs('superadmin.tasks.*') ? 'bg-primary-dark' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Manage Tasks
                    </a>
                    
                    <a href="{{ route('challenges.index') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200 {{ request()->routeIs('challenges.*') ? 'bg-primary-dark' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        Manage Challenges
                    </a>
                    
                    <a href="{{ route('batches.index') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200 {{ request()->routeIs('batches.*') ? 'bg-primary-dark' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Manage Batches
                    </a>
                    
                    <a href="{{ route('habits.index') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200 {{ request()->routeIs('habits.*') ? 'bg-primary-dark' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Manage Habits
                    </a>
                    
                    <a href="{{ route('achievements.index') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200 {{ request()->routeIs('achievements.*') ? 'bg-primary-dark' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Manage Achievements
                    </a>
                    
                    <a href="{{ route('superadmin.enrollments.index') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200 {{ request()->routeIs('superadmin.enrollments.*') ? 'bg-primary-dark' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Manage Enrollments
                    </a>
                    
                    <a href="{{ route('superadmin.support-requests.index') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200 {{ request()->routeIs('superadmin.support-requests.*') ? 'bg-primary-dark' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Support Requests
                    </a>
                </div>

                <div class="px-6 py-2">
                    <a href="{{ route('superadmin.settings') }}" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200 {{ request()->routeIs('superadmin.settings*') ? 'bg-primary-dark' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Settings
                    </a>
                </div>

                <div class="px-6 py-2">
                    <a href="#" 
                       class="flex items-center px-4 py-2 text-white hover:bg-primary-dark rounded-md transition duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Reports
                    </a>
                </div>
            </nav>

            <div class="absolute bottom-0 w-64 p-6">
                <a href="{{ route('superadmin.logout') }}" 
                   class="flex items-center px-4 py-2 text-white hover:bg-red-600 rounded-md transition duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="w-[90%] mx-auto px-4 sm:px-6 ">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <h1 class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700">Welcome, {{ session('superadmin_logged_in') ? \App\Models\SuperAdmin::find(session('superadmin_id'))->superadmin_fullname : 'Admin' }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-secondary">
                <div class="w-[90%] mx-auto py-6 sm:px-6 lg:px-8">
                    <div class="px-4 py-6 sm:px-0">
                        @if(session('success'))
                            <div class="bg-success text-white px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="bg-red-600 text-white px-4 py-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
