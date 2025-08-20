@extends('superadmin.layout')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Main Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Students Statistics -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-graduate text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Students</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Student::count() }}</p>
                <p class="text-xs text-gray-500">Active: {{ \App\Models\Student::where('status', 'active')->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Yashodarshis Statistics -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-success rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-tie text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Yashodarshis</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Yashodarshi::count() }}</p>
                <p class="text-xs text-gray-500">Mentors & Guides</p>
            </div>
        </div>
    </div>

    <!-- Tasks Statistics -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-info rounded-lg flex items-center justify-center">
                    <i class="fas fa-tasks text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Tasks</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Task::count() }}</p>
                <p class="text-xs text-gray-500">Scores: {{ \App\Models\TaskScore::count() }}</p>
            </div>
        </div>
    </div>

    <!-- Batches Statistics -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Active Batches</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Batch::count() }}</p>
                <p class="text-xs text-gray-500">Learning Groups</p>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Statistics Row -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Challenges Statistics -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-trophy text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Challenges</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Challenge::count() }}</p>
                <p class="text-xs text-gray-500">Growth Activities</p>
            </div>
        </div>
    </div>

    <!-- Enrollments Statistics -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-plus text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Enrollments</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Enrollment::count() }}</p>
                <p class="text-xs text-gray-500">Paid: {{ \App\Models\Enrollment::where('payment_status', 'paid')->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Habits Statistics -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Habits</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Habit::count() }}</p>
                <p class="text-xs text-gray-500">Daily Practices</p>
            </div>
        </div>
    </div>

    <!-- System Status -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-server text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">System Status</p>
                <p class="text-xl font-bold text-green-600">Online</p>
                <p class="text-xs text-gray-500">All systems operational</p>
            </div>
        </div>
    </div>

    <!-- Last Login -->
    <div class="bg-card-bg rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-indigo-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-white text-lg"></i>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Last Login</p>
                <p class="text-sm font-bold text-gray-900">{{ $superadmin->last_login ? $superadmin->last_login->format('M d, H:i') : 'First Login' }}</p>
                <p class="text-xs text-gray-500">Session activity</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Student & User Management -->
    <div class="bg-card-bg rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-users mr-2 text-primary"></i>
                User Management
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('students.index') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-user-graduate mr-2"></i>
                    Manage Students
                </a>
                <a href="{{ route('yashodarshis.index') }}" class="bg-success hover:bg-green-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-user-tie mr-2"></i>
                    Manage Yashodarshis
                </a>
                <a href="{{ route('students.bulk-upload') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-upload mr-2"></i>
                    Bulk Upload Students
                </a>
                <a href="{{ route('yashodarshis.bulk-upload') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-upload mr-2"></i>
                    Bulk Upload Yashodarshis
                </a>
                <a href="{{ route('superadmin.enrollments.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Manage Enrollments
                </a>
            </div>
        </div>
    </div>

    <!-- Learning & Assessment -->
    <div class="bg-card-bg rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-graduation-cap mr-2 text-info"></i>
                Learning & Assessment
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('superadmin.tasks.index') }}" class="bg-info hover:bg-blue-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-tasks mr-2"></i>
                    Manage Tasks
                </a>
                <a href="{{ route('superadmin.task-scores.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-chart-line mr-2"></i>
                    Task Scores
                </a>
                <a href="{{ route('challenges.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-trophy mr-2"></i>
                    Manage Challenges
                </a>
                <a href="{{ route('batches.index') }}" class="bg-teal-500 hover:bg-teal-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-layer-group mr-2"></i>
                    Manage Batches
                </a>
            </div>
        </div>
    </div>
</div>

<!-- System Management & Tools -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Personal Development -->
    <div class="bg-card-bg rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-seedling mr-2 text-success"></i>
                Personal Development
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-4">
                <a href="{{ route('habits.index') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    Manage Habits
                </a>
                <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Progress Reports
                </button>
            </div>
        </div>
    </div>

    <!-- System Administration -->
    <div class="bg-card-bg rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i class="fas fa-cogs mr-2 text-gray-600"></i>
                System Administration
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-4">
                <a href="{{ route('superadmin.settings') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-cog mr-2"></i>
                    System Settings
                </a>
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg font-medium transition duration-200 text-center flex items-center justify-center">
                    <i class="fas fa-database mr-2"></i>
                    Backup System
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
