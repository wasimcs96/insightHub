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
            {{-- <h1>Status Update</h1> --}}
            <p>Dear Applicant,</p>
            <p>Thank you for your interest in joining EEI. We are thrilled to know more about you during your upcoming interview and discuss how your skills and experiences align with our team. </p>
            <p><strong>Interview Details: </strong></p>
            {{-- <p><strong>Status:</strong> {{ $data['status'] ?? '' }}</p> --}}
            <p><strong>Position:</strong> {{ $data['position'] ?? '' }}</p>
            <p><strong>Interview Date and Time: </strong> {{ $data['interview_date'] ?? '' }}</p>
            {{-- <p><strong>Interview Time: </strong> {{ $data['interview_time'] ?? '' }}</p> --}}
            <p><strong>Interview Mode:</strong> {{ config('helpers.interview_mode')[$data['interview_mode']] ?? ''}}</p>
            @if($data['interview_mode'] == 2)
            <p><strong>Interview Link:</strong> {{ $data['interview_link'] ?? ''}}</p>
            @else
            <p><strong>Interview Location:</strong> {{ $data['interview_address'] ?? ''}}</p>
            @endif
            <p>Please confirm your availability by replying to this email at your earliest convenience. If the scheduled time is not convenient, let us know, and we will do our best to accommodate a different time. </p>
           <p><strong>What to Expect:</strong></p>
            
            <p>During the interview, we’ll dive deeper into your qualifications, experience, and how they could contribute to our ongoing projects at EEI. You’ll also get a chance to learn more about our company culture, team dynamics, and the exciting opportunities we offer. We encourage you to bring any questions you have about the role or EEI.</p>
            <br>
            <p><strong>Preparation Tips: </strong></p>
            <br>
            <p>Review the job description to refresh your understanding of the role. </p>
            <p>Be ready to discuss your relevant experience and how it applies to the position. </p>
            <p>Consider questions you’d like to ask about EEI, our culture, or the team. </p>
            <p>We look forward to our conversation and are excited about the possibility of you joining the EEI family.</p>
            <br>
            <p>Best regards,</p>
            <p>{{ $data['company_name'] ?? '' }}</p>
        </div>
        <div class="footer">
            <p>This is an automated email, please do not reply directly to this message.</p>
        </div>
    </body>
</html>