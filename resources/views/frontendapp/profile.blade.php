@extends('frontendapp.partials.app')

@section('title', 'Student Profile')

@section('content')
<!-- Main Content -->
<div class="px-4 mb-24">
    <!-- User Profile Card -->
    <div class="bg-gradient-to-br from-[#FFF9F5] to-[#FFF1E6] rounded-xl p-6 mb-5 shadow-md relative overflow-hidden transition-all duration-300 hover:shadow-lg">
        <!-- Decorative circle elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF8A3D]/5 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#FF8A3D]/5 rounded-full -ml-12 -mb-12"></div>
        
        <div class="relative z-10">
            <!-- Profile Header with Display Picture -->
            <div class="flex flex-col items-center mb-6">
                <div class="relative mb-3">
                    <div class="w-28 h-28 rounded-full bg-[#FFF5E9] border-4 border-white shadow-md overflow-hidden">
                        <!-- Display Picture -->
                        @if($student->profile_picture)
                            <img src="{{ asset('storage/profile_pictures/' . $student->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#FF8A3D] to-[#F9A949] text-white text-2xl font-bold">
                                {{ strtoupper(substr($student->full_name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <!-- Upload Button -->
                    <label for="profile-upload" class="absolute bottom-0 right-0 w-8 h-8 bg-[#FF8A3D] rounded-full flex items-center justify-center cursor-pointer shadow-md border-2 border-white">
                        <i class="fas fa-camera text-white text-sm"></i>
                        <input type="file" id="profile-upload" class="hidden" accept="image/*" onchange="uploadProfilePicture(this)">
                    </label>
                </div>
                <h2 class="text-xl font-bold text-gray-800">{{ $student->full_name }}</h2>
                <div class="text-sm text-gray-600 mb-1">{{ $student->partner_institution ?? 'Student' }}</div>
                <div class="bg-[#FF8A3D]/10 text-[#FF8A3D] text-xs font-medium px-3 py-1 rounded-full">
                    {{ $student->B2C ? 'B2C Student' : 'Student' }}
                </div>
            </div>
            
            <!-- Profile Information -->
            <div class="bg-white rounded-xl p-4 shadow-sm mb-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                    <i class="fas fa-user-circle text-[#FF8A3D] mr-2"></i>
                    Personal Information
                </h3>
                
                <div class="space-y-0">
                    <!-- School Name -->
                    <div class="py-3 border-b border-gray-100">
                        <div class="flex justify-between items-center leading-relaxed">
                            <div class="text-sm text-gray-500">School/Institution</div>
                            <div class="text-sm font-medium text-gray-800">{{ $student->partner_institution ?? 'Not specified' }}</div>
                        </div>
                    </div>
                    
                    <!-- Status -->
                    <div class="py-3 border-b border-gray-100">
                        <div class="flex justify-between items-center leading-relaxed">
                            <div class="text-sm text-gray-500">Status</div>
                            <div class="text-sm font-medium text-gray-800">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $student->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Email ID -->
                    <div class="py-3 border-b border-gray-100">
                        <div class="flex justify-between items-center leading-relaxed">
                            <div class="text-sm text-gray-500">Email</div>
                            <div class="text-sm font-medium text-gray-800">{{ $student->email }}</div>
                        </div>
                    </div>
                    
                    <!-- Phone Number -->
                    <div class="py-3 border-b border-gray-100">
                        <div class="flex justify-between items-center leading-relaxed">
                            <div class="text-sm text-gray-500">Phone</div>
                            <div class="text-sm font-medium text-gray-800">{{ $student->phone_number ?? 'Not provided' }}</div>
                        </div>
                    </div>
                    
                    <!-- Date of Birth -->
                    <div class="py-3 border-b border-gray-100">
                        <div class="flex justify-between items-center leading-relaxed">
                            <div class="text-sm text-gray-500">Date of Birth</div>
                            <div class="text-sm font-medium text-gray-800">
                                {{ $student->date_of_birth ? $student->date_of_birth->format('d F Y') : 'Not provided' }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Gender -->
                    <div class="py-3 border-b border-gray-100">
                        <div class="flex justify-between items-center leading-relaxed">
                            <div class="text-sm text-gray-500">Gender</div>
                            <div class="text-sm font-medium text-gray-800">{{ ucfirst($student->gender ?? 'Not specified') }}</div>
                        </div>
                    </div>
                    
                    <!-- Date of Joining -->
                    <div class="py-3">
                        <div class="flex justify-between items-center leading-relaxed">
                            <div class="text-sm text-gray-500">Joined iRisePro</div>
                            <div class="text-sm font-medium text-gray-800">{{ $student->created_at->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Support and About Buttons -->
            <div class="space-y-3">
                <!-- Request Support Button -->
                <a href="{{ route('mobile.support') }}" class="bg-gradient-to-r from-[#FF8A3D] to-[#F9A949] text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:opacity-90 transition-all duration-200 flex items-center justify-center w-full shadow-sm no-underline">
                    <i class="fas fa-headset mr-2"></i>
                    Request Support
                </a>
                
                <!-- About iRisePro Button -->
                <button onclick="showAboutModal()" class="bg-white border border-[#FF8A3D] text-[#FF8A3D] px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-[#FFF5E9] transition-all duration-200 flex items-center justify-center w-full shadow-sm">
                    <i class="fas fa-info-circle mr-2"></i>
                    About iRisePro™
                </button>
            </div>
        </div>
    </div>
</div>

<!-- About Modal -->
<div id="aboutModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl p-6 max-w-sm w-full mx-4">
        <div class="text-center mb-4">
            <div class="w-16 h-16 bg-gradient-to-r from-[#FF8A3D] to-[#F9A949] rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-graduation-cap text-white text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800">About iRisePro™</h3>
        </div>
        <p class="text-sm text-gray-600 text-center mb-6">
            iRisePro is a comprehensive learning platform designed to help students develop essential life skills, build positive habits, and achieve their academic and personal goals through structured challenges and personalized guidance.
        </p>
        <button onclick="closeAboutModal()" class="w-full bg-gradient-to-r from-[#FF8A3D] to-[#F9A949] text-white py-2.5 rounded-lg font-semibold">
            Got it!
        </button>
    </div>
</div>

@push('scripts')
<script>
// Profile picture upload
function uploadProfilePicture(input) {
    if (input.files && input.files[0]) {
        const formData = new FormData();
        formData.append('profile_picture', input.files[0]);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT');
        
        // Show loading state
        const uploadBtn = input.parentElement;
        uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin text-white text-sm"></i>';
        
        fetch('{{ route("mobile.profile.update") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reload page to show new profile picture
                window.location.reload();
            } else {
                alert('Failed to upload profile picture. Please try again.');
                uploadBtn.innerHTML = '<i class="fas fa-camera text-white text-sm"></i>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            uploadBtn.innerHTML = '<i class="fas fa-camera text-white text-sm"></i>';
        });
    }
}

// Request support function
function requestSupport() {
    // You can implement this to open a support form or redirect to support page
    alert('Support request feature will be implemented soon!');
}

// About modal functions
function showAboutModal() {
    document.getElementById('aboutModal').classList.remove('hidden');
}

function closeAboutModal() {
    document.getElementById('aboutModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('aboutModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAboutModal();
    }
});
</script>
@endpush
@endsection
