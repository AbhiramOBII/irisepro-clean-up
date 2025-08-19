<!-- Bottom Navigation -->
<div class="fixed bottom-0 left-1/2 transform -translate-x-1/2 w-full max-w-md bg-white border-t border-gray-200 px-6 py-3 z-50 rounded-t-[10px]">
    <div class="flex justify-around items-center">
        <!-- Performance -->
        <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-200 @if(isset($activeMenu) && $activeMenu == 'performance') bg-primary text-white shadow-button @else text-gray-400 hover:text-primary hover:bg-gray-50 @endif">
            <i class="fas fa-chart-line text-xl"></i>
        </a>
        
        <!-- Leaderboard -->
        <a href="{{route('mobile.leaderboard')}}" class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-200 @if(isset($activeMenu) && $activeMenu == 'leaderboard') bg-primary text-white shadow-button @else text-gray-400 hover:text-primary hover:bg-gray-50 @endif">
            <i class="fas fa-trophy text-xl"></i>
        </a>
        
        <!-- Dashboard (Home) -->
        <a href="{{route('mobile.dashboard')}}" class="w-14 h-14 flex items-center justify-center rounded-full transition-all duration-200 @if(isset($activeMenu) && $activeMenu == 'mobile.dashboard') bg-primary text-white shadow-button @else text-gray-400 hover:text-primary hover:bg-gray-50 @endif relative">
            <i class="fas fa-home text-2xl"></i>
            @if(isset($activeMenu) && $activeMenu == 'mobile.dashboard')
                <div class="absolute -top-1 -right-1 w-3 h-3 bg-white rounded-full border-2 border-primary"></div>
            @endif
        </a>
        
        <!-- Tasks -->
        <a href="@if(isset($studentStatus['current_task']) && $studentStatus['current_task']['task'] && isset($studentStatus['current_task']['batch_id'])) {{ route('mobile.task.details', [$studentStatus['current_task']['batch_id'], $studentStatus['current_task']['task']['id']]) }} @else # @endif" class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-200 @if(isset($activeMenu) && $activeMenu == 'tasks') bg-primary text-white shadow-button @else text-gray-400 hover:text-primary hover:bg-gray-50 @endif">
            <i class="fas fa-tasks text-xl"></i>
        </a>
        
        <!-- Achievements -->
        <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-200 @if(isset($activeMenu) && $activeMenu == 'achievements') bg-primary text-white shadow-button @else text-gray-400 hover:text-primary hover:bg-gray-50 @endif">
            <i class="fas fa-medal text-xl"></i>
        </a>
    </div>
</div>

<script>
// IndexedDB helper functions
class TimerDB {
    constructor() {
        this.dbName = 'TimerDB';
        this.version = 1;
        this.storeName = 'timers';
    }

    async init() {
        return new Promise((resolve, reject) => {
            const request = indexedDB.open(this.dbName, this.version);
            
            request.onerror = () => reject(request.error);
            request.onsuccess = () => resolve(request.result);
            
            request.onupgradeneeded = (event) => {
                const db = event.target.result;
                if (!db.objectStoreNames.contains(this.storeName)) {
                    db.createObjectStore(this.storeName, { keyPath: 'id' });
                }
            };
        });
    }

    async set(id, value) {
        const db = await this.init();
        const transaction = db.transaction([this.storeName], 'readwrite');
        const store = transaction.objectStore(this.storeName);
        return store.put({ id, value });
    }

    async get(id) {
        const db = await this.init();
        const transaction = db.transaction([this.storeName], 'readonly');
        const store = transaction.objectStore(this.storeName);
        return new Promise((resolve, reject) => {
            const request = store.get(id);
            request.onsuccess = () => resolve(request.result?.value);
            request.onerror = () => reject(request.error);
        });
    }
}

// Timer functionality
class CountdownTimer {
    constructor() {
        this.db = new TimerDB();
        this.timerInterval = null;
        this.init();
    }

    async init() {
        // Check if timer is already running
        const startedAt = await this.db.get('started_at');
        if (startedAt) {
            this.startCountdown(new Date(startedAt));
        }
        
        // Add event listener for start button
        this.addStartButtonListener();
    }

