<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Evaluation - {{ $task->task_title }} - IrisePro</title>
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
        .hover-shadow:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-50 font-montserrat">
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('yashodarshi.dashboard') }}" class="flex items-center text-white hover:text-gray-200 transition-colors">
                    <img src="{{ asset('images/icon.png') }}" alt="IrisePro" class="w-8 h-8 mr-2">
                    <span class="text-lg font-semibold">IrisePro - Yashodarshi</span>
                </a>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('yashodarshi.batch.view', $batch->id) }}" 
                       class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg border border-white border-opacity-30 transition-all duration-200 text-sm">
                        <i class="fas fa-arrow-left mr-1"></i>Back to Batch
                    </a>
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
        <!-- Task Details Section -->
        <div class="bg-white rounded-2xl card-shadow mb-8">
            <div class="gradient-bg text-white rounded-t-2xl p-6">
                <h3 class="text-xl font-semibold mb-0">
                    <i class="fas fa-tasks mr-2"></i>Task Evaluation Portal
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        <h4 class="text-xl font-semibold mb-4">{{ $task->task_title }}</h4>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="font-semibold text-gray-700 w-32">Task ID:</span>
                                <span class="text-gray-900">#{{ $task->id }}</span>
                            </div>
                            <div class="flex">
                                <span class="font-semibold text-gray-700 w-32">Day Number:</span>
                                <span class="text-gray-900">Day {{ $task->day_number }}</span>
                            </div>
                            <div class="flex">
                                <span class="font-semibold text-gray-700 w-32">Total Score:</span>
                                <span class="text-gray-900">{{ $task->taskscore->total_score ?? 'N/A' }} Points</span>
                            </div>
                            <div class="flex">
                                <span class="font-semibold text-gray-700 w-32">Batch:</span>
                                <span class="text-gray-900">{{ $batch->title }}</span>
                            </div>
                            @if($task->task_description)
                            <div class="flex">
                                <span class="font-semibold text-gray-700 w-32">Description:</span>
                                <span class="text-gray-900">{{ $task->task_description }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-clipboard-check text-6xl text-gray-300 opacity-50"></i>
                        <div class="mt-4">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                <i class="fas fa-users mr-1"></i>{{ $submissions->count() }} Submissions
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Submissions Section -->
        <div class="bg-white rounded-2xl card-shadow mb-8">
            <div class="gradient-bg text-white rounded-t-2xl p-6">
                <h3 class="text-xl font-semibold mb-0">
                    <i class="fas fa-users mr-2"></i>Student Submissions ({{ $batch->students->count() }})
               
                </h3>
            </div>
            <div class="p-6">
                @if($batch->students->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted At</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($batch->students as $student)
                                  
                                    @php
                                       $yashodarshiEvaluationResult = $yashodarshiEvaluationResults->where('student_id', $student->id)->first();
                                        $submission = $submissions->where('student_id', $student->id)->first();
                                     
                                        
                                        
                                    @endphp
                                    
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-9 h-9 bg-primary text-white rounded-full flex items-center justify-center mr-3 text-sm font-semibold">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">{{ $student->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $student->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($submission)
                                                @if($submission->status == 'submitted')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-clock mr-1"></i>Submitted
                                                    </span>
                                                @elseif($submission->status == 'reviewed')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-check-circle mr-1"></i>Evaluated
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        <i class="fas fa-minus mr-1"></i>Not Submitted
                                                    </span>
                                                @endif
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    <i class="fas fa-minus mr-1"></i>Not Submitted
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($submission && $submission->submitted_at)
                                                {{ $submission->submitted_at->format('M d, Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                     
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($yashodarshiEvaluationResult && $yashodarshiEvaluationResult->total_score !== null)
                                                <span class="font-bold text-primary">{{ $yashodarshiEvaluationResult->total_score }}/{{ $task->taskscore->total_score ?? 100 }}</span>
                                            @elseif($submission && $submission->score !== null)
                                                <span class="font-bold text-primary">{{ $submission->score }}/{{ $task->taskscore->total_score ?? 100 }}</span>
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($submission)
                                                @if($submission->status == 'submitted')
                                                    <a href="{{ route('yashodarshi.submission.evaluate-detail', $submission->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition-colors duration-200">
                                                        <i class="fas fa-star mr-1"></i>Evaluate
                                                    </a>
                                                @elseif($submission->status == 'reviewed')
                                                    <a href="{{ route('yashodarshi.submission.view-full-score', $submission->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition-colors duration-200">
                                                        <i class="fas fa-eye mr-1"></i>View Full Score
                                                    </a>
                                                @else
                                                    <button class="bg-gray-400 text-white px-3 py-1 rounded-lg text-xs font-medium cursor-not-allowed" disabled>
                                                        <i class="fas fa-clock mr-1"></i>Pending
                                                    </button>
                                                @endif
                                            @else
                                                <button class="bg-gray-400 text-white px-3 py-1 rounded-lg text-xs font-medium cursor-not-allowed" disabled>
                                                    <i class="fas fa-clock mr-1"></i>Pending
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($submission && ($submission->submission_response || $submission->submission_multimedia))
                                        <tr class="bg-gray-50">
                                            <td colspan="5" class="px-6 py-4">
                                                <div class="pl-4">
                                                    @if($submission->submission_response)
                                                        <div class="mb-4">
                                                            <span class="font-semibold text-gray-600">Response:</span>
                                                            <div class="mt-2 p-3 bg-white rounded-lg border border-gray-200">{{ $submission->submission_response }}</div>
                                                        </div>
                                                    @endif
                                                    
                                                    @if($submission->submission_multimedia)
                                                        <div class="mb-2">
                                                            <span class="font-semibold text-gray-600">Files:</span>
                                                            <div class="mt-2 flex flex-wrap gap-2">
                                                                @php
                                                                    $multimedia = json_decode($submission->submission_multimedia, true);
                                                                @endphp
                                                                @if($multimedia && is_array($multimedia))
                                                                    @foreach($multimedia as $file)
                                                                        <div class="inline-block">
                                                                            @if(str_contains($file, '.jpg') || str_contains($file, '.jpeg') || str_contains($file, '.png') || str_contains($file, '.gif'))
                                                                                <img src="{{ asset('storage/' . $file) }}" alt="Submission" class="max-h-24 rounded-lg shadow-sm cursor-pointer hover:opacity-90 transition-opacity" onclick="openImageModal('{{ asset('storage/' . $file) }}')">
                                                                            @else
                                                                                <a href="{{ asset('storage/' . $file) }}" target="_blank" class="inline-flex items-center px-3 py-1 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg text-xs transition-colors duration-200">
                                                                                    <i class="fas fa-file mr-1"></i>View File
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-users text-5xl text-gray-400 mb-4"></i>
                        <h5 class="text-xl font-semibold text-gray-600 mb-2">No Students Enrolled</h5>
                        <p class="text-gray-500">No students are enrolled in this batch yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
        <div class="relative p-4 w-full max-w-4xl mx-auto">
            <button type="button" class="absolute top-4 right-4 text-white hover:text-gray-200 z-10" onclick="closeImageModal()">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <div class="flex items-center justify-center h-full">
                <img id="fullSizeImage" src="" alt="Full size image" class="max-w-full max-h-[80vh] object-contain">
            </div>
        </div>
    </div>
    
    <!-- Evaluation Modal -->
    <div id="evaluationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-2xl bg-white">
            <div class="gradient-bg text-white rounded-t-xl p-4 -m-5 mb-4">
                <h5 class="text-lg font-semibold">Evaluate Submission</h5>
                <button type="button" class="absolute top-4 right-4 text-white hover:text-gray-200" onclick="closeModal()">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="evaluationForm">
                    @csrf
                    <input type="hidden" id="submissionId" name="submission_id">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2"><strong>Student:</strong></label>
                        <input type="text" id="studentName" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" readonly>
                    </div>
                    
                    <div class="mb-4">
                        <label for="score" class="block text-sm font-medium text-gray-700 mb-2">Score (out of {{ $task->taskscore->total_score ?? 100 }})</label>
                        <input type="number" id="score" name="score" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" min="0" max="{{ $task->taskscore->total_score ?? 100 }}" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="feedback" class="block text-sm font-medium text-gray-700 mb-2">Feedback</label>
                        <textarea id="feedback" name="feedback" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" rows="4" placeholder="Provide detailed feedback for the student..."></textarea>
                    </div>
                    
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" required>
                            <option value="reviewed">Reviewed</option>
                            <option value="submitted">Needs Revision</option>
                        </select>
                    </div>
                </form>
                <div class="flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200" onclick="closeModal()">Cancel</button>
                    <button type="button" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200" onclick="submitEvaluation()">Save Evaluation</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Image modal functions
        function openImageModal(imageSrc) {
            const fullSizeImage = document.getElementById('fullSizeImage');
            fullSizeImage.src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
            
            // Add click event to close modal when clicking outside the image
            document.getElementById('imageModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeImageModal();
                }
            });
        }
        
        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
        
        function openEvaluationModal(submissionId, studentName) {
            document.getElementById('submissionId').value = submissionId;
            document.getElementById('studentName').value = studentName;
            
            // Reset form
            document.getElementById('score').value = '';
            document.getElementById('feedback').value = '';
            document.getElementById('status').value = 'reviewed';
            
            document.getElementById('evaluationModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('evaluationModal').classList.add('hidden');
        }

        function submitEvaluation() {
            const form = document.getElementById('evaluationForm');
            const formData = new FormData(form);
            const submissionId = document.getElementById('submissionId').value;
            
            // Send evaluation data to server
            fetch(`/yashodarshi/task/submission/${submissionId}/evaluate`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Evaluation saved successfully!');
                    closeModal();
                    location.reload();
                } else {
                    alert('Error saving evaluation: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving evaluation. Please try again.');
            });
        }

        // Close modal when clicking outside
        document.getElementById('evaluationModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>
