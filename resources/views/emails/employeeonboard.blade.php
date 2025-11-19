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
    {{-- <div class="header">
        <img src="https://jc-insightaccess.cxs.team/media/insightaccess.png" alt="Company Logo" class="logo">
        <h1>Dear Team</h1>
    </div> --}}
    <div class="content">
        <p>Hello and Good Afternoon {{ $data['name'] }},</p>
        {{-- <p>I hope this email finds you well.</p> --}}
        <p>We are excited to offer you the opportunity to complete a psychometric assessment. This assessment is designed to help you understand yourself better, identify your strengths, and support your personal and professional growth. Here is a short description of our partners CXS. </p>
        <h3>Company Overview</h3>
 
        <p>In today's dynamic business landscape, talent is a key differentiator for organizations aiming to thrive and innovate. As EEI expands across the markets, attracting, developing, and retaining top talent is crucial for sustained success. By embracing innovative talent management approaches, EEI can address evolving market demands, capitalize on emerging opportunities, and stay ahead of the competition. </p>
 
        <p>InsightAccess, developed by CXS, represents a strategic investment in EEI human capital. It aligns with EEI vision of fostering a culture of excellence, collaboration, and continuous learning. InsightAccess enhances operational efficiency, data accuracy, and alignment across various HR functions, enabling more informed and data-driven talent acquisition, management and development processes.</p>
 
        <h3><strong>Why Take the Assessment?</strong></h3>
        <ul>
            <li><strong>Self-Discovery:</strong>Gain insights into your personality, strengths, and areas for development. </li>
            <li><strong>Professional Growth:</strong>Use the results to guide your career development and improve your performance.</li>
            <li><strong>Personal Benefit:</strong>The assessment is for your benefit, providing valuable information to help you succeed.</li>
        </ul>
        <h3>How to Complete the Assessment:</h3>
        <ul>
            <li><strong>Find a Comfortable Setting:</strong>Choose a quiet, stress-free environment where you can focus.</li>
            <li><strong>Be Honest:</strong>Answer the questions truthfully to get the most accurate results. Remember, there are no right or wrong answers.</li>
            <li><strong>Log In:</strong>Use the login ID and password provided below to access the assessment system. You can take the assessment on either your mobile device or computer.</li>
        </ul>
 
        <h3>Assessment Details:</h3>
        <ul>
            <li><strong>Personality & Motivation (OCEAN):</strong> 120 questions, estimated completion time 30 minutes</li>
            <li><strong>Work Interest (RIASEC):</strong> 60 questions, estimated completion time 15 minutes</li>
            <li><strong>Cognitive Ability:</strong> 50 questions, estimated completion time 15 minutes</li>
        </ul>
 
        <p>Login ID: {{ $data['email'] ?? '[Your Login ID]' }}<br>
            Password: {{ $data['password'] ?? '[Your Password]' }}<br>
           <a href="{{ env('APP_URL') }}/login/" class="button" target="_blank"><strong>Login Here!</strong></a>
        </p>
       
        <p><strong>Deadline:</strong>Please complete the assessment by April 25, 2025.</p>
 
        <p>Please see the attachment for additional details about the assessments <a href="{{ env('APP_URL') }}/media/eei-guide.pdf"><strong>View File</strong></a>.</p>
        <p>Your participation is highly encouraged as it will provide you with valuable insights to enhance your personal and professional journey. If you have any questions or need assistance, please feel free to reach out to Judith Soriano Zabala, Human Resource Supervisor – People Retention, email: jszabala@eei.com.ph </p>
 
        <p>Thank you for your commitment to personal growth and development. We look forward to seeing the positive impact this assessment will have on each of you. </p>
    </div>
    <div class="footer">
        <p>Thank you and enjoy your journey,<br>InsightAccess team</p>
    </div>
</body>
</html>
 