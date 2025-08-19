<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="light-content">
    <title>Login - iRisePro</title>
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
                        'fadeInUp': 'fadeInUp 0.8s ease-out',
                        'slideInLeft': 'slideInLeft 0.6s ease-out',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideInLeft: {
                            '0%': { opacity: '0', transform: 'translateX(-20px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-login-gradient {
                background: linear-gradient(180deg, rgba(254, 236, 221, 0.3) 0%, rgba(255, 255, 255, 1) 50%);
            }
            
            .input-focus:focus {
                border-color: #FF8A3D;
                box-shadow: 0 0 0 3px rgba(255, 138, 61, 0.1);
            }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Mobile container with fixed width to simulate mobile app -->
    <div class="max-w-md mx-auto h-screen bg-login-gradient shadow-lg overflow-hidden relative">
        <!-- Background decoration -->
        <div class="absolute top-0 left-0 w-full h-1/2 opacity-20">
            <!-- Background figure/silhouette -->
            <div class="absolute top-8 left-4 w-auto h-64 opacity-30">
                <img src="{{ asset('images/icon.png') }}" alt="Background Icon" class="w-full h-full object-contain">
            </div>
            <!-- Additional decorative elements -->
            <div class="absolute top-16 right-12 w-8 h-8 bg-primary rounded-full opacity-20"></div>
            <div class="absolute top-32 right-8 w-4 h-4 bg-accent rounded-full opacity-30"></div>
        </div>

        <!-- Main content -->
        <div class="relative z-10 h-full flex flex-col">
            <!-- Logo section -->
            <div class="flex flex-col items-center justify-center px-8 pt-12 pb-52">
                <div class="mb-6 animate-fadeInUp">
                    <img src="{{ asset('images/irisepro-logo.png') }}" alt="iRisePro Logo" class="w-48 mx-auto">
                </div>
            </div>

            <!-- Login form section -->
            <div class="bg-[#FDE6D3] rounded-3xl mx-2.5 px-8 py-10 pb-8 mb-8 animate-slideInLeft">
                <!-- Login header -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-[#F58321] mb-2">LOGIN</h1>
                    <div class="w-full max-w-[80px] h-1 bg-primary rounded-full"></div>
                </div>

                <!-- Error/Success messages -->
                <div id="message-container" class="mb-4 hidden">
                    <div id="message" class="p-3 rounded-lg text-sm font-medium"></div>
                </div>

                <!-- Login form -->
                <form id="loginForm" class="space-y-6">
                    @csrf
                    <!-- Email input -->
                    <div class="space-y-2">
                        <input 
                            type="email" 
                            id="emailAddress"
                            name="email"
                            placeholder="Add Email ID" 
                            class="w-full px-4 py-4 bg-white rounded-lg border border-gray-200 text-gray-700 placeholder-gray-400 focus:outline-none input-focus transition-all duration-200"
                            required
                        >
                    </div>

                    <!-- Get OTP button -->
                    <button 
                        type="submit" 
                        id="submitBtn"
                        class="w-full bg-white text-primary font-semibold py-4 px-6 rounded-lg border-2 border-primary hover:bg-primary hover:text-white transition-all duration-300 shadow-sm hover:shadow-button"
                    >
                        Get OTP
                    </button>

                    <!-- Helper text -->
                    <p class="text-center text-gray-600 text-sm mt-6">
                        Enter Your Email ID
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Set up CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        const emailInput = document.getElementById('emailAddress');
        const submitBtn = document.getElementById('submitBtn');
        const messageContainer = document.getElementById('message-container');
        const message = document.getElementById('message');
        
        // Show message function
        function showMessage(text, type = 'error') {
            message.textContent = text;
            message.className = `p-3 rounded-lg text-sm font-medium ${
                type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
            }`;
            messageContainer.classList.remove('hidden');
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                messageContainer.classList.add('hidden');
            }, 5000);
        }
        
        // Form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const emailAddress = emailInput.value;
            
            // Validate email format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailAddress)) {
                showMessage('Please enter a valid email address');
                return;
            }
            
            // Show loading state
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Sending OTP...';
            submitBtn.disabled = true;
            
            // Send AJAX request to send OTP
            fetch('{{ route("mobile.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    email: emailAddress
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage('OTP sent successfully to your email', 'success');
                    
                    // Redirect to OTP verification page after 2 seconds
                    setTimeout(() => {
                        window.location.href = `{{ route("mobile.otp-verification") }}?email=${encodeURIComponent(emailAddress)}`;
                    }, 2000);
                } else {
                    showMessage(data.message || 'Failed to send OTP');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('An error occurred. Please try again.');
            })
            .finally(() => {
                // Reset button
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });

        // Add focus animations
        emailInput.addEventListener('focus', function() {
            this.parentElement.classList.add('scale-105');
        });

        emailInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('scale-105');
        });
    </script>
</body>
</html>
