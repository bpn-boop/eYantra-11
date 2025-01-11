<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>
    <style>
        .container {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            text-align: center;
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            top: 35%; /* Position from the top */
            left: 50%; /* Position from the left */
            transform: translate(-50%, -50%); /* Centers the container */
            position: fixed; /* Fixes the position on the screen */
            z-index: 1000; /* Ensures it's on top of other content */
        }
        .container h1 {
            color: #333;
        }
        .container p {
            color: #555;
            margin-bottom: 20px;
        }
        .container a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }
        .container a:hover {
            text-decoration: underline;
        }
        .container img {
            max-width: 150px;
            margin: 0 auto 20px;
        }
        .status-message {
            margin-top: 15px;
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('demo/images/logo-white.png') }}" alt="Email Sent" />
        <h1>Check Your Email</h1>
        <p>We've sent a confirmation link to your email address. Please click the link to verify your account.</p>
        <p>
            If you didn't receive the email, check your spam folder or
            <a href="#" id="resendEmailLink">resend the email</a>.
        </p>
        <p id="resendStatus" class="status-message" style="display: none;"></p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const resendEmailLink = document.getElementById('resendEmailLink');
            const resendStatus = document.getElementById('resendStatus');

            resendEmailLink.addEventListener('click', function (event) {
                event.preventDefault();
                resendStatus.style.display = 'block';
                resendStatus.textContent = 'Resending email...';

                setTimeout(() => {
                    resendStatus.textContent = 'Email has been resent! Please check your inbox.';
                }, 2000);
            });
        });
    </script>
</body>
</html>
