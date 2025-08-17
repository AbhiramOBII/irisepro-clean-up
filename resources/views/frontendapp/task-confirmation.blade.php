@extends('frontendapp.partials.app')

@section('title', 'Task Confirmation')

@section('content')
<div class="px-4 mb-24">
    <!-- Task Header with Title and Points -->
    <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-xl p-6 mb-5 shadow-md relative overflow-hidden transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 group">
        <!-- Decorative circle elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF8A3D]/5 rounded-full -mr-16 -mt-16 group-hover:bg-[#FF8A3D]/10 transition-all duration-500"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#FF8A3D]/5 rounded-full -ml-12 -mb-12 group-hover:bg-[#FF8A3D]/10 transition-all duration-500"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-[#FF8A3D]/3 rounded-full blur-3xl opacity-0 group-hover:opacity-20 transition-all duration-500"></div>
        
        <div class="relative z-10">
            <!-- Personal Greeting and Task Badge -->
            <div class="flex justify-between items-start mb-3">
                <div>
                    <div class="text-sm text-gray-600">Awesome</div>
                    <div class="text-2xl font-bold text-gray-800 mb-1">{{ strtoupper($student->full_name) }},</div>
                    <div class="text-sm text-gray-600 mb-3">You are submitting {{ $task->task_title }} task!</div>
                </div>
          
            </div>
            
            
            <!-- Divider -->
            <div class="border-b border-[#FF8A3D]/10 mb-4"></div>
            
            <!-- Points and Time Info -->
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-[#FFF5E9] flex items-center justify-center mr-2 shadow-sm">
                        <i class="fas fa-star text-[#FF8A3D]"></i>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">Earn</div>
                        <span class="text-lg font-bold text-[#FF8A3D]">{{ intval($task->taskScore->total_score ?? 0) }} points</span>
                    </div>
                </div>
                
            
            </div>
        </div>
    </div>
    
    
    
    
    <!-- Deadline Timer Card -->
    <div class="bg-white rounded-xl p-5 mb-4 shadow-md">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-[#FFF5E9] flex items-center justify-center mr-3">
                    <i class="fas fa-hourglass-half text-[#FF8A3D] animate-pulse-slow"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-500">Deadline</div>
                    <div class="text-base font-bold text-gray-700" id="countdown">24:00:00</div>
                </div>
            </div>
            <div class="text-sm font-medium text-[#FF8A3D]">Today</div>
        </div>
    </div>
    
  
    
    <!-- Submission Review Section -->
    <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-xl p-5 mb-6 shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">Review Your Submission</h3>
            <div class="bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full flex items-center">
                <i class="fas fa-check-circle mr-1"></i>
                Ready to submit
            </div>
        </div>
        
        <!-- Text Response Review -->
        <div class="mb-5">
            <div class="flex justify-between items-center mb-2">
                <label class="block text-sm font-medium text-gray-700">Your Response</label>
                <span class="text-xs text-green-600 font-medium" id="charCountDisplay">0 characters</span>
            </div>
            <div class="bg-white rounded-lg p-4 border border-gray-200">
                <p class="text-sm text-gray-700 whitespace-pre-line" id="responsePreview">Loading your response...</p>
            </div>
        </div>
        
        <!-- Attached Files Review -->
        <div class="mb-6" id="filesSection" style="display: none;">
            <label class="block text-sm font-medium text-gray-700 mb-2">Attached Files</label>
            <div id="filesList"></div>
        </div>
        
       <!-- Action Buttons -->
       <div class="flex justify-between items-center space-x-3">
           <a href="{{ route('mobile.task.submission', ['task_id' => $task->id,  'batch_id' => $batchId]) }}" class="flex-1 border border-gray-300 text-gray-700 px-4 py-3 rounded-xl text-sm font-medium hover:bg-gray-50 transition-all duration-200 flex items-center justify-center">
               <i class="fas fa-edit mr-2"></i>
               Edit Response
           </a>
                      <!-- Traditional Form Submission -->
           <form id="finalSubmissionForm" method="POST" action="{{ route('mobile.task.submit', [$task->id, $batchId]) }}" enctype="multipart/form-data" class="flex-1">
               @csrf
               <input type="hidden" name="submission_response" id="hiddenResponseText">
               <input type="hidden" name="started_at" id="timerStartTime" value="">
           
              
               <div id="hiddenFilesContainer"></div>
               
               <button type="submit" id="finalSubmitBtn" class="w-full bg-gradient-to-r from-[#FF8A3D] to-[#F9A949] text-white px-4 py-3 rounded-xl text-sm font-bold hover:opacity-90 transition-all duration-200 flex items-center justify-center shadow-md">
                   <span id="submitText">Submit Task</span>
                   <i class="fas fa-check-circle ml-2" id="submitIcon"></i>
                   <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white ml-2 hidden" id="submitSpinner"></div>
               </button>
           </form>
       </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // IndexedDB setup
    let db;
    const taskId = {{ $task->id }};
    const studentId = {{ Session::get('student_id') }};
    
    // Initialize IndexedDB
    function initDB() {
        const request = indexedDB.open('TaskSubmissions', 1);
        
        request.onerror = function(event) {
            console.error('IndexedDB error:', event.target.error);
        };
        
        request.onsuccess = function(event) {
            db = event.target.result;
            loadSubmissionData();
        };
        
        request.onupgradeneeded = function(event) {
            db = event.target.result;
            
            // Create object stores if they don't exist
            if (!db.objectStoreNames.contains('responses')) {
                const responseStore = db.createObjectStore('responses', { keyPath: 'id' });
                responseStore.createIndex('taskId', 'taskId', { unique: false });
                responseStore.createIndex('studentId', 'studentId', { unique: false });
            }
            
            if (!db.objectStoreNames.contains('files')) {
                const fileStore = db.createObjectStore('files', { keyPath: 'id', autoIncrement: true });
                fileStore.createIndex('submissionId', 'submissionId', { unique: false });
            }
        };
    }
    
    // Load submission data from IndexedDB
    function loadSubmissionData() {
        if (!db) return;
        
        const transaction = db.transaction(['responses', 'files'], 'readonly');
        const responseStore = transaction.objectStore('responses');
        const fileStore = transaction.objectStore('files');
        
        // Load response text
        const responseRequest = responseStore.get(`${studentId}_${taskId}`);
        responseRequest.onsuccess = function(event) {
            const result = event.target.result;
            if (result && result.submission_response) {
                document.getElementById('responsePreview').textContent = result.submission_response;
                document.getElementById('charCountDisplay').textContent = `${result.submission_response.length} characters`;
            } else {
                document.getElementById('responsePreview').textContent = 'No response found. Please go back and write your response.';
                document.getElementById('charCountDisplay').textContent = '0 characters';
            }
        };
        
        // Load files
        const fileIndex = fileStore.index('submissionId');
        const fileRequest = fileIndex.getAll(`${studentId}_${taskId}`);
        fileRequest.onsuccess = function(event) {
            const files = event.target.result;
            console.log('Files found in IndexedDB:', files); // Debug log
            if (files && files.length > 0) {
                displayFiles(files);
            } else {
                console.log('No files found for submission:', `${studentId}_${taskId}`);
            }
        };
        
        fileRequest.onerror = function(event) {
            console.error('Error loading files from IndexedDB:', event.target.error);
        };
    }
    
    // Display files
    function displayFiles(savedFiles) {
        const filesSection = document.getElementById('filesSection');
        const filesList = document.getElementById('filesList');
        
        console.log('Displaying files:', savedFiles); // Debug log
        console.log('Files section element:', filesSection); // Debug log
        console.log('Files list element:', filesList); // Debug log
        
        if (savedFiles.length > 0) {
            filesSection.style.display = 'block';
            filesList.innerHTML = '';
            
            savedFiles.forEach((savedFile) => {
                console.log('Creating preview for file:', savedFile.fileName); // Debug log
                const fileElement = createFilePreview(savedFile);
                filesList.appendChild(fileElement);
            });
        }
    }
    
    // Create file preview element
    function createFilePreview(savedFile) {
        const div = document.createElement('div');
        div.className = 'bg-white border border-gray-200 rounded-lg p-3 mb-3';
        
        const fileSize = (savedFile.fileSize / 1024 / 1024).toFixed(2);
        const fileType = savedFile.fileType.startsWith('image/') ? 'Image' : 
                        savedFile.fileType === 'application/pdf' ? 'PDF' : 
                        savedFile.fileType.includes('word') ? 'Document' : 'File';
        const iconClass = savedFile.fileType.startsWith('image/') ? 'fa-image' : 
                         savedFile.fileType === 'application/pdf' ? 'fa-file-pdf' : 'fa-file';
        
        let previewContent = '';
        if (savedFile.fileType.startsWith('image/')) {
            // Create blob URL for image preview
            const blob = new Blob([savedFile.fileData], { type: savedFile.fileType });
            const imageUrl = URL.createObjectURL(blob);
            previewContent = `
                <div class="rounded-lg overflow-hidden border border-gray-200 h-32 bg-white flex items-center justify-center">
                    <img src="${imageUrl}" alt="${savedFile.fileName}" class="h-full w-auto object-contain">
                </div>
            `;
        } else {
            previewContent = `
                <div class="rounded-lg overflow-hidden border border-gray-200 h-24 bg-white flex items-center justify-center p-3">
                    <div class="flex items-center justify-center w-full">
                        <i class="fas ${iconClass} text-[#FF8A3D] text-2xl mr-3"></i>
                        <span class="text-sm text-gray-600">${fileType} Document Preview</span>
                    </div>
                </div>
            `;
        }
        
        div.innerHTML = `
            <div class="flex items-center mb-2">
                <div class="w-8 h-8 bg-[#FF8A3D]/10 rounded flex items-center justify-center mr-2">
                    <i class="fas ${iconClass} text-[#FF8A3D]"></i>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-medium text-gray-800">${savedFile.fileName}</div>
                    <div class="text-xs text-gray-500">${fileSize} MB • ${fileType}</div>
                </div>
            </div>
            ${previewContent}
        `;
        
        return div;
    }
    
    // Initialize countdown timer
    function initCountdownTimer() {
        const countdownElement = document.getElementById('countdown');
        if (!countdownElement) return;
        
        const savedStartTime = localStorage.getItem('timer_start_time');
        if (!savedStartTime) {
            countdownElement.textContent = '24:00:00';
            return;
        }
        
        const startTime = new Date(savedStartTime);
        const deadline = new Date(startTime);
        deadline.setHours(deadline.getHours() + 24);
        
        function updateCountdown() {
            const now = new Date();
            const timeLeft = deadline - now;
            
            if (timeLeft <= 0) {
                countdownElement.textContent = '00:00:00';
                return;
            }
            
            const hours = Math.floor(timeLeft / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            
            countdownElement.textContent = 
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
    }
    
    // Prepare form data before traditional submission
    document.getElementById('finalSubmissionForm').addEventListener('submit', function(e) {
        if (!db) {
            alert('Unable to access saved data. Please try again.');
            e.preventDefault();
            return;
        }
        
        e.preventDefault(); // Prevent immediate submission
        
        const submitBtn = document.getElementById('finalSubmitBtn');
        const submitText = document.getElementById('submitText');
        const submitIcon = document.getElementById('submitIcon');
        const submitSpinner = document.getElementById('submitSpinner');
        
        // Show loading state
        submitBtn.disabled = true;
        submitText.textContent = 'Preparing...';
        submitIcon.classList.add('hidden');
        submitSpinner.classList.remove('hidden');
        
        // Get data from IndexedDB and populate form
        const transaction = db.transaction(['responses', 'files'], 'readonly');
        const responseStore = transaction.objectStore('responses');
        const fileStore = transaction.objectStore('files');
        
        // Get response text
        const responseRequest = responseStore.get(`${studentId}_${taskId}`);
        responseRequest.onsuccess = function(event) {
            const responseData = event.target.result;
            
            if (!responseData || !responseData.submission_response) {
                alert('No response found. Please go back and write your response.');
                resetSubmitButton();
                return;
            }
            
            // Set response text in hidden field
            document.getElementById('hiddenResponseText').value = responseData.submission_response;
            
            // Get files
            const fileIndex = fileStore.index('submissionId');
            const fileRequest = fileIndex.getAll(`${studentId}_${taskId}`);
            fileRequest.onsuccess = function(event) {
                const files = event.target.result;
                const filesContainer = document.getElementById('hiddenFilesContainer');
                
                // Clear existing file inputs
                filesContainer.innerHTML = '';
                
                files.forEach((savedFile, index) => {
                    const input = document.createElement('input');
                    input.type = 'file';
                    input.name = `submission_multimedia[${index}]`;
                    input.style.display = 'none';
                    
                    // Create a new FileList with just this file
                    const dt = new DataTransfer();
                    dt.items.add(new File([savedFile.fileData], savedFile.fileName, { type: savedFile.fileType }));
                    input.files = dt.files;
                    
                    filesContainer.appendChild(input);
                });                
                // Update button text and submit form
                submitText.textContent = 'Submitting...';
                
                // Clear IndexedDB before submission
                clearSubmissionData();
                
                // Submit the form traditionally
                setTimeout(() => {
                    document.getElementById('finalSubmissionForm').submit();
                }, 500);
            };
        };
        
        function resetSubmitButton() {
            submitBtn.disabled = false;
            submitText.textContent = 'Submit Task';
            submitIcon.classList.remove('hidden');
            submitIcon.className = 'fas fa-check-circle ml-2';
            submitSpinner.classList.add('hidden');
        }
    });
    
    // Clear submission data from IndexedDB
    function clearSubmissionData() {
        if (!db) return;
        
        const transaction = db.transaction(['responses', 'files'], 'readwrite');
        const responseStore = transaction.objectStore('responses');
        const fileStore = transaction.objectStore('files');
        
        // Clear response
        responseStore.delete(`${studentId}_${taskId}`);
        
        // Clear files
        const fileIndex = fileStore.index('submissionId');
        const request = fileIndex.openCursor(IDBKeyRange.only(`${studentId}_${taskId}`));
        
        request.onsuccess = function(event) {
            const cursor = event.target.result;
            if (cursor) {
                fileStore.delete(cursor.primaryKey);
                cursor.continue();
            }
        };
    }
    
    // Initialize
    initDB();
    initCountdownTimer();
});
</script>

<style>
@keyframes pulse-slow {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.animate-pulse-slow {
    animation: pulse-slow 2s infinite;
}

/* Mobile-specific styles */
@media (max-width: 768px) {
    .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    button {
        min-height: 44px;
        min-width: 44px;
    }
}
</style>
@endsection
