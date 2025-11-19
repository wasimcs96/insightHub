{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Change Email</title>
</head>
<body>
    <h1>Welcome to Our Application</h1>
    <p>Current Application Status: {{ $data['status'] }}</p>
<br>
    <p>Thanks</p>

</body>
</html> --}}

<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f4f4f4;
            }
            .email-container {
                max-width: 600px;
                margin: auto;
                background: white;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .logo {
                display: block;
                margin: 10px auto; /* Centers the logo and adds spacing */
                width: 100px; /* Adjust width as needed */
                height: auto;
            }
            .footer {
                font-size: 12px;
                color: #666;
                text-align: center;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <img src="https://diamond-dev.cxs.team/media/insightaccess.png" alt="Top Logo" class="logo">
            <h1>Status Update</h1>
            <p>Dear Applicant,</p>
            <p>This is an automated message to inform you about the current status of your application.</p>
            <p><strong>Status:</strong> {{ $data['status'] ?? ''}}</p>
            <p>Should you require more information or have any questions, please feel free to contact us.</p>
            <p>Thank you for your attention.</p>
            <p>Best regards,</p>
            <p>{{ $data['company_name'] ?? '' }}</p>
        </div>
        <div class="footer">
            <p>This is an automated email, please do not reply directly to this message.</p>
        </div>
    </body>
</html>