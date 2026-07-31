<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#333;">
    <div style="max-width:500px; margin:0 auto; padding:20px;">
        <h2>Verify your email</h2>
        <p>Hi {{ $name }},</p>
        <p>Thanks for registering. Please click the button below to verify your email address and activate your account.</p>
        <p style="text-align:center; margin:30px 0;">
            <a href="{{ $verification_url }}" style="background:#212529;color:#fff;padding:12px 24px;text-decoration:none;border-radius:4px;">
                Verify Email
            </a>
        </p>
        <p>This link will expire in 24 hours. If you didn't create this account, you can ignore this email.</p>
    </div>
</body>
</html>