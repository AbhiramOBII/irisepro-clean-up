<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'iRisePro')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Swiper.js for carousel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#FF8A3D',
                        'primary-dark': '#E67E35',
                        'primary-light': '#FFB380',
                        'secondary': '#FFF1E6',
                        'accent': '#FFC107',
                        'accent-dark': '#FFA000',
                        'success': '#4CAF50',
                        'info': '#2196F3',
                        'card-bg': '#FFFFFF',
                    },
                    fontFamily: {
                        'sans': ['Montserrat', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
                        'button': '0 2px 4px rgba(255, 138, 61, 0.3)',
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style type="text/tailwindcss">
        @layer utilities {
            .progress-bar {
                background: linear-gradient(to right, #FF8A3D var(--progress), #FFF1E6 var(--progress));
            }
            .hide-scrollbar {
                -ms-overflow-style: none;  /* Internet Explorer 10+ */
                scrollbar-width: none;  /* Firefox */
            }
            .hide-scrollbar::-webkit-scrollbar { 
                display: none;  /* Safari and Chrome */
            }
        }
    </style>
    
    <!-- Additional head content -->
    @stack('head')
</head>
<body class="bg-gradient-to-br from-secondary to-white p-4 rounded-b-3xl shadow-sm font-sans">
    <!-- Mobile container with fixed width to simulate mobile app -->
    <div class="max-w-md mx-auto h-screen bg-white shadow-lg overflow-y-auto hide-scrollbar relative">
        
        <!-- Header -->
        @if(!isset($hideHeader) || !$hideHeader)
            @include('frontendapp.partials.header')
        @endif
        
        <!-- Main Content -->
        <main class="@if(!isset($hideHeader) || !$hideHeader) pt-0 @endif @if(!isset($hideFooter) || !$hideFooter) pb-20 @endif bg-gradient-to-b from-white to-[#EFCAA6]">
            @yield('content')
        </main>
        
        <!-- Footer -->
        @if(!isset($hideFooter) || !$hideFooter)
            @include('frontendapp.partials.footer')
        @endif
        
        <!-- Loading Overlay -->
        <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg p-6 flex flex-col items-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mb-3"></div>
                <p class="text-gray-600">Loading...</p>
            </div>
        </div>
        
        <!-- Toast Notifications -->
        <div id="toastContainer" class="fixed top-4 right-4 z-50 space-y-2"></div>
    </div>
    
    <!-- Scripts -->
    @stack('scripts')
    
    <!-- Global JavaScript -->
    <script>
        // Global utilities
        function showLoading() {
            document.getElementById('loadingOverlay').classList.remove('hidden');
        }
        
        function hideLoading() {
            document.getElementById('loadingOverlay').classList.add('hidden');
        }
        
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
            
            toast.className = `${bgColor} text-white px-4 py-2 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full`;
            toast.textContent = message;
            
            document.getElementById('toastContainer').appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }
        
        // Header dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const userAvatar = document.getElementById('userAvatar');
            const userDropdown = document.getElementById('userDropdown');
            
            if (userAvatar && userDropdown) {
                // Toggle dropdown on avatar click
                userAvatar.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!userDropdown.contains(e.target) && !userAvatar.contains(e.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
                
                // Prevent dropdown from closing when clicking inside it
                userDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });
    </script>
</body>
</html>
