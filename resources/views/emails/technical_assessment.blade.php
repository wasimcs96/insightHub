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
        <img src="https://jc-insightaccess.cxs.team/media/insightaccess.png" alt="Company Logo" class="logo">
        {{-- <h1>Dear Team</h1> --}}
    </div>
    <div class="content">
        <p>Hi EEI team,</p>
        <p>We hope this message finds you well.</p>

        <p>As part of the ongoing HR exercise with InsightAccess, we are pleased to announce the rollout of the technical assessment to your group. This assessment is designed to provide both you and your managers with an understanding of your technical expertise in your specific job role.</p>

        <p><strong>They will be available on your account starting today and should be completed by April 2 (Wednesday). It should take no longer than 20 minutes. </strong></p>

        <p>You can log in using the account credentials below: </p>
        
        <p>Email Address: {{ $data['email'] ?? '[Your Login ID]' }}<br>
            Password: {{ $data['password'] ?? '[Your Password]' }}<br>
           <a href="{{ env('APP_URL') }}/login/" class="button" target="_blank"><strong>Login Here!</strong></a>
        </p>

        <p>Once logged in, you will see a button labeled "Technical Assessment" on the top home page to access the technical assessments specific to your job role. Please proceed to answer the questions to the best of your ability, without seeking external help, to ensure the most accurate results and representation of your skills.</p>

        <p>We wish you the best of luck and are excited to continue this journey with you.</p>

        <p>If you encounter any issues during this exercise, please report them directly on the system under the customer support tab.</p>

        <p>Thank you for your participation.</p>
    </div>
    <div class="footer">
        <p>Best Regards,<br>The InsightAccess Team</p>
    </div>
</body>
</html>
