<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batch Details - {{ $batch->title }} - IrisePro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Montserrat', sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        .section-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 1.5rem;
            margin: 0;
        }
        .btn-logout {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            color: white;
        }
        .btn-logout:hover {
            background: rgba(255,255,255,0.3);
            color: white;
        }
        .task-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .task-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .badge-custom {
            font-size: 0.75rem;
            padding: 0.5rem 0.75rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('yashodarshi.dashboard') }}">
                <img src="{{ asset('images/icon.png') }}" alt="IrisePro" width="30" height="30" class="me-2">
                IrisePro - Yashodarshi
            </a>
            <div class="navbar-nav ms-auto">
                <a href="{{ route('yashodarshi.dashboard') }}" class="btn btn-logout btn-sm me-2">
                    <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
                </a>
                <form action="{{ route('yashodarshi.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-logout btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Batch Details Section -->
        <div class="content-card">
            <div class="section-header">
                <h3 class="mb-0">
                    <i class="fas fa-layer-group me-2"></i>Batch Details
                </h3>
            </div>
            <div class="p-4">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="mb-3">{{ $batch->title }}</h4>
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Batch ID:</strong></div>
                            <div class="col-sm-9">#{{ $batch->id }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Status:</strong></div>
                            <div class="col-sm-9">
                                @if($batch->calculated_status == 'active')
                                    <span class="badge bg-success badge-custom">Active</span>
                                @elseif($batch->calculated_status == 'ongoing')
                                    <span class="badge bg-warning badge-custom">Ongoing</span>
                                @elseif($batch->calculated_status == 'completed')
                                    <span class="badge bg-primary badge-custom">Completed</span>
                                @else
                                    <span class="badge bg-secondary badge-custom">Inactive</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Start Date:</strong></div>
                            <div class="col-sm-9">{{ $batch->start_date->format('M d, Y') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Time:</strong></div>
                            <div class="col-sm-9">{{ \Carbon\Carbon::parse($batch->time)->format('H:i A') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Students:</strong></div>
                            <div class="col-sm-9">
                                <span class="badge bg-info badge-custom">
                                    <i class="fas fa-users me-1"></i>{{ $batch->students->count() }} Enrolled
                                </span>
                            </div>
                        </div>
                        @if($batch->description)
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Description:</strong></div>
                            <div class="col-sm-9">{{ $batch->description }}</div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-layer-group fa-5x text-muted opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Challenge Details Section -->
        @if($batch->challenge)
        <div class="content-card">
            <div class="section-header">
                <h3 class="mb-0">
                    <i class="fas fa-trophy me-2"></i>Challenge Details
                </h3>
            </div>
            <div class="p-4">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="mb-3">{{ $batch->challenge->title }}</h4>
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Challenge ID:</strong></div>
                            <div class="col-sm-9">#{{ $batch->challenge->id }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Duration:</strong></div>
                            <div class="col-sm-9">{{ $batch->challenge->duration_days }} Days</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Price:</strong></div>
                            <div class="col-sm-9">₹{{ number_format($batch->challenge->selling_price, 2) }}</div>
                        </div>
                        @if($batch->challenge->description)
                        <div class="row mb-3">
                            <div class="col-sm-3"><strong>Description:</strong></div>
                            <div class="col-sm-9">{{ $batch->challenge->description }}</div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-trophy fa-5x text-warning opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Tasks Section -->
        @if($batch->challenge && $batch->challenge->tasks->count() > 0)
        <div class="content-card">
            <div class="section-header">
                <h3 class="mb-0">
                    <i class="fas fa-tasks me-2"></i>Challenge Tasks ({{ $batch->challenge->tasks->count() }})
                </h3>
            </div>
            <div class="p-4">
                <div class="row">
                    @foreach($batch->challenge->tasks as $task)
                    
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="task-card p-4 h-100">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">{{ $task->task_title }}</h5>
                                    <span class="badge bg-primary">Day {{ $task->day_number }}</span>
                                </div>
                                
                                @if($task->task_description)
                                <p class="text-muted small mb-3">{{ Str::limit($task->task_description, 100) }}</p>
                                @endif
                                
                                <div class="mb-3">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-star me-1"></i>
                                        Points: {{ $task->taskscore->total_score  ?? 'N/A' }}
                                    </small>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-clock me-1"></i>
                                        Created: {{ $task->created_at->format('M d, Y') }}
                                    </small>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-md-4 text-center">
                                        <a href="{{ route('yashodarshi.task.evaluate', ['batchId' => $batch->id, 'taskId' => $task->id]) }}" class="btn btn-primary w-100">
                                            <i class="fas fa-clipboard-check me-1"></i>Evaluate Task
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="content-card">
            <div class="section-header">
                <h3 class="mb-0">
                    <i class="fas fa-tasks me-2"></i>Challenge Tasks
                </h3>
            </div>
            <div class="p-4 text-center">
                <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No Tasks Available</h5>
                <p class="text-muted">This challenge doesn't have any tasks assigned yet.</p>
            </div>
        </div>
        @endif

        <!-- Students Section -->
        @if($batch->students->count() > 0)
        <div class="content-card">
            <div class="section-header">
                <h3 class="mb-0">
                    <i class="fas fa-users me-2"></i>Enrolled Students ({{ $batch->students->count() }})
                </h3>
            </div>
            <div class="p-4">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                               
                                <th>Enrolled Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($batch->students as $student)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                                                {{ strtoupper(substr($student->name, 0, 1)) }}
                                            </div>
                                            {{ $student->name }}
                                        </div>
                                    </td>
                                    <td>{{ $student->email }}</td>
                                   
                                    <td>{{ $student->pivot->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
