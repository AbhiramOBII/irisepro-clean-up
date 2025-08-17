<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Yashodarshi - IrisePro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'montserrat': ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#667eea',
                        'secondary': '#764ba2',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .login-shadow {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .otp-input {
            letter-spacing: 8px;
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center font-montserrat">
    <div class="bg-white rounded-2xl login-shadow overflow-hidden max-w-md w-full mx-4">
        <div class="gradient-bg text-white p-8 text-center">
            <img src="{{ asset('images/icon.png') }}" alt="IrisePro" class="w-20 h-auto mx-auto mb-4">
            <h3 class="text-xl font-semibold mb-0">Verify OTP</h3>
            <p class="text-sm opacity-90 mt-2">Enter the 6-digit code sent to your email</p>
        </div>
        
        <div class="p-8">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 mb-4">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 mb-4">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                </div>
            @endif

            <form action="{{ route('yashodarshi.verify-otp') }}" method="POST" id="otpForm">
                @csrf
                <div class="mb-6">
                    <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-key mr-2"></i>Enter OTP
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-4 text-2xl text-center font-bold border-2 border-gray-200 rounded-xl otp-input transition-all duration-300 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-25 @error('otp') border-red-500 bg-red-50 @enderror" 
                           id="otp" 
                           name="otp" 
                           placeholder="000000"
                           maxlength="6"
                           pattern="[0-9]{6}"
                           required>
                    @error('otp')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="w-full gradient-bg text-white py-3 px-4 rounded-xl text-base font-semibold transition-all duration-300 btn-hover mb-4">
                    <i class="fas fa-sign-in-alt mr-2"></i>Verify & Login
                </button>
            </form>

            <div class="text-center">
                <p class="mb-3">
                    <small class="text-gray-500">Didn't receive the code?</small>
                </p>
                <form action="{{ route('yashodarshi.resend-otp') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 border-2 border-gray-400 text-gray-600 hover:border-gray-600 hover:text-gray-800 rounded-xl text-sm transition-all duration-300">
                        <i class="fas fa-redo mr-1"></i>Resend OTP
                    </button>
                </form>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('yashodarshi.login') }}" class="text-primary hover:text-secondary transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-1"></i>Back to Email
                </a>
            </div>

            <div class="text-center mt-6">
                <small class="text-gray-500">
                    <i class="fas fa-clock mr-1"></i>
                    OTP expires in 10 minutes
                </small>
            </div>
        </div>
    </div>
    <script>
        // Auto-focus on OTP input
        document.getElementById('otp').focus();
        
        // Only allow numbers in OTP input
        document.getElementById('otp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Auto-submit when 6 digits are entered
        document.getElementById('otp').addEventListener('input', function(e) {
            if (this.value.length === 6) {
                document.getElementById('otpForm').submit();
            }
        });
    </script>
</body>
</html>
