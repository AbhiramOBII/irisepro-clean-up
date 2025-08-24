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
        
        /* Global Mobile Optimizations for screens < 400px */
        @media (max-width: 399px) {
            /* Container adjustments */
            .max-w-md {
                max-width: 100% !important;
                margin: 0 !important;
            }
            
            /* Global padding and margin reductions */
            .p-4 {
                padding: 0.5rem !important;
            }
            
            .p-5 {
                padding: 0.75rem !important;
            }
            
            .p-6 {
                padding: 1rem !important;
            }
            
            .px-4 {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
            }
            
            .py-4 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            
            .m-4 {
                margin: 0.5rem !important;
            }
            
            .mb-4 {
                margin-bottom: 0.5rem !important;
            }
            
            .mb-6 {
                margin-bottom: 1rem !important;
            }
            
            /* Typography adjustments */
            .text-2xl {
                font-size: 1.25rem !important;
                line-height: 1.75rem !important;
            }
            
            .text-xl {
                font-size: 1.125rem !important;
                line-height: 1.5rem !important;
            }
            
            .text-lg {
                font-size: 1rem !important;
                line-height: 1.25rem !important;
            }
            
            .text-base {
                font-size: 0.875rem !important;
                line-height: 1.25rem !important;
            }
            
            .text-sm {
                font-size: 0.75rem !important;
                line-height: 1rem !important;
            }
            
            /* Button and interactive element adjustments */
            .btn, button, .button {
                padding: 0.5rem 0.75rem !important;
                font-size: 0.875rem !important;
            }
            
            /* Card and container adjustments */
            .rounded-xl {
                border-radius: 0.5rem !important;
            }
            
            .rounded-3xl {
                border-radius: 1rem !important;
            }
            
            /* Grid and flex adjustments */
            .gap-4 {
                gap: 0.5rem !important;
            }
            
            .gap-6 {
                gap: 0.75rem !important;
            }
            
            .space-x-4 > * + * {
                margin-left: 0.5rem !important;
            }
            
            .space-y-4 > * + * {
                margin-top: 0.5rem !important;
            }
            
            /* Avatar and image adjustments */
            .w-10 {
                width: 2rem !important;
            }
            
            .h-10 {
                height: 2rem !important;
            }
            
            .w-12 {
                width: 2.5rem !important;
            }
            
            .h-12 {
                height: 2.5rem !important;
            }
            
            .w-16 {
                width: 3rem !important;
            }
            
            .h-16 {
                height: 3rem !important;
            }
            
            .w-20 {
                width: 3.5rem !important;
            }
            
            .h-20 {
                height: 3.5rem !important;
            }
            
            /* Header specific adjustments */
            .header-container {
                padding: 0.5rem !important;
            }
            
            .header-title {
                font-size: 1rem !important;
            }
            
            /* Dashboard specific adjustments */
            .dashboard-card {
                padding: 0.75rem !important;
                margin-bottom: 0.75rem !important;
            }
            
            .dashboard-stat {
                font-size: 1rem !important;
            }
            
            .dashboard-label {
                font-size: 0.75rem !important;
            }
            
            /* Performance chart adjustments */
            .chart-container {
                height: 150px !important;
                padding: 0.5rem !important;
            }
            
            /* Task card adjustments */
            .task-card {
                padding: 0.75rem !important;
                margin-bottom: 0.5rem !important;
            }
            
            .task-title {
                font-size: 0.875rem !important;
                line-height: 1.25rem !important;
            }
            
            .task-description {
                font-size: 0.75rem !important;
                line-height: 1rem !important;
            }
            
            /* Badge and tag adjustments */
            .badge {
                padding: 0.25rem 0.5rem !important;
                font-size: 0.75rem !important;
            }
            
            /* Form element adjustments */
            .form-input, input, textarea, select {
                padding: 0.5rem !important;
                font-size: 0.875rem !important;
            }
            
            /* Modal and popup adjustments */
            .modal-content {
                margin: 0.5rem !important;
                padding: 1rem !important;
            }
            
            /* Navigation adjustments */
            .nav-item {
                padding: 0.5rem !important;
                font-size: 0.75rem !important;
            }
            
            /* Progress bar adjustments */
            .progress-container {
                height: 0.5rem !important;
            }
            
            /* Icon adjustments */
            .icon-sm {
                font-size: 0.875rem !important;
            }
            
            .icon-md {
                font-size: 1rem !important;
            }
            
            .icon-lg {
                font-size: 1.25rem !important;
            }
            
            /* Table adjustments */
            .table-cell {
                padding: 0.5rem 0.25rem !important;
                font-size: 0.75rem !important;
            }
            
            /* Loading and overlay adjustments */
            .loading-spinner {
                width: 1.5rem !important;
                height: 1.5rem !important;
            }
            
            /* Toast notification adjustments */
            .toast {
                padding: 0.5rem 0.75rem !important;
                font-size: 0.875rem !important;
                margin: 0.25rem !important;
            }
            
            /* Footer adjustments */
            .footer-nav {
                padding: 0.5rem !important;
            }
            
            .footer-icon {
                font-size: 1rem !important;
            }
            
            .footer-label {
                font-size: 0.75rem !important;
            }
            
            /* Specific component adjustments */
            .achievement-card {
                padding: 0.5rem !important;
            }
            
            .leaderboard-entry {
                padding: 0.5rem !important;
            }
            
            .performance-metric {
                font-size: 0.875rem !important;
            }
            
            /* Utility classes for ultra-small screens */
            .xs-hidden {
                display: none !important;
            }
            
            .xs-text-xs {
                font-size: 0.625rem !important;
                line-height: 0.875rem !important;
            }
            
            .xs-p-1 {
                padding: 0.25rem !important;
            }
            
            .xs-m-1 {
                margin: 0.25rem !important;
            }
            
            .xs-gap-1 {
                gap: 0.25rem !important;
            }
            
            /* Responsive grid adjustments */
            .grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }
            
            .grid-cols-3 {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }
            
            .grid-cols-4 {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }
            
            /* Flex adjustments */
            .flex-wrap {
                flex-wrap: wrap !important;
            }
            
            .flex-col {
                flex-direction: column !important;
            }
            
            /* Width and height constraints */
            .max-w-xs {
                max-width: 100% !important;
            }
            
            .max-w-sm {
                max-width: 100% !important;
            }
            
            .w-full {
                width: 100% !important;
            }
            
            /* Overflow handling */
            .overflow-x-auto {
                overflow-x: scroll !important;
            }
            
            .text-ellipsis {
                text-overflow: ellipsis !important;
                overflow: hidden !important;
                white-space: nowrap !important;
            }
            
            /* Shadow adjustments */
            .shadow-lg {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
            }
            
            .shadow-xl {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
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
