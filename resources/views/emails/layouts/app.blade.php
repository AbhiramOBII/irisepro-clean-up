<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iRisePro</title>
    {{ $head ?? '' }}
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f5f5f5;">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <!-- Main Container -->
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

                    <!-- Header Section -->
                    <tr>
                        <td
                            style="background: linear-gradient(135deg, #FF8A3D 0%, #FFC107 100%); padding: 30px; text-align: center; border-radius: 8px 8px 0 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="text-align: center;">
                                        <h1
                                            style="color: #ffffff; font-size: 32px; font-weight: bold; margin: 0; text-shadow: 0 2px 4px rgba(0,0,0,0.2); text-align: center;">
                                            iRisePro
                                        </h1>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    @yield('body')

                    <!-- Footer -->
                    <tr>
                        <td
                            style="padding: 30px; background-color: #f8f9fa; border-radius: 0 0 8px 8px; text-align: center;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="text-align: center;">
                                        <p style="color: #999999; font-size: 12px; margin: 0 0 10px 0; text-align: center;">
                                            © {{ date('Y') }} iRisePro. All rights reserved.
                                        </p>
                                        <p style="color: #999999; font-size: 11px; margin: 0; text-align: center;">
                                            You received this email because you enrolled for a challenge at
                                            iRisePro.<br>
                                            If you have any questions, please contact us at
                                            <a href="mailto:support@irisepro.com"
                                                style="color: #FF8A3D; text-decoration: none;">support@irisepro.com</a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
