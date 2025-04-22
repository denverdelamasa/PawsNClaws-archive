<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Application Approved</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" style="width: 100%; max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <!-- Header -->
        <tr>
            <td style="background-color: #1e40af; padding: 20px; text-align: center; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h1 style="color: #ffffff; margin: 0; font-size: 24px;">Verification Approved</h1>
            </td>
        </tr>
        <!-- Body -->
        <tr>
            <td style="padding: 20px;">
                <p style="font-size: 16px; color: #333333; margin: 0 0 10px;">Dear {{ $userName }},</p>
                <p style="font-size: 16px; color: #333333; margin: 0 0 10px;">
                    Congratulations! Your verification application to become a {{ $role }} has been <strong>approved</strong>.
                </p>
                <p style="font-size: 16px; color: #333333; margin: 0 0 10px;">
                    You can now access additional features and responsibilities associated with your new role.
                </p>
                <p style="font-size: 16px; color: #333333; margin: 0 0 20px;">
                    Thank you for joining our community!
                </p>
                <a href="{{ url('/') }}" style="display: inline-block; padding: 10px 20px; background-color: #1e40af; color: #ffffff; text-decoration: none; border-radius: 4px; font-size: 16px;">Visit Dashboard</a>
            </td>
        </tr>
        <!-- Footer -->
        <tr>
            <td style="background-color: #f4f4f4; padding: 10px; text-align: center; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                <p style="font-size: 12px; color: #666666; margin: 0;">&copy; {{ date('Y') }} Your App Name. All rights reserved.</p>
                <p style="font-size: 12px; color: #666666; margin: 5px 0 0;">
                    If you have any questions, contact us at <a href="mailto:support@yourapp.com" style="color: #1e40af; text-decoration: none;">support@yourapp.com</a>.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>