<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Login OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .otp-container {
            background: #f8f9fa;
            border: 2px solid #007bff;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
            letter-spacing: 8px;
            margin: 10px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/irisepro-logo.png') }}" alt="IrisePro" class="logo">
        <h1>Student Login OTP</h1>
    </div>

    <p>Hello {{ $name }},</p>

    <p>You have requested to login to your student account. Please use the following One-Time Password (OTP) to complete your login:</p>

    <div class="otp-container">
        <div class="otp-code">{{ $otp }}</div>
        <p><strong>This OTP will expire in {{ $expires_in }}</strong></p>
    </div>

    <p>If you did not request this OTP, please ignore this email or contact support if you have concerns.</p>

    <p>For security reasons, please do not share this OTP with anyone.</p>

    <div class="footer">
        <p>This is an automated email from IrisePro. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} IrisePro. All rights reserved.</p>
    </div>
</body>
</html>
