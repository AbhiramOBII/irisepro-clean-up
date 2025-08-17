<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yashodarshi Login - IrisePro</title>
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
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center font-montserrat">
    <div class="bg-white rounded-2xl login-shadow overflow-hidden max-w-md w-full mx-4">
        <div class="gradient-bg text-white p-8 text-center">
            <img src="{{ asset('images/icon.png') }}" alt="IrisePro" class="w-20 h-auto mx-auto mb-4">
            <h3 class="text-xl font-semibold mb-0">Yashodarshi Login</h3>
            <p class="text-sm opacity-90 mt-2">Enter your email to receive OTP</p>
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

            <form action="{{ route('yashodarshi.send-otp') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <input type="email" 
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-base transition-all duration-300 focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-25 @error('email') border-red-500 bg-red-50 @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="Enter your email address"
                           required>
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="w-full gradient-bg text-white py-3 px-4 rounded-xl text-base font-semibold transition-all duration-300 btn-hover">
                    <i class="fas fa-paper-plane mr-2"></i>Send OTP
                </button>
            </form>

            <div class="text-center mt-6">
                <small class="text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    You will receive a 6-digit OTP on your registered email
                </small>
            </div>
        </div>
    </div>
</body>
</html>
