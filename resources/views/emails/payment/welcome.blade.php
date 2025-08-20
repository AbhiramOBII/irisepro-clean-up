@extends('emails.layouts.app')

@section('body')
    <!-- Welcome Message -->
    <tr>
        <td style="padding: 40px 30px 20px 30px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
                        <h2
                            style="color: #333333; font-size: 24px; font-weight: bold; margin: 0 0 20px 0; text-align: center;">
                            🎉 Welcome to Your Journey, {{ $student->full_name }}!
                        </h2>
                        <p
                            style="color: #666666; font-size: 16px; line-height: 1.6; margin: 0 0 20px 0; text-align: center;">
                            Congratulations! You've been successfully enrolled in iRisePro. We're excited to have you join
                            our community of achievers and help you unlock your full potential.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Challenge Details Card -->
    <tr>
        <td style="padding: 0 30px 20px 30px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                style="background-color: #FFF1E6; border-radius: 8px; border-left: 4px solid #FF8A3D;">
                <tr>
                    <td style="padding: 25px;">
                        <h3 style="color: #FF8A3D; font-size: 20px; font-weight: bold; margin: 0 0 15px 0;">
                            🚀 Your Challenge Details
                        </h3>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="padding: 8px 0;">
                                    <strong style="color: #333333; font-size: 14px;">Challenge:</strong>
                                    <span
                                        style="color: #666666; font-size: 14px; margin-left: 10px;">{{ $batch->challenge->title }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 8px 0;">
                                    <strong style="color: #333333; font-size: 14px;">Batch Start Date:</strong>
                                    <span
                                        style="color: #666666; font-size: 14px; margin-left: 10px;">{{ $batch->start_date->format('d M Y') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 8px 0;">
                                    <strong style="color: #333333; font-size: 14px;">Duration:</strong>
                                    <span
                                        style="color: #666666; font-size: 14px; margin-left: 10px;">
                                    {{ $duration ?? ($batch->challenge->tasks->count() . ' days') }}
                                    </span>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- What to Expect Section -->
    <tr>
        <td style="padding: 0 30px 30px 30px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td>
                        <h3 style="color: #333333; font-size: 18px; font-weight: bold; margin: 0 0 20px 0;">
                            ✨ What to Expect
                        </h3>
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="padding: 10px 0; vertical-align: top; width: 30px;">
                                    <span style="color: #FF8A3D; font-size: 18px;">📚</span>
                                </td>
                                <td style="padding: 10px 0 10px 15px;">
                                    <strong style="color: #333333; font-size: 14px;">Structured Learning Path</strong><br>
                                    <span style="color: #666666; font-size: 13px;">Daily tasks and challenges designed to
                                        build your skills progressively</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; vertical-align: top;">
                                    <span style="color: #FF8A3D; font-size: 18px;">🏆</span>
                                </td>
                                <td style="padding: 10px 0 10px 15px;">
                                    <strong style="color: #333333; font-size: 14px;">Achievement System</strong><br>
                                    <span style="color: #666666; font-size: 13px;">Earn points, unlock badges, and track
                                        your progress on the leaderboard</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0; vertical-align: top;">
                                    <span style="color: #FF8A3D; font-size: 18px;">👥</span>
                                </td>
                                <td style="padding: 10px 0 10px 15px;">
                                    <strong style="color: #333333; font-size: 14px;">Community Support</strong><br>
                                    <span style="color: #666666; font-size: 13px;">Connect with fellow learners and get
                                        guidance from mentors</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Payment CTA Section -->
    <tr>
        <td style="padding: 0 30px 40px 30px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                style="background: linear-gradient(135deg, #FF8A3D 0%, #FFC107 100%); border-radius: 8px;">
                <tr>
                    <td style="padding: 30px; text-align: center;">
                        <h3 style="color: #ffffff; font-size: 20px; font-weight: bold; margin: 0 0 15px 0;">
                            🎯 Complete Your Enrollment
                        </h3>
                        <p style="color: #ffffff; font-size: 14px; margin: 0 0 25px 0; opacity: 0.9;">
                            Secure your spot in the {{ $batch->challenge->title }} challenge and start your transformation journey today!
                        </p>

                        <!-- CTA Button -->
                        <table cellpadding="0" cellspacing="0" border="0" align="center">
                            <tr>
                                <td style="background-color: #ffffff; border-radius: 25px; padding: 15px 35px;">
                                    <a href="{{ $url }}"
                                        style="color: #FF8A3D; text-decoration: none; font-weight: bold; font-size: 16px; display: block;">
                                        💳 Complete Payment - ₹{{ number_format(($amount ?? ($batch->special_price ?? $batch->selling_price)), 0) }}
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="color: #ffffff; font-size: 12px; margin: 20px 0 0 0; opacity: 0.8;">
                            Secure payment powered by Razorpay • 100% Safe & Encrypted
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <!-- Important Information -->
    <tr>
        <td style="padding: 0 30px 30px 30px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                style="background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e9ecef;">
                <tr>
                    <td style="padding: 20px;">
                        <h4 style="color: #333333; font-size: 16px; font-weight: bold; margin: 0 0 15px 0;">
                            📋 Important Information
                        </h4>
                        <ul style="color: #666666; font-size: 13px; margin: 0; padding-left: 20px; line-height: 1.6;">
                            <li style="margin-bottom: 8px;">Complete your payment before {{ $payment_deadline ?? $batch->start_date->format('d M Y') }} to secure your
                                spot</li>
                            <li style="margin-bottom: 8px;">You'll receive login credentials within 24 hours of payment
                                confirmation</li>
                            <li style="margin-bottom: 8px;">The challenge begins on {{ $batch->start_date->format('d M Y') }} - mark your calendar!
                            </li>
                            <li style="margin-bottom: 0;">Need help? Contact our support team at support@irisepro.com</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection
