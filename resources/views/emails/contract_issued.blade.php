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
        <h1>Welcome to {{ $data['company_name'] ?? 'Company Name' }}</h1>
    </div>
    <div class="content">
        <p>Dear {{ $data['name'] ?? '' }},</p>
    
        <p>Congratulations! We are delighted to inform you that you have been successfully selected for the position of<strong> {{ $data['job_title'] ?? 'Job Title' }} </strong>at EEI.</p>
        <p><strong>Important Details: </strong></p>
        <p><strong>Position/Job Title:</strong>{{ $data['job_title'] ?? 'Job Title' }}</p>
        <p><strong>Department: </strong>{{ $data['department'] ?? 'Department' }}</p>
        <p><strong>Commencement Date: </strong>{{ $data['start_date'] ?? 'Start Date' }}</p>
        <p><strong>Basic Salary: </strong>{{ $data['basic_salary'] ?? 'Basic Salary' }}</p>

        <p>Attached to this email, you will find your employment contract and the company’s policy documents. These documents outline the terms and conditions of your employment, including your job responsibilities, compensation, benefits, and other important information. </p>

        <p><strong>Action Required: </strong></p>
        <p><strong>Review the Contract: </strong>You can access your employment contract directly on our platform, where you can also perform a digital signature. If you prefer, you can download the attached contract, sign it manually, and then send it back to us by replying to this email with the signed document attached. </p>

        <p><strong>Sign the Contract: </strong>If you choose to sign digitally, simply log in to our platform, review the contract, and complete the digital signature process. Alternatively, you may print the contract, sign it, scan it, and email it back to us.</p>

        <p><strong>Deadline: </strong>Kindly complete the signing process by End of this week to confirm your acceptance of the offer.</p>

        <p>We are excited to welcome you to the EEI team and look forward to your contributions to our success. </p>

        <p>Thank you, and congratulations once again! </p>
    </div>
    <div class="footer">
        <p>Best Regards,<br>{{ $data['company_name'] ?? 'Company Name' }} Team</p>
    </div>
</body>
</html>


