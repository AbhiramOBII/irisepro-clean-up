@extends('emails.layouts.app')
@section('body')
<!-- Success Animation/Icon -->
<tr>
    <td style="padding: 30px 30px 20px 30px; text-align: center;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td align="center">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #FF8A3D 0%, #FFC107 100%); border-radius: 50%; margin: 0 auto 20px auto; display: flex; align-items: center; justify-content: center;">
                        <span style="color: #ffffff; font-size: 40px; line-height: 1;">✓</span>
                    </div>
                    <h2 style="color: #333333; font-size: 28px; font-weight: bold; margin: 0 0 15px 0;">
                        🎉 Congratulations, {{ $student->full_name }}!
                    </h2>
                    <p style="color: #666666; font-size: 18px; line-height: 1.6; margin: 0;">
                        Payment successful! You're officially enrolled in the <strong style="color: #FF8A3D;">{{ $batch->challenge->title }}</strong> challenge.
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>

<!-- Challenge Confirmation Card -->
<tr>
    <td style="padding: 0 30px 30px 30px;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #FFF1E6; border-radius: 8px; border-left: 4px solid #FF8A3D;">
            <tr>
                <td style="padding: 25px;">
                    <h3 style="color: #FF8A3D; font-size: 20px; font-weight: bold; margin: 0 0 15px 0;">
                        🚀 Your Challenge Starts Soon!
                    </h3>
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding: 8px 0;">
                                <strong style="color: #333333; font-size: 16px;">Challenge:</strong>
                                <span style="color: #666666; font-size: 16px; margin-left: 10px;">{{ $batch->challenge->title }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0;">
                                <strong style="color: #333333; font-size: 16px;">Starts On:</strong>
                                <span style="color: #FF8A3D; font-size: 16px; font-weight: bold; margin-left: 10px;">{{ $batch->start_date->format('d M Y') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0;">
                                <strong style="color: #333333; font-size: 16px;">Duration:</strong>
                                <span style="color: #666666; font-size: 16px; margin-left: 10px;">
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

<!-- Next Steps Section -->
<tr>
    <td style="padding: 0 30px 30px 30px;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>
                    <h3 style="color: #333333; font-size: 18px; font-weight: bold; margin: 0 0 20px 0;">
                        📱 Ready to Get Started?
                    </h3>
                    <p style="color: #666666; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0;">
                        Download the iRisePro mobile app to access your personalized dashboard, track your progress, and stay connected with your challenge community.
                    </p>
                    
                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td style="padding: 10px 0; vertical-align: top; width: 30px;">
                                <span style="color: #FF8A3D; font-size: 18px;">📊</span>
                            </td>
                            <td style="padding: 10px 0 10px 15px;">
                                <strong style="color: #333333; font-size: 14px;">Track Your Progress</strong><br>
                                <span style="color: #666666; font-size: 13px;">Monitor daily tasks, view achievements, and see your position on the leaderboard</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 0; vertical-align: top;">
                                <span style="color: #FF8A3D; font-size: 18px;">🔔</span>
                            </td>
                            <td style="padding: 10px 0 10px 15px;">
                                <strong style="color: #333333; font-size: 14px;">Stay Updated</strong><br>
                                <span style="color: #666666; font-size: 13px;">Get notifications for new tasks, reminders, and important announcements</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 0; vertical-align: top;">
                                <span style="color: #FF8A3D; font-size: 18px;">🎯</span>
                            </td>
                            <td style="padding: 10px 0 10px 15px;">
                                <strong style="color: #333333; font-size: 14px;">Complete Tasks</strong><br>
                                <span style="color: #666666; font-size: 13px;">Submit your daily challenges and earn points to unlock achievements</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>

<!-- App Download CTA Section -->
<tr>
    <td style="padding: 0 30px 40px 30px;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: linear-gradient(135deg, #FF8A3D 0%, #FFC107 100%); border-radius: 8px;">
            <tr>
                <td style="padding: 30px; text-align: center;">
                    <h3 style="color: #ffffff; font-size: 20px; font-weight: bold; margin: 0 0 15px 0;">
                        📲 Download the iRisePro App
                    </h3>
                    <p style="color: #ffffff; font-size: 14px; margin: 0 0 25px 0; opacity: 0.9;">
                        Get the app now and be ready when your challenge begins on {{ $batch->start_date->format('d M Y') }}!
                    </p>
                    
                    <!-- App Store Button -->
                    <table cellpadding="0" cellspacing="0" border="0" align="center">
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td style="background-color: #01875f; border-radius: 8px; padding: 15px 30px;">
                                            <a href="https://appdistribution.firebase.google.com/testerapps/1:794204909926:android:34e196e0a54f3d48a918a7/releases/6i6on1c1le320?utm_source=firebase-console" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 16px; display: block;">
                                                🤖 Download for Android
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    
                    <p style="color: #ffffff; font-size: 12px; margin: 15px 0 0 0; opacity: 0.8;">
                        Available on Google Play Store
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>

<!-- Login Credentials Section -->
<tr>
    <td style="padding: 0 30px 30px 30px;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8f9fa; border-radius: 8px; border: 1px solid #e9ecef;">
            <tr>
                <td style="padding: 20px;">
                    <h4 style="color: #333333; font-size: 16px; font-weight: bold; margin: 0 0 15px 0;">
                        🔐 How to Access App
                    </h4>
                    <div style="background-color: #FFF1E6; border-left: 4px solid #FF8A3D; padding: 15px; margin: 15px 0; border-radius: 4px;">
                        <p style="color: #333333; font-size: 14px; margin: 0; line-height: 1.6; font-weight: 500;">
                            <strong style="color: #FF8A3D;">📱 Login Steps:</strong><br>
                            1. Enter your email ID in the app<br>
                            2. An OTP will be sent to your email<br>
                            3. Enter the OTP to verify and login
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>

<!-- Support Section -->
<tr>
    <td style="padding: 0 30px 30px 30px;">
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #e8f4fd; border-radius: 8px; border: 1px solid #bee5eb;">
            <tr>
                <td style="padding: 20px; text-align: center;">
                    <h4 style="color: #0c5460; font-size: 16px; font-weight: bold; margin: 0 0 10px 0;">
                        💬 Need Help Getting Started?
                    </h4>
                    <p style="color: #0c5460; font-size: 13px; margin: 0 0 15px 0;">
                        Our support team is here to help you every step of the way!
                    </p>
                    <table cellpadding="0" cellspacing="0" border="0" align="center">
                        <tr>
                            <td style="background-color: #0c5460; border-radius: 20px; padding: 10px 25px;">
                                <a href="mailto:support@irisepro.com" style="color: #ffffff; text-decoration: none; font-weight: bold; font-size: 14px; display: block;">
                                    📧 Contact Support
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
@endsection
