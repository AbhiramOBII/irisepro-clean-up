// Enrollment Modal Management
class EnrollmentManager {
    constructor() {
        this.modal = document.getElementById('enrollment-modal');
        this.modalContent = document.getElementById('enrollment-modal-content');
        this.form = document.getElementById('enrollment-form');
        this.submitBtn = document.getElementById('enrollment-submit-btn');
        this.loadingSpinner = document.getElementById('loading-spinner');
        this.submitText = document.getElementById('submit-text');
        
        this.initializeEventListeners();
    }
    
    initializeEventListeners() {
        // Close modal events
        document.getElementById('close-enrollment-modal').addEventListener('click', () => {
            this.closeModal();
        });
        
        // Close modal when clicking outside
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) {
                this.closeModal();
            }
        });
        
        // Form submission
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.handleFormSubmission();
        });
        
        // Enroll Now button clicks
        document.addEventListener('click', (e) => {
            if (e.target.closest('[data-challenge-id]')) {
                e.preventDefault();
                const button = e.target.closest('[data-challenge-id]');
                const challengeId = button.getAttribute('data-challenge-id');
                const challengeTitle = button.getAttribute('data-challenge-title');
                this.openModal(challengeId, challengeTitle);
            }
        });
        
        // Phone number formatting
        document.getElementById('enroll-phone').addEventListener('input', (e) => {
            this.formatPhoneNumber(e.target);
        });
    }
    
    async openModal(challengeId, challengeTitle) {
        try {
            // Show modal with loading state
            this.modal.classList.remove('hidden');
            setTimeout(() => {
                this.modal.classList.remove('opacity-0');
                this.modalContent.classList.remove('opacity-0', 'scale-95');
            }, 10);
            
            // Fetch challenge details
            const response = await fetch(`/api/challenges/${challengeId}/details`);
            const challengeData = await response.json();
            
            if (challengeData.success) {
                this.populateModalData(challengeData.data);
            } else {
                this.showError('Failed to load challenge details');
            }
            
        } catch (error) {
            console.error('Error opening modal:', error);
            this.showError('Failed to load challenge details');
        }
    }
    
    populateModalData(data) {
        // Update modal content
        document.getElementById('modal-challenge-title').textContent = data.title;
        document.getElementById('modal-start-date').textContent = data.start_date;
        document.getElementById('modal-task-count').textContent = data.number_of_tasks;
        document.getElementById('modal-price').innerHTML = data.price_display;
        document.getElementById('modal-description').textContent = data.description;
        
        // Set hidden form fields
        document.getElementById('challenge-id').value = data.id;
        document.getElementById('batch-id').value = data.batch_id;
        
        // Reset form
        this.resetForm();
    }
    
    closeModal() {
        this.modalContent.classList.add('opacity-0', 'scale-95');
        this.modal.classList.add('opacity-0');
        
        setTimeout(() => {
            this.modal.classList.add('hidden');
            this.resetForm();
        }, 300);
    }
    
    async handleFormSubmission() {
        const formData = new FormData(this.form);
        
        // Show loading state
        this.setLoadingState(true);
        this.hideMessages();
        
        try {
            const response = await fetch('/api/enrollment/submit', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            const result = await response.json();
            
            if (result.success) {
                this.showSuccess();
                // Auto-close modal after 3 seconds
                setTimeout(() => {
                    this.closeModal();
                }, 3000);
            } else {
                this.showError(result.message || 'Enrollment failed. Please try again.');
            }
            
        } catch (error) {
            console.error('Enrollment error:', error);
            this.showError('Network error. Please check your connection and try again.');
        } finally {
            this.setLoadingState(false);
        }
    }
    
    setLoadingState(loading) {
        if (loading) {
            this.submitBtn.disabled = true;
            this.loadingSpinner.classList.remove('hidden');
            this.submitText.textContent = 'Processing...';
        } else {
            this.submitBtn.disabled = false;
            this.loadingSpinner.classList.add('hidden');
            this.submitText.textContent = 'Complete Enrollment';
        }
    }
    
    showSuccess() {
        document.getElementById('enrollment-success').classList.remove('hidden');
        document.getElementById('enrollment-error').classList.add('hidden');
    }
    
    showError(message) {
        document.getElementById('error-message').textContent = message;
        document.getElementById('enrollment-error').classList.remove('hidden');
        document.getElementById('enrollment-success').classList.add('hidden');
    }
    
    hideMessages() {
        document.getElementById('enrollment-success').classList.add('hidden');
        document.getElementById('enrollment-error').classList.add('hidden');
    }
    
    resetForm() {
        this.form.reset();
        this.hideMessages();
        this.setLoadingState(false);
    }
    
    formatPhoneNumber(input) {
        let value = input.value.replace(/\D/g, '');
        
        if (value.length > 0) {
            if (value.startsWith('91')) {
                value = '+91 ' + value.substring(2);
            } else if (!value.startsWith('+91')) {
                value = '+91 ' + value;
            }
        }
        
        input.value = value;
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new EnrollmentManager();
});
