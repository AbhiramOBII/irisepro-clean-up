@extends('superadmin.layout')

@section('title', 'Create Achievement')

@section('page-title', 'Create New Achievement')

@section('content')
<div class="mx-auto">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Create New Achievement</h3>
            <a href="{{ route('achievements.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-200">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Achievements
            </a>
        </div>
        <div class="p-6">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('achievements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Achievement Title *</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Enter achievement title"
                               maxlength="150"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Maximum 150 characters</p>
                    </div>

                    <!-- Domain -->
                    <div>
                        <label for="domain" class="block text-sm font-medium text-gray-700 mb-2">Domain *</label>
                        <select id="domain" 
                                name="domain" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                required>
                            <option value="">Select Domain</option>
                            @foreach($domains as $domain)
                                <option value="{{ $domain }}" {{ old('domain') == $domain ? 'selected' : '' }}>
                                    {{ ucfirst($domain) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Threshold -->
                    <div>
                        <label for="threshold" class="block text-sm font-medium text-gray-700 mb-2">Threshold *</label>
                        <input type="number" 
                               id="threshold" 
                               name="threshold" 
                               value="{{ old('threshold') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Enter threshold value"
                               min="1"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Minimum score required to unlock this achievement</p>
                    </div>

                    <!-- Image Upload -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Achievement Image</label>
                        <div class="flex items-center space-x-4">
                            <div class="flex-1">
                                <input type="file" 
                                       id="image" 
                                       name="image" 
                                       accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Supported formats: JPEG, PNG, JPG, GIF, SVG. Max size: 2MB</p>
                            </div>
                            <div id="image-preview" class="hidden">
                                <img id="preview-img" src="" alt="Preview" class="w-20 h-20 object-cover rounded-md border">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Domain Information -->
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                    <h4 class="text-sm font-medium text-blue-900 mb-2">Domain Descriptions:</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-xs text-blue-800">
                        <div><strong>Attitude:</strong> Personal mindset and behavior</div>
                        <div><strong>Aptitude:</strong> Natural ability and talent</div>
                        <div><strong>Communication:</strong> Expression and interaction skills</div>
                        <div><strong>Execution:</strong> Implementation and delivery</div>
                        <div><strong>AACE:</strong> Attitude, Aptitude, Communication, Execution</div>
                        <div><strong>Leadership:</strong> Guidance and management skills</div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('achievements.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-primary hover:bg-primary-dark text-white rounded-md transition duration-200">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create Achievement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
    }
});
</script>
@endsection
