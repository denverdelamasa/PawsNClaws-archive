<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; background-color: #f3f4f6;">
    <div style="max-width: 600px; margin: 40px auto; background-color: #ffffff; padding: 40px 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.08);">
        <div style="text-align: center;">
            <img src="https://i.imgur.com/O9n5pZH.png" alt="Cat Paw Logo" width="70" style="margin-bottom: 20px;">
            <h2 style="color: #1f2937; font-size: 24px; margin-bottom: 10px;">Your OTP Code is Here!</h2>
            <p style="font-size: 16px; color: #4b5563; margin-bottom: 30px;">
                We received a request to verify your identity. Please use the code below to proceed:
            </p>

            <div style="display: inline-block; background-color: #f9fafb; padding: 20px 30px; border-radius: 10px; border: 1px solid #e5e7eb; margin-bottom: 25px;">
                <h1 style="font-size: 36px; letter-spacing: 6px; margin: 0; color: #111827;">{{ $otp }}</h1>
            </div>

            <p style="font-size: 14px; color: #6b7280; margin-bottom: 20px;">
                This code is valid for <strong>5 minutes</strong>. Do not share this code with anyone.
            </p>
            <p style="font-size: 14px; color: #9ca3af;">
                If you didn’t request this code, feel free to ignore this message.
            </p>

            <hr style="margin: 40px 0; border: none; border-top: 1px solid #e5e7eb;">

            <p style="font-size: 12px; color: #9ca3af;">
                Need help? Contact our support team anytime.
                <br>
                Made with ❤️ by Meowverse
            </p>
        </div>
    </div>
</body>
</html>
