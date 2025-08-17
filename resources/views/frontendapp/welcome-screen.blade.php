<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="light-content">
    <title>Welcome - iRisePro</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        'fadeIn': 'fadeIn 0.8s ease-out forwards',
                        'slideUp': 'slideUp 0.8s ease-out forwards',
                        'slideDown': 'slideDown 0.8s ease-out forwards',
                        'scaleIn': 'scaleIn 0.6s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '100%': { opacity: '1', transform: 'scale(1)' }
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-welcome-gradient {
                background: linear-gradient(135deg, #FF8A3D 0%, #FFA366 50%, #FFB380 100%);
            }
            
            .text-shadow {
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans overflow-hidden">
    <!-- Mobile container with fixed width to simulate mobile app -->
    <div class="max-w-md mx-auto h-screen bg-welcome-gradient shadow-lg overflow-hidden relative">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Decorative circles -->
            <div class="absolute -top-20 -right-20 w-40 h-40 bg-white opacity-10 rounded-full"></div>
            <div class="absolute top-1/3 -left-16 w-32 h-32 bg-white opacity-5 rounded-full"></div>
            <div class="absolute bottom-20 right-8 w-24 h-24 bg-white opacity-10 rounded-full"></div>
            
            <!-- Decorative pattern -->
            <div class="absolute bottom-0 right-0 w-32 h-32 opacity-10">
                <svg viewBox="0 0 100 100" class="w-full h-full fill-white">
                    <circle cx="20" cy="20" r="2"/>
                    <circle cx="40" cy="20" r="2"/>
                    <circle cx="60" cy="20" r="2"/>
                    <circle cx="80" cy="20" r="2"/>
                    <circle cx="20" cy="40" r="2"/>
                    <circle cx="40" cy="40" r="2"/>
                    <circle cx="60" cy="40" r="2"/>
                    <circle cx="80" cy="40" r="2"/>
                    <circle cx="20" cy="60" r="2"/>
                    <circle cx="40" cy="60" r="2"/>
                    <circle cx="60" cy="60" r="2"/>
                    <circle cx="80" cy="60" r="2"/>
                    <circle cx="20" cy="80" r="2"/>
                    <circle cx="40" cy="80" r="2"/>
                    <circle cx="60" cy="80" r="2"/>
                    <circle cx="80" cy="80" r="2"/>
                </svg>
            </div>
        </div>

        <!-- Main content -->
        <div class="relative z-10 h-full flex flex-col justify-between p-8 pt-16">
            <!-- Logo section -->
            <div class="text-center" id="logoSection">
                <div class="mb-8">
                    <img src="{{ asset('images/irisepro-logo.png') }}" alt="iRisePro Logo" class="w-48 h-auto mx-auto">
                </div>
            </div>

            <!-- Welcome message on gradient -->
            <div class="flex-1 flex flex-col justify-center">
                <div class="mb-8" id="welcomeMessage">
                    <h2 class="text-black text-lg font-medium mb-2 text-shadow">Welcome,</h2>
                    <h1 class="text-black text-4xl font-bold text-shadow" id="userName">{{ $student->full_name ?? 'Student' }}</h1>
                </div>
            </div>
        </div>

        <!-- White curved bottom section -->
        <div class="absolute z-50 bottom-0 left-0 right-0 bg-white rounded-t-3xl px-8 py-8" id="bottomSection">
            <!-- Mission statement -->
            <div class="mb-8">
                <p class="text-gray-800 text-base leading-relaxed mb-4">
                    At iRISEPro, we believe in awakening the dormant potential within every individual.
                </p>
                <p class="text-gray-800 text-base leading-relaxed">
                    We recognize the profound inadequacies hindering the youth of India from flourishing and growing.
                </p>
            </div>

            <!-- CTA Button -->
            <div id="enterButton">
                <button 
                    id="enterBtn"
                    class="w-full bg-primary text-white font-semibold py-4 px-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 active:scale-95"
                >
                    <div class="text-lg font-bold mb-1">{{ $student->full_name ?? 'Student' }}</div>
                    <div class="text-sm opacity-90">Enter the world of intuitive learning</div>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Set up CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Button click handler
        document.getElementById('enterBtn').addEventListener('click', function() {
            // Add click animation
            this.classList.add('animate-pulse');
            
            // Show loading state
            const originalHTML = this.innerHTML;
            this.innerHTML = '<div class="text-lg font-bold">Entering...</div>';
            this.disabled = true;
            
            // Mark welcome as seen and redirect
            fetch('{{ route("mobile.mark-welcome-seen") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to dashboard
                    window.location.href = '{{ route("mobile.dashboard") }}';
                } else {
                    // Reset button on error
                    this.innerHTML = originalHTML;
                    this.disabled = false;
                    this.classList.remove('animate-pulse');
                    alert('An error occurred. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Reset button on error
                this.innerHTML = originalHTML;
                this.disabled = false;
                this.classList.remove('animate-pulse');
                alert('An error occurred. Please try again.');
            });
        });

        // Add touch feedback for mobile
        document.getElementById('enterBtn').addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });

        document.getElementById('enterBtn').addEventListener('touchend', function() {
            this.style.transform = 'scale(1)';
        });

        // Clean animations without flickering
        document.addEventListener('DOMContentLoaded', function() {
            // Apply animations directly with CSS classes
            document.getElementById('logoSection').classList.add('animate-fadeIn');
            
            setTimeout(() => {
                document.getElementById('welcomeMessage').classList.add('animate-slideDown');
            }, 300);
            
            setTimeout(() => {
                document.getElementById('bottomSection').classList.add('animate-slideUp');
            }, 600);
            
            setTimeout(() => {
                document.getElementById('enterButton').classList.add('animate-scaleIn');
            }, 900);
        });
    </script>
</body>
</html>
