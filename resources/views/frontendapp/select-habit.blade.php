<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Select Your Habit - iRisePro</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #FF8A3D 0%, #FF6B1A 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            text-align: center;
        }

        .logo {
            width: 80px;
            height: 80px;
           
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
         
        }

        .logo i {
            color: white;
            font-size: 36px;
        }

        h1 {
            color: #1a1a1a;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .habit-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .habit-item {
            position: relative;
        }

        .habit-item input[type="radio"] {
            display: none;
        }

        .habit-item label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 15px;
            border: 2px solid #e5e5e5;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
            min-height: 100px;
        }

        .habit-item input:checked + label {
            border-color: #FF8A3D;
            background: linear-gradient(135deg, #FF8A3D, #FF6B1A);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 138, 61, 0.3);
        }

        .habit-item input:checked + label i {
            color: white;
        }

        .habit-item label:hover {
            border-color: #FF8A3D;
            transform: translateY(-1px);
        }

        .habit-item i {
            font-size: 24px;
            color: #FF8A3D;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        .habit-item span {
            font-size: 12px;
            font-weight: 500;
            text-align: center;
            line-height: 1.2;
        }

        .continue-btn {
            width: 100%;
            background: linear-gradient(135deg, #FF8A3D, #FF6B1A);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 138, 61, 0.3);
            opacity: 0.5;
            pointer-events: none;
            font-family: 'Montserrat', sans-serif;
        }

        .continue-btn.active {
            opacity: 1;
            pointer-events: auto;
        }

        .continue-btn.active:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 138, 61, 0.4);
        }

        .tagline {
            margin-top: 20px;
            color: #999;
            font-size: 12px;
            font-style: italic;
        }

        .loading {
            display: none;
        }

        .loading.show {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 10px;
            display: none;
        }

        .success-message {
            color: #27ae60;
            font-size: 14px;
            margin-top: 10px;
            display: none;
        }

        .no-habits {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px 20px;
        }

        .no-habits i {
            font-size: 48px;
            color: #ccc;
            margin-bottom: 16px;
        }

        .no-habits p {
            color: #666;
            margin-bottom: 8px;
        }

        .no-habits .support-text {
            font-size: 14px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/irisepro-logo.png') }}" alt="iRisePro Logo" style="width: 150px; height: auto;">
        </div>
        
        <h1>Choose Your Habit</h1>
        <p class="subtitle">Select a habit that resonates with your personal growth journey</p>
        
        <form id="habitForm">
            @csrf
            <!-- Habit Selection Section -->
            <div class="habit-grid">
                @forelse($habits as $habit)
                    <div class="habit-item">
                        <input type="radio" id="habit-{{ $habit->id }}" name="habit_id" value="{{ $habit->id }}">
                        <label for="habit-{{ $habit->id }}">
                            <i class="{{ $habit->icon ?? 'fas fa-seedling' }}"></i>
                            <span>{{ $habit->title }}</span>
                        </label>
                    </div>
                @empty
                    <div class="no-habits">
                        <i class="fas fa-exclamation-circle"></i>
                        <p>No habits available at the moment.</p>
                        <p class="support-text">Please contact support for assistance.</p>
                    </div>
                @endforelse
            </div>

            @if($habits->count() > 0)
                <button type="submit" class="continue-btn" id="continueBtn">
                    <span class="loading" id="loadingSpinner"></span>
                    <span id="btnText">Continue to Dashboard</span>
                </button>
            @endif

            <div class="error-message" id="errorMessage"></div>
            <div class="success-message" id="successMessage"></div>
        </form>

        <p class="tagline">Rise As One, Rise For India</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('habitForm');
            const continueBtn = document.getElementById('continueBtn');
            const habitInputs = document.querySelectorAll('input[name="habit_id"]');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const btnText = document.getElementById('btnText');
            const errorMessage = document.getElementById('errorMessage');
            const successMessage = document.getElementById('successMessage');

            // Enable continue button when a habit is selected
            habitInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (continueBtn) {
                        continueBtn.classList.add('active');
                    }
                });
            });

            // Handle form submission
            if (form && continueBtn) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const selectedHabit = document.querySelector('input[name="habit_id"]:checked');
                    
                    if (!selectedHabit) {
                        showError('Please select a habit to continue');
                        return;
                    }

                    // Show loading state
                    loadingSpinner.classList.add('show');
                    btnText.textContent = 'Saving...';
                    continueBtn.disabled = true;
                    hideMessages();

                    // Prepare form data
                    const formData = new FormData();
                    formData.append('habit_id', selectedHabit.value);
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                    // Submit to server
                    fetch('{{ route("mobile.save-habit") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showSuccess(data.message);
                            setTimeout(() => {
                                window.location.href = '{{ route("mobile.dashboard") }}';
                            }, 1500);
                        } else {
                            showError(data.message || 'An error occurred. Please try again.');
                            resetButton();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showError('Network error. Please check your connection and try again.');
                        resetButton();
                    });
                });
            }

            function showError(message) {
                errorMessage.textContent = message;
                errorMessage.style.display = 'block';
                successMessage.style.display = 'none';
            }

            function showSuccess(message) {
                successMessage.textContent = message;
                successMessage.style.display = 'block';
                errorMessage.style.display = 'none';
            }

            function hideMessages() {
                errorMessage.style.display = 'none';
                successMessage.style.display = 'none';
            }

            function resetButton() {
                if (loadingSpinner && btnText && continueBtn) {
                    loadingSpinner.classList.remove('show');
                    btnText.textContent = 'Continue to Dashboard';
                    continueBtn.disabled = false;
                }
            }
        });
    </script>
</body>
</html>
