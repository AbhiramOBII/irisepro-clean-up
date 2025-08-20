{{-- resources/views/emails/verify-email.blade.php --}}
@extends('emails.layouts.app')

@section('body')
    <tr>
        <td style="padding:30px">
            <h2 style="color:#FF8A3D;text-align:center;margin-bottom:25px">
                Email Verification
            </h2>

            <p>Hello {{ $name }},</p>
            <p>
                Thank you for completing your payment. Please verify your email with the OTP below:
            </p>

            <table align="center" cellpadding="0" cellspacing="0" style="margin:20px auto">
                <tr>
                    <td style="font-size:32px;font-weight:bold;color:#FF8A3D;letter-spacing:6px;">
                        {{ $otp }}
                    </td>
                </tr>
            </table>

            <p>This OTP is valid for <strong>{{ $expires_in }}</strong>. Do not share it with anyone.</p>

            <table align="center" cellpadding="0" cellspacing="0" style="margin:24px auto">
                <tr>
                    <td>
                        <a href="{{ url('mobile/otp-verification?email=' . urlencode($email)) }}" style="background:#FF8A3D;color:#ffffff;text-decoration:none;padding:12px 24px;border-radius:6px;font-weight:600;display:inline-block">
                            Verify Email Now
                        </a>
                    </td>
                </tr>
            </table>
            <p>
                If you didn’t request this, just ignore this email or contact support.
            </p>
        </td>
    </tr>
@endsection