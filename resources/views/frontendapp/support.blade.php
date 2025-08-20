@extends('frontendapp.partials.app')

@section('title', 'Support')

@section('content')
<div class="px-4 py-6 mb-24">
    <!-- Support Form Card -->
    <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-xl p-6 mb-5 shadow-md relative overflow-hidden transition-all duration-300 hover:shadow-lg">
        <h2 class="text-lg font-bold text-gray-800 mb-5 flex items-center">
            <i class="fas fa-headset text-[#FF8A3D] mr-2"></i>
            How can we help you?
        </h2>
        
        <form id="supportForm" action="{{ route('mobile.support.submit') }}" method="POST">
            @csrf
            <!-- Issue Type Dropdown -->
            <div class="mb-5">
                <label for="issue-type" class="block text-sm font-medium text-gray-700 mb-2">
                    Issue Type<span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select id="issue-type" name="issue_type" required class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-[#FF8A3D]/50 focus:border-[#FF8A3D]">
                        <option value="" disabled selected>Select an issue type</option>
                        <option value="technical_issue">Technical Issue</option>
                        <option value="content_issue">Content Issue</option>
                        <option value="evaluator_issue">Evaluator Issue</option>
                        <option value="other">Other</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
                @error('issue_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Description Text Area -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description<span class="text-red-500">*</span>
                </label>
                <textarea id="description" name="description" rows="6" maxlength="500" required placeholder="Please describe your issue in detail..." class="block w-full px-4 py-3 bg-white border border-gray-200 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-[#FF8A3D]/50 focus:border-[#FF8A3D]"></textarea>
                <div class="flex justify-end mt-1">
                    <span id="charCount" class="text-xs text-gray-500">0/500</span>
                </div>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Submit Button -->
            <button type="submit" id="submitBtn" class="bg-gradient-to-r from-[#FF8A3D] to-[#F9A949] text-white px-6 py-3 rounded-xl text-base font-bold hover:opacity-90 transition-all duration-200 flex items-center justify-center w-full shadow-md">
                Submit Request
                <i class="fas fa-paper-plane ml-2"></i>
            </button>
        </form>
    </div>
    
    <!-- Contact Info Card -->
    <div class="bg-[#FFF9F5] rounded-xl p-5 shadow-sm">
        <h3 class="text-sm font-semibold text-gray-700 mb-3">Need immediate help?</h3>
        <div class="flex items-center mb-3">
            <div class="w-8 h-8 bg-[#FF8A3D]/10 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-envelope text-[#FF8A3D]"></i>
            </div>
            <div>
                <div class="text-xs text-gray-500">Email us at</div>
                <a href="mailto:contact@irisepro.in" class="text-sm font-medium text-[#FF8A3D]">contact@irisepro.in</a>
            </div>
        </div>
        <div class="flex items-center">
            <div class="w-8 h-8 bg-[#FF8A3D]/10 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-phone text-[#FF8A3D]"></i>
            </div>
            <div>
                <div class="text-xs text-gray-500">Call us at</div>
                <a href="tel:+918660256342" class="text-sm font-medium text-[#FF8A3D]">+91 8660256342</a>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl p-6 max-w-sm w-full mx-4">
        <div class="text-center mb-4">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-check text-green-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800">Request Submitted!</h3>
        </div>
        <p class="text-sm text-gray-600 text-center mb-6">
            Your support request has been submitted successfully. Our team will get back to you within 24 hours.
        </p>
        <button onclick="closeSuccessModal()" class="w-full bg-gradient-to-r from-[#FF8A3D] to-[#F9A949] text-white py-2.5 rounded-lg font-semibold">
            Got it!
        </button>
    </div>
</div>

@push('scripts')
<script>
// Character counter
const descriptionTextarea = document.getElementById('description');
const charCount = document.getElementById('charCount');

descriptionTextarea.addEventListener('input', function() {
    const currentLength = this.value.length;
    charCount.textContent = `${currentLength}/500`;
    
    if (currentLength > 450) {
        charCount.classList.add('text-red-500');
        charCount.classList.remove('text-gray-500');
    } else {
        charCount.classList.add('text-gray-500');
        charCount.classList.remove('text-red-500');
    }
});

// Form submission
document.getElementById('supportForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Submitting...';
    submitBtn.disabled = true;
    
    // Get form data
    const formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reset form
            this.reset();
            charCount.textContent = '0/500';
            
            // Show success modal
            showSuccessModal();
        } else {
            alert('There was an error submitting your request. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was an error submitting your request. Please try again.');
    })
    .finally(() => {
        // Reset button
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

// Success modal functions
function showSuccessModal() {
    document.getElementById('successModal').classList.remove('hidden');
}

function closeSuccessModal() {
    document.getElementById('successModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('successModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSuccessModal();
    }
});
</script>
@endpush
@endsection
