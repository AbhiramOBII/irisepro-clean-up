@extends('frontendapp.partials.app')

@section('title', 'Task Submission')

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
    
  
    
    <!-- Task Submission Form -->
    <div class="bg-white rounded-xl p-5 mb-6 shadow-md">
        <h3 class="text-lg font-bold text-gray-800 mb-3">Submit Your Response</h3>
        
        <form id="taskSubmissionForm" action="{{ route('mobile.task.submit', [$task->id, $batchId]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Hidden inputs for task submission -->
            <input type="hidden" name="started_at" id="timerStartTime" value="">
           
            <!-- Text Response Area -->
            <div class="mb-4">
                <label for="responseText" class="block text-sm font-medium text-gray-700 mb-2">Your Response</label>
                <div class="relative">
                    <textarea id="responseText" name="response_text" rows="6" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#FF8A3D]/30 focus:border-[#FF8A3D] outline-none transition-all duration-200 text-gray-700 text-sm" placeholder="Type your response here..." {{ $isTaskCompleted ? 'readonly' : '' }}>{{ $taskSubmission->response_text ?? '' }}</textarea>
               
            </div>
            <div class="flex justify-between items-center mt-2">
                <span class="text-xs text-gray-500">Min. 100 characters</span>
                <span class="text-xs text-gray-500"><span id="charCount">0</span>/2000</span>
            </div>
        </div>
        
        <!-- File Upload Section -->
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">Add Multimedia</label>
            
            @if(!$isTaskCompleted)
            <!-- File Upload Area -->
            <div class="mb-4">
                <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 text-center hover:border-[#FF8A3D]/50 transition-colors duration-200 bg-gray-50">
                    <input type="file" id="fileUpload" name="response_files[]" class="hidden" multiple accept="image/*,video/*,.pdf,.doc,.docx">
                    <label for="fileUpload" class="cursor-pointer">
                        <div class="w-12 h-12 bg-[#FF8A3D]/10 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-cloud-upload-alt text-[#FF8A3D] text-xl"></i>
                        </div>
                        <p class="text-sm font-medium text-gray-700 mb-1">Drag files here or click to browse</p>
                        <p class="text-xs text-gray-500">Supports: Images, Videos, PDFs, Word docs (Max 250MB)</p>
                    </label>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Selected Files Preview -->
        <div id="selectedFiles" class="mb-5" style="display: none;">
            <label class="block text-sm font-medium text-gray-700 mb-2">Selected Files</label>
            <div id="filesList"></div>
        </div>
        
        @if($taskSubmission && $taskSubmission->response_image)
        <!-- Existing Submitted Files -->
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">Submitted Files</label>
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 flex items-center group">
                <div class="w-10 h-10 bg-[#FF8A3D]/10 rounded flex items-center justify-center mr-3">
                    <i class="fas fa-image text-[#FF8A3D]"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium text-gray-800 truncate">{{ basename($taskSubmission->response_image) }}</div>
                    <div class="text-xs text-gray-500">Submitted File</div>
                </div>
                <a href="{{ asset('storage/' . $taskSubmission->response_image) }}" target="_blank" class="ml-2 text-[#FF8A3D] hover:text-[#FF8A3D]/80 transition-colors duration-200">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
        @endif
        
            <!-- Submit Button -->
            <div class="flex justify-center">
                @if($isTaskCompleted)
                    <div class="bg-green-500 text-white px-10 py-4 rounded-xl text-base font-bold flex items-center shadow-lg">
                        Task Completed
                        <i class="fas fa-check ml-2"></i>
                    </div>
                @elseif(!$isTaskAvailable)
                    <div class="bg-gray-400 text-white px-10 py-4 rounded-xl text-base font-bold flex items-center shadow-lg">
                        Complete Previous Tasks
                        <i class="fas fa-lock ml-2"></i>
                    </div>
                @else
                    <button type="submit" id="submitBtn" class="bg-gradient-to-r from-[#FF8A3D] to-[#F9A949] text-white px-10 py-4 rounded-xl text-base font-bold hover:opacity-90 transition-all duration-200 flex items-center shadow-lg">
                        <span id="submitText">Submit Response</span>
                        <i class="fas fa-paper-plane ml-2" id="submitIcon"></i>
                        <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white ml-2 hidden" id="submitSpinner"></div>
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // IndexedDB setup for temporary storage
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
            loadSavedData();
        };
        
        request.onupgradeneeded = function(event) {
            db = event.target.result;
            
            // Create object stores
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
    
    // Save response text to IndexedDB
    function saveResponseText(text) {
        if (!db) return;
        
        const transaction = db.transaction(['responses'], 'readwrite');
        const store = transaction.objectStore('responses');
        
        const submissionData = {
            id: `${studentId}_${taskId}`,
            taskId: taskId,
            studentId: studentId,
            submission_response: text,
            timestamp: new Date().toISOString(),
            status: 'draft'
        };
        
        store.put(submissionData);
    }
    
    // Save files to IndexedDB
    function saveFiles(files) {
        if (!db || !files.length) {
            console.log('No DB or no files to save'); // Debug log
            return;
        }
        
        console.log('Saving files to IndexedDB:', files.length, 'files'); // Debug log
        
        const submissionId = `${studentId}_${taskId}`;
        console.log('Submission ID for files:', submissionId); // Debug log
        
        // Clear existing files first, then save new ones
        clearExistingFiles(submissionId, function() {
            // Now save new files
            Array.from(files).forEach((file, index) => {
                console.log('Processing file:', file.name, 'Size:', file.size, 'Type:', file.type); // Debug log
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const transaction = db.transaction(['files'], 'readwrite');
                    const store = transaction.objectStore('files');
                    
                    const fileData = {
                        submissionId: submissionId,
                        fileName: file.name,
                        fileType: file.type,
                        fileSize: file.size,
                        fileData: e.target.result,
                        index: index,
                        timestamp: new Date().toISOString()
                    };
                    
                    console.log('Attempting to save file:', fileData.fileName); // Debug log
                    
                    const addRequest = store.add(fileData);
                    
                    addRequest.onsuccess = function(event) {
                        console.log('✅ File saved successfully:', fileData.fileName, 'ID:', event.target.result); // Debug log
                    };
                    
                    addRequest.onerror = function(event) {
                        console.error('❌ Error saving file:', fileData.fileName, event.target.error); // Debug log
                    };
                    
                    transaction.oncomplete = function() {
                        console.log('Transaction completed for file:', fileData.fileName); // Debug log
                    };
                    
                    transaction.onerror = function(event) {
                        console.error('Transaction error:', event.target.error); // Debug log
                    };
                };
                
                reader.onerror = function(e) {
                    console.error('FileReader error for:', file.name, e); // Debug log
                };
                
                reader.readAsArrayBuffer(file);
            });
        });
    }
    
    // Clear existing files for this submission
    function clearExistingFiles(submissionId, callback) {
        const transaction = db.transaction(['files'], 'readwrite');
        const store = transaction.objectStore('files');
        const index = store.index('submissionId');
        const request = index.openCursor(IDBKeyRange.only(submissionId));
        
        request.onsuccess = function(event) {
            const cursor = event.target.result;
            if (cursor) {
                console.log('Deleting existing file:', cursor.value.fileName); // Debug log
                store.delete(cursor.primaryKey);
                cursor.continue();
            } else {
                console.log('Finished clearing existing files'); // Debug log
                if (callback) callback();
            }
        };
        
        request.onerror = function(event) {
            console.error('Error clearing existing files:', event.target.error); // Debug log
            if (callback) callback();
        };
    }
    
    // Load saved data from IndexedDB
    function loadSavedData() {
        if (!db) return;
        
        const transaction = db.transaction(['responses', 'files'], 'readonly');
        const responseStore = transaction.objectStore('responses');
        const fileStore = transaction.objectStore('files');
        
        // Load response text
        const responseRequest = responseStore.get(`${studentId}_${taskId}`);
        responseRequest.onsuccess = function(event) {
            const result = event.target.result;
            if (result && result.submission_response && responseText) {
                responseText.value = result.submission_response;
                charCount.textContent = result.submission_response.length;
                
                // Show recovery notification
                showRecoveryNotification();
            }
        };
        
        // Load files
        const fileIndex = fileStore.index('submissionId');
        const fileRequest = fileIndex.getAll(`${studentId}_${taskId}`);
        fileRequest.onsuccess = function(event) {
            const files = event.target.result;
            if (files && files.length > 0) {
                displaySavedFiles(files);
            }
        };
    }
    
    // Display saved files
    function displaySavedFiles(savedFiles) {
        if (savedFiles.length > 0) {
            selectedFiles.style.display = 'block';
            filesList.innerHTML = '';
            
            savedFiles.forEach((savedFile, index) => {
                const fileItem = createSavedFilePreview(savedFile, index);
                filesList.appendChild(fileItem);
            });
        }
    }
    
    // Create preview for saved files
    function createSavedFilePreview(savedFile, index) {
        const div = document.createElement('div');
        div.className = 'bg-gray-50 border border-gray-200 rounded-lg p-3 flex items-center mb-2 group hover:border-[#FF8A3D]/30 transition-all duration-200';
        
        const fileSize = (savedFile.fileSize / 1024 / 1024).toFixed(2);
        const fileType = savedFile.fileType.startsWith('image/') ? 'Image' : 
                        savedFile.fileType === 'application/pdf' ? 'PDF' : 
                        savedFile.fileType.includes('word') ? 'Document' : 'File';
        const iconClass = savedFile.fileType.startsWith('image/') ? 'fa-image' : 
                         savedFile.fileType === 'application/pdf' ? 'fa-file-pdf' : 'fa-file';
        
        div.innerHTML = `
            <div class="w-10 h-10 bg-[#FF8A3D]/10 rounded flex items-center justify-center mr-3">
                <i class="fas ${iconClass} text-[#FF8A3D]"></i>
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-sm font-medium text-gray-800 truncate">${savedFile.fileName}</div>
                <div class="text-xs text-gray-500">${fileSize} MB • ${fileType} • Saved</div>
            </div>
            <button type="button" class="ml-2 text-gray-400 hover:text-red-500 transition-colors duration-200" onclick="removeSavedFile(${index})">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        return div;
    }
    
    // Remove saved file
    window.removeSavedFile = function(index) {
        if (!db) return;
        
        const transaction = db.transaction(['files'], 'readwrite');
        const store = transaction.objectStore('files');
        const fileIndex = store.index('submissionId');
        const submissionId = `${studentId}_${taskId}`;
        
        const request = fileIndex.openCursor(IDBKeyRange.only(submissionId));
        let currentIndex = 0;
        
        request.onsuccess = function(event) {
            const cursor = event.target.result;
            if (cursor) {
                if (currentIndex === index) {
                    store.delete(cursor.primaryKey);
                    loadSavedData(); // Refresh display
                    return;
                }
                currentIndex++;
                cursor.continue();
            }
        };
    };
    
    // Show recovery notification
    function showRecoveryNotification() {
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 text-sm';
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
    
    // Initialize IndexedDB
    initDB();
    
    // Character counter for textarea
    const responseText = document.getElementById('responseText');
    const charCount = document.getElementById('charCount');
    
    if (responseText) {
        // Initialize character count
        charCount.textContent = responseText.value.length;
        
        responseText.addEventListener('input', function() {
            charCount.textContent = this.value.length;
            // Auto-save to IndexedDB
            saveResponseText(this.value);
        });
    }
    
    // File upload handling
    const fileUpload = document.getElementById('fileUpload');
    const selectedFiles = document.getElementById('selectedFiles');
    const filesList = document.getElementById('filesList');
    
    if (fileUpload) {
        fileUpload.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            console.log('Files selected:', files.length, files); // Debug log
            
            if (files.length > 0) {
                selectedFiles.style.display = 'block';
                filesList.innerHTML = '';
                
                files.forEach((file, index) => {
                    const fileItem = createFilePreview(file, index);
                    filesList.appendChild(fileItem);
                });
                
                // Save files to IndexedDB
                console.log('Calling saveFiles with:', files); // Debug log
                saveFiles(files);
            } else {
                selectedFiles.style.display = 'none';
            }
        });
    }
    
    // Create file preview element
    function createFilePreview(file, index) {
        const div = document.createElement('div');
        div.className = 'bg-gray-50 border border-gray-200 rounded-lg p-3 flex items-center mb-2 group hover:border-[#FF8A3D]/30 transition-all duration-200';
        
        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        const fileType = file.type.startsWith('image/') ? 'Image' : 
                        file.type === 'application/pdf' ? 'PDF' : 
                        file.type.includes('word') ? 'Document' : 'File';
        const iconClass = file.type.startsWith('image/') ? 'fa-image' : 
                         file.type === 'application/pdf' ? 'fa-file-pdf' : 'fa-file';
        
        div.innerHTML = `
            <div class="w-10 h-10 bg-[#FF8A3D]/10 rounded flex items-center justify-center mr-3">
                <i class="fas ${iconClass} text-[#FF8A3D]"></i>
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-sm font-medium text-gray-800 truncate">${file.name}</div>
                <div class="text-xs text-gray-500">${fileSize} MB • ${fileType}</div>
            </div>
            <button type="button" class="ml-2 text-gray-400 hover:text-red-500 transition-colors duration-200" onclick="removeFile(${index})">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        return div;
    }
    
    // Remove file function
    window.removeFile = function(index) {
        const dt = new DataTransfer();
        const files = Array.from(fileUpload.files);
        
        files.forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });
        
        fileUpload.files = dt.files;
        
        // Trigger change event to update preview
        const event = new Event('change', { bubbles: true });
        fileUpload.dispatchEvent(event);
    };
    
    // Initialize 24-hour countdown timer based on saved timer_start_time
    let countdownInterval = null;
    
    function initCountdownTimer() {
        const countdownElement = document.getElementById('countdown');
        if (!countdownElement) return;
        
        // Check if timer was started from localStorage
        const savedStartTime = localStorage.getItem('timer_start_time');
        if (!savedStartTime) {
            countdownElement.textContent = '24:00:00';
            return;
        }
        
        // Calculate deadline from saved start time
        const startTime = new Date(savedStartTime);
        const deadline = new Date(startTime);
        deadline.setHours(deadline.getHours() + 24);
        
        function updateCountdown() {
            const now = new Date();
            const timeLeft = deadline - now;
            
            if (timeLeft <= 0) {
                countdownElement.textContent = '00:00:00';
                clearInterval(countdownInterval);
                localStorage.removeItem('timer_start_time');
                return;
            }
            
            const hours = Math.floor(timeLeft / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            
            countdownElement.textContent = 
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        updateCountdown(); // Initial call
        countdownInterval = setInterval(updateCountdown, 1000);
    }
    
    // Start countdown timer
    initCountdownTimer();
    
    // Form submission handling
    const form = document.getElementById('taskSubmissionForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitIcon = document.getElementById('submitIcon');
    const submitSpinner = document.getElementById('submitSpinner');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate minimum character requirement
            const textLength = responseText ? responseText.value.length : 0;
            if (textLength < 100) {
                alert('Please write at least 100 characters in your response.');
                return;
            }
            
            // Set timer_start_time from localStorage
            const timerStartTimeInput = document.getElementById('timerStartTime');
            const savedStartTime = localStorage.getItem('timer_start_time');
            if (timerStartTimeInput && savedStartTime) {
                timerStartTimeInput.value = savedStartTime;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = 'Saving...';
            submitIcon.classList.add('hidden');
            submitSpinner.classList.remove('hidden');
            
            // Save to IndexedDB first
            saveResponseText(responseText.value);
            
            // Update submission status to pending
            if (db) {
                const transaction = db.transaction(['responses'], 'readwrite');
                const store = transaction.objectStore('responses');
                
                const submissionData = {
                    id: `${studentId}_${taskId}`,
                    taskId: taskId,
                    studentId: studentId,
                    submission_response: responseText.value,
                    timestamp: new Date().toISOString(),
                    status: 'pending_submission'
                };
                
                store.put(submissionData);
                
                // Show success message and redirect
                setTimeout(() => {
                    submitText.textContent = 'Saved';
                    submitSpinner.classList.add('hidden');
                    submitIcon.classList.remove('hidden');
                    submitIcon.className = 'fas fa-check ml-2';
                    submitBtn.className = 'bg-green-500 text-white px-10 py-4 rounded-xl text-base font-bold flex items-center shadow-lg';
                    
                    // Redirect to confirmation page after delay
                    setTimeout(() => {
                        window.location.href = '{{ route("mobile.task.confirmation", [$task->id, $batchId]) }}';
                    }, 1500);
                }, 1000);
            }
        });
    }
    
    // Mobile touch interactions
    document.querySelectorAll('.group').forEach(element => {
        element.addEventListener('touchstart', function() {
            this.classList.add('active');
        });
        
        element.addEventListener('touchend', function() {
            this.classList.remove('active');
        });
    });
    
    // Drag and drop functionality
    const dropArea = document.querySelector('.border-dashed');
    if (dropArea) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            dropArea.classList.add('border-[#FF8A3D]', 'bg-[#FFF5E9]');
        }
        
        function unhighlight(e) {
            dropArea.classList.remove('border-[#FF8A3D]', 'bg-[#FFF5E9]');
        }
        
        dropArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (fileUpload) {
                fileUpload.files = files;
                const event = new Event('change', { bubbles: true });
                fileUpload.dispatchEvent(event);
            }
        }
    }
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
    
    /* Touch-friendly button sizes */
    button {
        min-height: 44px;
        min-width: 44px;
    }
    
    /* Better mobile textarea */
    textarea {
        font-size: 16px; /* Prevents zoom on iOS */
    }
}

/* Active state for mobile touches */
.group.active {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
</style>
@endsection