    addStartButtonListener() {
        // Look for start button - adjust selector as needed
        const startButton = document.querySelector('[data-action="start-timer"]') || 
                           document.querySelector('.start-now-btn') ||
                           document.querySelector('button:contains("Start Now")');
        
        if (startButton) {
            startButton.addEventListener('click', () => this.startTimer());
        }

        // Also add global event listener for any element with data-action="start-timer"
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-action="start-timer"]') || 
                e.target.closest('[data-action="start-timer"]')) {
                e.preventDefault();
                this.startTimer();
            }
        });
    }

    async startTimer() {
        const now = new Date();
        await this.db.set('started_at', now.toISOString());
        this.startCountdown(now);
    }

    startCountdown(startTime) {
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
        }

        this.timerInterval = setInterval(() => {
            const now = new Date();
            const elapsed = now - startTime;
            const remaining = (24 * 60 * 60 * 1000) - elapsed; // 24 hours in milliseconds

            if (remaining <= 0) {
                this.stopTimer();
                return;
            }

            this.updateDisplay(remaining);
        }, 1000);

        // Initial update
        const now = new Date();
        const elapsed = now - startTime;
        const remaining = (24 * 60 * 60 * 1000) - elapsed;
        this.updateDisplay(remaining);
    }

    updateDisplay(remainingMs) {
        const hours = Math.floor(remainingMs / (1000 * 60 * 60));
        const minutes = Math.floor((remainingMs % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((remainingMs % (1000 * 60)) / 1000);

        const timeString = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        // Update timer display elements
        const timerElements = document.querySelectorAll('.countdown-timer, [data-timer="countdown"]');
        timerElements.forEach(element => {
            if (element.querySelector('.timer-display')) {
                element.querySelector('.timer-display').textContent = timeString;
            } else {
                element.textContent = timeString;
            }
        });

        // Update the specific timer in dashboard if it exists
        const dashboardTimer = document.querySelector('.text-lg.font-bold.text-gray-800');
        if (dashboardTimer && dashboardTimer.textContent.match(/\d{2}:\d{2}:\d{2}/)) {
            dashboardTimer.textContent = timeString;
        }
    }

    async stopTimer() {
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
            this.timerInterval = null;
        }
        
        // Remove started_at from IndexedDB
        const db = await this.db.init();
        const transaction = db.transaction([this.db.storeName], 'readwrite');
        const store = transaction.objectStore(this.db.storeName);
        store.delete('started_at');
        
        // Update display to show timer ended
        this.updateDisplay(0);
    }

    async getStartedAt() {
        return await this.db.get('started_at');
    }

    async getRemainingTime() {
        const startedAt = await this.getStartedAt();
        if (!startedAt) return null;
        
        const now = new Date();
        const startTime = new Date(startedAt);
        const elapsed = now - startTime;
        const remaining = (24 * 60 * 60 * 1000) - elapsed;
        
        return remaining > 0 ? remaining : 0;
    }
}

// Initialize timer when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.countdownTimer = new CountdownTimer();
});

// Global helper functions
window.startTimer = function() {
    if (window.countdownTimer) {
        window.countdownTimer.startTimer();
    }
};

window.getTimerData = async function() {
    if (window.countdownTimer) {
        const startedAt = await window.countdownTimer.getStartedAt();
        const remaining = await window.countdownTimer.getRemainingTime();
        return { startedAt, remaining };
    }
    return null;
};

// Habit Modal functionality
class HabitModal {
    constructor() {
        this.modal = document.getElementById('photoUploadModal');
        this.closeBtn = document.getElementById('closeModal');
        this.cancelBtn = document.getElementById('cancelUpload');
        this.submitBtn = document.getElementById('submitUpload');
        this.fileInput = document.getElementById('fileInput');
        this.dropArea = document.getElementById('dropArea');
        this.uploadPlaceholder = document.getElementById('uploadPlaceholder');
        this.previewContainer = document.getElementById('previewContainer');
        this.imagePreview = document.getElementById('imagePreview');
        this.habitName = document.getElementById('habitName');
        this.habitIdInput = document.getElementById('habitIdInput');
        
        this.init();
    }

    init() {
        if (!this.modal) return;

        // Close modal events
        this.closeBtn?.addEventListener('click', () => this.closeModal());
        this.cancelBtn?.addEventListener('click', () => this.closeModal());
        
        // Click outside to close
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) this.closeModal();
        });

        // File input events
        this.fileInput?.addEventListener('change', (e) => this.handleFileSelect(e));
        this.dropArea?.addEventListener('click', () => this.fileInput?.click());
        
        // Drag and drop events
        this.dropArea?.addEventListener('dragover', (e) => this.handleDragOver(e));
        this.dropArea?.addEventListener('drop', (e) => this.handleDrop(e));

        // Habit checkbox events
        this.setupHabitCheckboxes();
    }

    setupHabitCheckboxes() {
        document.addEventListener('click', (e) => {
            const checkbox = e.target.closest('.habit-checkbox');
            if (checkbox) {
                e.preventDefault();
                
                // Check if habit is already completed or disabled
                if (checkbox.disabled || checkbox.checked) {
                    return; // Don't open modal for completed habits
                }
                
                const habitItem = checkbox.closest('.habit-item');
                const habitId = checkbox.id.replace('habit-', '');
                const habitTitle = habitItem.querySelector('span').textContent;
                
                this.openModal(habitId, habitTitle);
            }
        });
    }

    openModal(habitId, habitTitle) {
        this.habitName.textContent = habitTitle;
        this.habitIdInput.value = habitId;
        this.resetModal();
        this.modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    closeModal() {
        this.modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        this.resetModal();
    }

    resetModal() {
        this.fileInput.value = '';
        this.uploadPlaceholder.classList.remove('hidden');
        this.previewContainer.classList.add('hidden');
        this.submitBtn.disabled = true;
    }

    handleFileSelect(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            this.showPreview(file);
        }
    }

    handleDragOver(e) {
        e.preventDefault();
        this.dropArea.classList.add('border-[#F58321]');
    }

    handleDrop(e) {
        e.preventDefault();
        this.dropArea.classList.remove('border-[#F58321]');
        
        const files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            this.fileInput.files = files;
            this.showPreview(files[0]);
        }
    }

    showPreview(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            this.imagePreview.src = e.target.result;
            this.uploadPlaceholder.classList.add('hidden');
            this.previewContainer.classList.remove('hidden');
            this.submitBtn.disabled = false;
        };
        reader.readAsDataURL(file);
    }
}

// Initialize habit modal when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.habitModal = new HabitModal();
});
</script>
