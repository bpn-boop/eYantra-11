<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header img {
            width: 150px;
        }
        .email-content {
            font-size: 16px;
            color: #333333;
            line-height: 1.5;
        }
        .email-content p {
            margin: 15px 0;
        }
        .email-content a {
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            padding: 15px 25px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
        }
        .email-content a:hover {
            background-color: #45a049;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <!-- Header with logo -->
        <div class="email-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Wikimedia-logo.png/640px-Wikimedia-logo.png" alt="Company Logo">
        </div>

        <!-- Main content of the email -->
        <div class="email-content">
            <h2>Hello, {{ $name }}!</h2>
            <p>Thank you for registering with us. To complete the registration process, please verify your email address by clicking the button below.</p>
                        
            <!-- Button to trigger email verification -->
            <a href="{{ $verification_link }}">Verify Your Email</a>

        </div>

        <!-- Footer -->
        <div class="footer">
            <p>If you did not sign up for this account, please ignore this email.</p>
        </div>
    </div>

</body>
</html>
