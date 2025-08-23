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
        <div class="w-64 bg-primary shadow-lg flex flex-col">
            <div class="p-6 border-b border-primary-dark border-opacity-30">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white">Super Admin</h2>
                </div>
            </div>
            <nav class="mt-2 flex-1 overflow-y-hidden">
                <div class="mb-4">
                    <p class="px-6 text-xs font-medium text-white text-opacity-70 uppercase tracking-wider mb-2">Main</p>
                    <a href="{{ route('superadmin.dashboard') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('superadmin.dashboard') ? 'bg-primary-dark' : '' }}">
                        <span>Dashboard</span>
                    </a>
                </div>
                
                <div class="mb-4">
                    <p class="px-6 text-xs font-medium text-white text-opacity-70 uppercase tracking-wider mb-2">User Management</p>
                    <a href="{{ route('students.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('students.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <span>Manage Students</span>
                    </a>
                    
                    <a href="{{ route('yashodarshis.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('yashodarshis.*') ? 'bg-primary-dark' : '' }}">
                        <span>Manage Yashodarshis</span>
                    </a>
                </div>

                <div class="mb-4">
                    <p class="px-6 text-xs font-medium text-white text-opacity-70 uppercase tracking-wider mb-2">Content Management</p>
                    <a href="{{ route('superadmin.tasks.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('superadmin.tasks.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <span>Manage Tasks</span>
                    </a>
                    
                    <a href="{{ route('challenges.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('challenges.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <span>Manage Challenges</span>
                    </a>
                    
                    <a href="{{ route('batches.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('batches.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <span>Manage Batches</span>
                    </a>
                    
                    <a href="{{ route('habits.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('habits.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <span>Manage Habits</span>
                    </a>
                    
                    <a href="{{ route('achievements.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('achievements.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <span>Manage Achievements</span>
                    </a>
                    
                    <a href="{{ route('superadmin.enrollments.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('superadmin.enrollments.*') ? 'bg-primary-dark' : '' }} mb-1">
                        <span>Manage Enrollments</span>
                    </a>
                    
                    <a href="{{ route('superadmin.support-requests.index') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('superadmin.support-requests.*') ? 'bg-primary-dark' : '' }}">
                        <span>Support Requests</span>
                    </a>
                </div>

                <div class="mb-4">
                    <p class="px-6 text-xs font-medium text-white text-opacity-70 uppercase tracking-wider mb-2">System</p>
                    <a href="{{ route('superadmin.settings') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 {{ request()->routeIs('superadmin.settings*') ? 'bg-primary-dark' : '' }}">
                        <span>Settings</span>
                    </a>
                </div>

                <div class="mb-4">
                    <p class="px-6 text-xs font-medium text-white text-opacity-70 uppercase tracking-wider mb-2">Reports</p>
                    <a href="#" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-primary-dark rounded-lg transition duration-200 mb-1">
                        <span>Reports</span>
                    </a>
                </div>
                
                <div class="mt-auto px-6 py-4 border-t border-primary-dark border-opacity-30">
                    <a href="{{ route('superadmin.logout') }}" 
                       class="flex items-center mx-3 px-4 py-2.5 text-white hover:bg-red-600 rounded-lg transition duration-200">
                        <span>Logout</span>
                    </a>
                </div>
            </nav>

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
                            <span class="text-gray-700">Welcome, {{ Auth::guard('superadmin')->user()->superadmin_fullname }}</span>
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
