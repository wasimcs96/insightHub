<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ffffff;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #004288; /* Adjust to your company's branding color */
            color: #ffffff;
            padding: 20px 20px 10px;
            text-align: center;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
        }
        .footer {
            background-color: #f2f2f2;
            text-align: center;
            padding: 10px 20px;
            font-size: 0.875em;
        }
        .button {
            display: block;
            width: max-content;
            background-color: #004288; /* Adjust to your company's button color */
            color: #ffffff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 10px auto;
        }
        img.logo {
            max-width: 200px; /* Adjust based on your logo size */
            height: auto;
            margin: 0 auto;
            display: block;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://diamond-dev.cxs.team/media/insightaccess.png" alt="Company Logo" class="logo">
        <h1>Welcome to {{ $data['company_name'] ?? 'Company Name' }}</h1>
    </div>
    <div class="content">
        <p>Dear {{ $data['name'] ?? '' }},</p>
       
        <p>Congratulations on your successful application and welcome to<strong> {{ $data['company_name'] ?? 'Company Name' }} </strong>We are thrilled to have you join our team as our new<strong> {{ $data['job_title'] ?? 'Job Title' }} </strong>.</p>
        <p><strong>Your Start Date: </strong>{{ $data['start_date'] }}</p>
        <p><strong>Reporting To: </strong>{{ $data['manager'] }}</p>
        <p><strong>Location: </strong>{{ $data['location'] }}</p>

        <p><strong>Important Information: </strong></p>
        <p>Please note that your registered personal email has been changed to your official EEI company email for system login purposes. Moving forward, all communication and access to our internal systems will be through this official email. </p>
        <p><strong>Your EEI Email: </strong>{{ $data['official_email'] }}</p>
        <p>Attached to this email, you will find your onboarding schedule and other relevant documents. We encourage you to review these materials to ensure a smooth start to your journey with us. </p>
        <p>We are excited about the skills and energy you will bring to EEI as our new {{ $data['job_title'] ?? 'Job Title' }} and look forward to working with you. </p>
    </div>
    <div class="footer">
        <p>Best Regards,<br>{{ $data['company_name'] ?? 'Company Name' }} Team</p>
    </div>
</body>
</html>


