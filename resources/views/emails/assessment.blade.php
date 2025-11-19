{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
</head>
<body>
    <h1>Welcome to Our Application</h1>
    <p>Give Your Assessment: <a href="{{ env('APP_URL') }}login/" target="_blank">Click Here</a> </p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Password: {{ $data['email'] }}</p>
<br>
    <p>Thanks</p>

</body>
</html> --}}

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
        <h1>{{ $data['company_name'] ?? 'Company Name' }} Recruitment Team</h1>
    </div>
    <div class="content">
        <p>Hi {{ $data['name'] ?? '' }},</p>
        <p>Thank you for applying for the <strong>{{ $data['job_title'] ?? 'Job Title' }}</strong> position at <strong>{{ $data['company_name'] ?? 'Company Name' }}</strong>. We are excited about your interest in joining our team and appreciate the effort you put into your application.</p>
        <p>To move forward in our hiring process, we invite you to participate in the assigned assessment tests on our platform. Please log in to the platform using your existing credentials and complete the assessments within one week of receiving this email.</p>
        <h2>How to Complete the Assessment:</h2>
        <ul>
            <li><strong>Find a Comfortable Setting:</strong> Choose a quiet, stress-free environment where you can focus.</li>
            <li><strong>Be Honest:</strong> Answer the questions truthfully to get the most accurate results. Remember, there are no right or wrong answers.</li>
            <li><strong>Log In:</strong> Use your login ID and password to access the assessment system. You can take the assessment on either your mobile device or computer.</li>
        </ul>
        <h2>Assessment Details:</h2>
        <ul>
            <li><strong>Personality & Motivation (OCEAN):</strong> 120 questions, estimated completion time 30 minutes</li>
            <li><strong>Work Interest (RIASEC):</strong> 60 questions, estimated completion time 15 minutes</li>
            <li><strong>Cognitive Ability:</strong> 50 questions, estimated completion time 15 minutes</li>
        </ul>
        <a href="{{ env('APP_URL') }}/login/" class="button" target="_blank">Click Here to Take Assessment</a>
        <p>Once you have completed the assigned assessments, our hiring team will thoroughly review all submissions and will inform you of the next steps.</p>
        <p>Thank you again for your interest in joining {{ $data['company_name'] ?? 'Company Name' }}. We look forward to your participation in the assessments.</p>
    </div>
    <div class="footer">
        <p>Best Regards,<br>{{ $data['company_name'] ?? 'Company Name' }} Recruitment Team</p>
    </div>
</body>
</html>

