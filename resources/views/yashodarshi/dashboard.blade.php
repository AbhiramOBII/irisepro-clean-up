<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yashodarshi Dashboard - IrisePro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'montserrat': ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#667eea',
                        'secondary': '#764ba2',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-shadow {
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .hover-lift:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gray-50 font-montserrat">
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="#" class="flex items-center text-white hover:text-gray-200 transition-colors">
                    <img src="{{ asset('images/icon.png') }}" alt="IrisePro" class="w-8 h-8 mr-2">
                    <span class="text-lg font-semibold">IrisePro - Yashodarshi</span>
                </a>
                <div class="flex items-center">
                    <form action="{{ route('yashodarshi.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg border border-white border-opacity-30 transition-all duration-200 text-sm">
                            <i class="fas fa-sign-out-alt mr-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 mb-6 flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
                <button type="button" class="text-green-600 hover:text-green-800" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Welcome Card -->
        <div class="gradient-bg text-white rounded-2xl p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-center">
                <div class="md:col-span-3">
                    <h2 class="text-2xl font-bold mb-2">Welcome back, {{ $yashodarshi->name }}!</h2>
                    <p class="mb-2 opacity-90">
                        <i class="fas fa-envelope mr-2"></i>{{ $yashodarshi->email }}
                    </p>
                    <small class="opacity-75">
                        <i class="fas fa-circle mr-1 text-green-300"></i>Status: {{ ucfirst($yashodarshi->status) }}
                    </small>
                </div>
                <div class="text-center md:text-right">
                    <i class="fas fa-user-check text-6xl opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl card-shadow p-6 text-center hover-lift transition-all duration-300">
                <i class="fas fa-layer-group text-4xl text-primary mb-4"></i>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Total Batches</h4>
                <h2 class="text-3xl font-bold text-primary">{{ $totalBatches }}</h2>
                <p class="text-gray-500 text-sm">Batches assigned to you</p>
            </div>
            <div class="bg-white rounded-2xl card-shadow p-6 text-center hover-lift transition-all duration-300">
                <i class="fas fa-play-circle text-4xl text-green-600 mb-4"></i>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Active Batches</h4>
                <h2 class="text-3xl font-bold text-green-600">{{ $activeBatches }}</h2>
                <p class="text-gray-500 text-sm">Ready to start</p>
            </div>
            <div class="bg-white rounded-2xl card-shadow p-6 text-center hover-lift transition-all duration-300">
                <i class="fas fa-clock text-4xl text-yellow-500 mb-4"></i>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Ongoing Batches</h4>
                <h2 class="text-3xl font-bold text-yellow-500">{{ $ongoingBatches }}</h2>
                <p class="text-gray-500 text-sm">Currently running</p>
            </div>
            <div class="bg-white rounded-2xl card-shadow p-6 text-center hover-lift transition-all duration-300">
                <i class="fas fa-users text-4xl text-blue-500 mb-4"></i>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">Total Students</h4>
                <h2 class="text-3xl font-bold text-blue-500">{{ $totalStudents }}</h2>
                <p class="text-gray-500 text-sm">Students under evaluation</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl card-shadow p-6 mb-8">
            <h4 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-bolt mr-2 text-yellow-500"></i>Quick Actions
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="#" class="border-2 border-primary text-primary hover:bg-primary hover:text-white transition-all duration-200 rounded-xl p-4 text-center font-medium">
                    <i class="fas fa-list-check mr-2"></i>
                    View Pending Tasks
                </a>
                <a href="#" class="border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white transition-all duration-200 rounded-xl p-4 text-center font-medium">
                    <i class="fas fa-chart-line mr-2"></i>
                    Evaluation Reports
                </a>
            </div>
        </div>

        <!-- Assigned Batches -->
        <div class="bg-white rounded-2xl card-shadow p-6 mb-8">
            <h4 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-layer-group mr-2 text-primary"></i>My Assigned Batches ({{ $totalBatches }})
            </h4>
            
            @if($yashodarshiWithBatches->batches->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($yashodarshiWithBatches->batches as $batch)
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 h-full">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <h5 class="text-lg font-semibold text-gray-800 mb-0">{{ $batch->title }}</h5>
                                    @if($batch->calculated_status == 'active')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Active</span>
                                    @elseif($batch->calculated_status == 'ongoing')
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">Ongoing</span>
                                    @elseif($batch->calculated_status == 'completed')
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Completed</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">Inactive</span>
                                    @endif
                                </div>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-trophy mr-2"></i>
                                        Challenge: {{ $batch->challenge->title ?? 'N/A' }}
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-calendar mr-2"></i>
                                        Start: {{ $batch->start_date->format('M d, Y') }}
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-clock mr-2"></i>
                                        Time: {{ \Carbon\Carbon::parse($batch->time)->format('H:i') }}
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                        <i class="fas fa-users mr-1"></i>
                                        {{ $batch->students->count() }} Students
                                    </span>
                                    <a href="{{ route('yashodarshi.batch.view', $batch->id) }}" class="border border-primary text-primary hover:bg-primary hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                        <i class="fas fa-eye mr-1"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-layer-group text-6xl text-gray-300 mb-4"></i>
                    <h5 class="text-xl font-medium text-gray-600 mb-2">No Batches Assigned</h5>
                    <p class="text-gray-500">You don't have any batches assigned to you yet. Contact your administrator for batch assignments.</p>
                </div>
            @endif
        </div>

        @if($yashodarshi->biodata)
        <!-- Biodata Section -->
        <div class="bg-white rounded-2xl card-shadow p-6">
            <h4 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user mr-2 text-primary"></i>About Me
            </h4>
            <p class="text-gray-600 leading-relaxed">{{ $yashodarshi->biodata }}</p>
        </div>
        @endif
    </div>
</body>
</html>
