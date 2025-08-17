<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="light-content">
    <title>iRisePro</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                        'float': 'float 3s ease-in-out infinite alternate',
                        'fadeInUp': 'fadeInUp 1.5s ease-out',
                        'dotPulse': 'dotPulse 1.4s ease-in-out infinite both',
                    },
                    keyframes: {
                        float: {
                            '0%': { transform: 'translateY(0px)' },
                            '100%': { transform: 'translateY(-10px)' }
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        dotPulse: {
                            '0%, 80%, 100%': { transform: 'scale(0.8)', opacity: '0.5' },
                            '40%': { transform: 'scale(1)', opacity: '1' }
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-splash-gradient {
                background: linear-gradient(180deg,rgba(254, 236, 221, 1) 0%, rgba(255, 255, 255, 1) 86%);
            }
            
            .dot-1 { animation-delay: -0.32s; }
            .dot-2 { animation-delay: -0.16s; }
            .dot-3 { animation-delay: 0s; }
        }
    </style>


</head>
<body class="bg-gray-100 font-sans">
    <!-- Mobile container with fixed width to simulate mobile app -->
    <div class="max-w-md mx-auto h-screen bg-splash-gradient shadow-lg overflow-hidden relative">
        <!-- Background decoration circles -->
        <div class="absolute inset-0 opacity-10 z-0">
            <div class="absolute w-44 h-44 bg-white rounded-full top-8 -right-16 animate-pulse-slow"></div>
            <div class="absolute w-32 h-32 bg-white rounded-full bottom-16 -left-10 animate-pulse-slow" style="animation-delay: 2s;"></div>
            <div class="absolute w-20 h-20 bg-white rounded-full top-1/4 left-1/4 animate-pulse-slow" style="animation-delay: 1s;"></div>
        </div>

        <!-- Main splash content -->
        <div class="relative z-10 h-full flex flex-col items-center justify-center px-8 animate-fadeInUp">
            <!-- Logo container -->
            <div class="mb-10">
                <!-- iRisePro Logo -->
                <img src="{{ asset('images/irisepro-logo.png') }}" alt="iRisePro Logo" class="w-48 h-auto mx-auto">
            </div>

            <!-- Main tagline -->
            <div class="text-[22px] font-semibold text-[#F58321] text-center leading-relaxed tracking-wide mb-16 opacity-95">
                Rise As One, Rise For India
            </div>

            <!-- Loading animation -->
            <div class="flex items-center justify-center space-x-2">
                <div class="w-3 h-3 bg-primary rounded-full animate-dotPulse dot-1 shadow-sm"></div>
                <div class="w-3 h-3 bg-primary rounded-full animate-dotPulse dot-2 shadow-sm"></div>
                <div class="w-3 h-3 bg-primary rounded-full animate-dotPulse dot-3 shadow-sm"></div>
            </div>
        </div>
    </div>

    <script>
        // Auto-redirect after splash screen (optional)
        setTimeout(() => {
            // Redirect to login page after 3 seconds
            window.location.href = '{{ route("mobile.login") }}';
        }, 3000);

        // Add touch interaction for mobile
        document.addEventListener('touchstart', function() {
            // Allow users to tap to skip splash screen
            window.location.href = '{{ route("mobile.login") }}';
        });
    </script>
</body>
</html>
