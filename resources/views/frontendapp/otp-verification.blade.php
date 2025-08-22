<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="light-content">
    <title>OTP Verification - iRisePro</title>
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
                        'bounce-gentle': 'bounceGentle 0.6s ease-out',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideInLeft: {
                            '0%': { opacity: '0', transform: 'translateX(-20px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        },
                        bounceGentle: {
                            '0%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.05)' },
                            '100%': { transform: 'scale(1)' }
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
            
            .otp-input {
                width: 3rem;
                height: 3rem;
                text-align: center;
                font-size: 1.5rem;
                font-weight: 600;
                border: 2px solid #e5e7eb;
                border-radius: 0.75rem;
                transition: all 0.2s ease;
            }
            
            @media (max-width: 380px) {
                .otp-input {
                    width: 2.5rem;
                    height: 2.5rem;
                    font-size: 1.25rem;
                }
            }
            
            .otp-input:focus {
                border-color: #FF8A3D;
                box-shadow: 0 0 0 3px rgba(255, 138, 61, 0.1);
                outline: none;
            }
            
            .otp-input.filled {
                border-color: #FF8A3D;
                background-color: rgba(255, 138, 61, 0.05);
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

            <!-- OTP form section -->
            <div class="bg-[#FDE6D3] rounded-3xl mx-2.5 px-4 sm:px-6 md:px-8 py-8 sm:py-10 pb-6 sm:pb-8 mb-8 animate-slideInLeft">
                <!-- OTP header -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-[#F58321] mb-2">VERIFY OTP</h1>
                    <div class="w-full max-w-[120px] h-1 bg-primary rounded-full"></div>
                </div>

                <!-- Email info -->
                <div class="mb-6">
                    <p class="text-gray-600 text-sm text-center px-1">
                        If you are a registered user, you will receive an OTP to your registered email address.
                        Click on the link to login.
                    </p>
                    <p class="text-center text-primary font-semibold text-sm mt-2 break-all">{{ $email }}</p>
                </div>

                <!-- Error/Success messages -->
                <div id="message-container" class="mb-4 hidden">
                    <div id="message" class="p-3 rounded-lg text-sm font-medium"></div>
                </div>

                <!-- OTP form -->
                <form id="otpForm" class="space-y-6">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    
                    <!-- OTP input fields -->
                    <div class="flex justify-center space-x-3 sm:space-x-4 md:space-x-3">
                        <input type="text" maxlength="1" class="otp-input" id="otp1" autocomplete="off">
                        <input type="text" maxlength="1" class="otp-input" id="otp2" autocomplete="off">
                        <input type="text" maxlength="1" class="otp-input" id="otp3" autocomplete="off">
                        <input type="text" maxlength="1" class="otp-input" id="otp4" autocomplete="off">
                        <input type="text" maxlength="1" class="otp-input" id="otp5" autocomplete="off">
                        <input type="text" maxlength="1" class="otp-input" id="otp6" autocomplete="off">
                    </div>

                    <!-- Timer and resend -->
                    <div class="text-center">
                        <p class="text-gray-600 text-sm mb-2">
                            Code expires in <span id="timer" class="font-semibold text-primary">--:--</span>
                        </p>
                        <button type="button" id="resendBtn" class="text-primary font-semibold text-sm hover:underline disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            Resend Code
                        </button>
                    </div>

                    <!-- Verify button -->
                    <button 
                        type="submit" 
                        id="verifyBtn"
                        class="w-full bg-white text-primary font-semibold py-4 px-6 rounded-lg border-2 border-primary hover:bg-primary hover:text-white transition-all duration-300 shadow-sm hover:shadow-button disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled
                    >
                        Verify OTP
                    </button>

                    <!-- Helper text -->
                    <p class="text-center text-gray-600 text-sm whitespace-normal px-1 mt-6">
                        Enter the 6-digit code sent to your email
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Set up CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Get OTP inputs
        const otpInputs = document.querySelectorAll('.otp-input');
        const verifyBtn = document.getElementById('verifyBtn');
        const resendBtn = document.getElementById('resendBtn');
        const timerElement = document.getElementById('timer');
        const messageContainer = document.getElementById('message-container');
        const message = document.getElementById('message');

        // Get email and expiration time from server
        const email = '{{ $email }}';
        const expiresAt = @if($expiresAt) new Date('{{ $expiresAt->toISOString() }}') @else null @endif;

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

        // Timer functionality
        let timerInterval;
        
        function startTimer() {
            if (!expiresAt) {
                timerElement.textContent = '00:00';
                resendBtn.disabled = false;
                return;
            }

            timerInterval = setInterval(() => {
                const now = new Date();
                const timeLeft = Math.max(0, Math.floor((expiresAt - now) / 1000));
                
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerElement.textContent = '00:00';
                    resendBtn.disabled = false;
                    resendBtn.textContent = 'Resend Code';
                    showMessage('OTP has expired. Please request a new code.');
                }
            }, 1000);
        }

        // Start timer on page load
        startTimer();

        // OTP input handling
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function(e) {
                const value = e.target.value;
                
                // Only allow numbers
                if (!/^\d*$/.test(value)) {
                    e.target.value = '';
                    return;
                }

                // Add filled class if input has value
                if (value) {
                    e.target.classList.add('filled');
                    e.target.classList.add('animate-bounce-gentle');
                    
                    // Move to next input
                    if (index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                } else {
                    e.target.classList.remove('filled');
                }

                // Remove animation class after animation completes
                setTimeout(() => {
                    e.target.classList.remove('animate-bounce-gentle');
                }, 600);

                // Check if all inputs are filled
                checkAllInputsFilled();
            });

            // Handle backspace
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                    otpInputs[index - 1].value = '';
                    otpInputs[index - 1].classList.remove('filled');
                    setTimeout(() => checkAllInputsFilled(), 10);
                }
            });

            // Handle paste
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text');
                const digits = pastedData.replace(/\D/g, '').slice(0, 6);
                
                digits.split('').forEach((digit, i) => {
                    if (otpInputs[i]) {
                        otpInputs[i].value = digit;
                        otpInputs[i].classList.add('filled');
                    }
                });
                
                setTimeout(() => checkAllInputsFilled(), 10);
            });
        });

        // Check if all inputs are filled
        function checkAllInputsFilled() {
            let filledCount = 0;
            otpInputs.forEach(input => {
                if (input.value && input.value.trim().length === 1) {
                    filledCount++;
                }
            });
            
            const allFilled = filledCount === 6;
            verifyBtn.disabled = !allFilled;
        }

        // Form submission
        document.getElementById('otpForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const otpCode = Array.from(otpInputs).map(input => input.value).join('');
            
            if (otpCode.length !== 6) {
                showMessage('Please enter the complete 6-digit OTP code');
                return;
            }
            
            // Show loading state
            const originalText = verifyBtn.textContent;
            verifyBtn.textContent = 'Verifying...';
            verifyBtn.disabled = true;
            
            // Send AJAX request to verify OTP
            fetch('{{ route("mobile.verify-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    email: email,
                    otp: otpCode
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage('OTP verified successfully! Redirecting...', 'success');
                    
                    // Redirect to dashboard
                    setTimeout(() => {
                        window.location.href = data.redirect_url;
                    }, 1500);
                } else {
                    showMessage(data.message || 'Invalid OTP. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('An error occurred. Please try again.');
            })
            .finally(() => {
                // Reset button
                verifyBtn.textContent = originalText;
                verifyBtn.disabled = false;
            });
        });

        // Resend OTP functionality
        resendBtn.addEventListener('click', function() {
            resendBtn.disabled = true;
            resendBtn.textContent = 'Sending...';
            
            // Send request to resend OTP
            fetch('{{ route("mobile.send-otp") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    email: email
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage('New OTP sent successfully!', 'success');
                    
                    // Clear all inputs
                    otpInputs.forEach(input => {
                        input.value = '';
                        input.classList.remove('filled');
                    });
                    
                    // Focus first input
                    otpInputs[0].focus();
                    
                    // Reset verify button
                    verifyBtn.disabled = true;
                    
                    // Restart timer (reload page to get new expiration time)
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showMessage(data.message || 'Failed to send OTP');
                    resendBtn.disabled = false;
                    resendBtn.textContent = 'Resend Code';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('An error occurred. Please try again.');
                resendBtn.disabled = false;
                resendBtn.textContent = 'Resend Code';
            });
        });

        // Focus first input on load
        window.addEventListener('load', () => {
            otpInputs[0].focus();
        });
    </script>
</body>
</html>
