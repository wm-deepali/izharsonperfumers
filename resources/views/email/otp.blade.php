<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Your OTP Code</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:30px;">
    <div style="max-width:480px; margin:0 auto; background:#fff; border-radius:8px; padding:30px; text-align:center;">
        <h2 style="margin-bottom:10px;">Your Verification Code</h2>
        <p style="color:#555;">
            {{ $purpose === 'register' ? 'Use the code below to complete your registration.' : 'Use the code below to log in.' }}
        </p>
        <div style="font-size:32px; letter-spacing:6px; font-weight:bold; margin:20px 0; color:#212529;">
            {{ $otp }}
        </div>
        <p style="color:#888; font-size:13px;">This code expires in 10 minutes. If you didn't request this, you can ignore this email.</p>
    </div>
</body>
</html>