<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Skills Framework for Built Environment - Architectural Assistant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.5;
            /* background-color: #f5f5f5; */
            padding: 20px;
        }
        .text-center{
            text-align: center;
        }
        header {
            text-align: center;
            margin-bottom: 40px;
        }

        header img {
            max-width: 150px;
        }

        h1 {
            font-size: 2em;
            color: #0056b3;
            margin-bottom: 0;
        }

        h2 {
            font-size: 1.5em;
            color: #0056b3;
            margin-top: 5px;
        }

        .section-title {
            font-size: 1em;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #0056b3;
        }

        .sub-section-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
            color: #0056b3;
        }

        .content {
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #dddddd;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
            color: #333333;
        }

        .highlight {
            background-color: #f9f9f9;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            background: #f9f9f9;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.8em;
            color: #666;
        }

        .col1 {
            width: 100px;
            /* Adjust the width as needed */
        }

        .col2 {
            width: 200px;
            /* Adjust the width as needed */
        }

        .col3 {
            width: 300px;
            /* Adjust the width as needed */
        }

        .logo-default {
            position: absolute;
            top: 0;
            left: 0;
            width: 80px;
            height: auto;
        }

        .heading-div {
            color: #000;
padding-bottom: 72px;
        border-bottom: 1px solid #E1E1E1;
        margin-bottom: 4px;
font-size: 0.9em;
            margin-top: 0px;
        }

        .heading-p-top {
            margin-bottom: 16px;
        }

        .heading-p-bottom {
            margin-bottom: 0px;
        }
        
        .heading-p-top, .heading-p-bottom {
            color: #000;
font-size: 0.7em;
            margin-top: 0px;
        }

            .three-columns-wrapper {
        white-space: nowrap;
    }

    .column-box {
        display: inline-block;
        vertical-align: top;
        width: 30%;
        margin-right: 4%;
    }
    .column-box:last-child {
        margin-right: 0;
    }


    </style>
</head>

<body>
    <header>
 @if ($base64Image)
            <img class="logo-default" src="data:image/png;base64,{{ $base64Image }}">
        @endif
        <h2>Job Description</h2>
    </header>

    <div class="section-title">Job Title</div>
    <div class="content">{{ $job->title ?? 'Job Title' }}</div>

    <div class="section-title">Sector</div>
    <div class="content">{{ $job->sector->name ?? '' }}</div>

    <div class="section-title">Job Role Description</div>
    <div class="content">
        {{ $job->description ?? 'Job Description' }}
    </div>

    @if ($job->is_primary == 0)
    <h5><span style="font-size:14px;">1.</span>Position Level: {{ $job->level ?? '' }}</h5>
    <h5><span style="font-size:14px;">2.</span>Position Code: {{ $job->code ?? '' }}</h5>
    <h5><span style="font-size:14px;">3.</span>Group/Div/Dept/Sect/Unit: {{ $job->OrgDepartment->name ?? '' }}</h5>
    <h5><span style="font-size:14px;">4.</span>Immediate Superior: {{ $job->superior->title ?? '' }}</h5>
    <h5><span style="font-size:14px;">5.</span>Immediate Subordinates: {{ implode(', ', $job->subordinateJobs->pluck('title')->filter()->all()) }}</h5>
    <h5><span style="font-size:14px;">6.</span>No. Of Headcount: {{ $job->heads ?? '' }}</h5>



        <div class="section-title">Job Qualifications</div>

        <h5><span style="font-size:14px;">1.</span>Education Level: {{ $job->educationLevel->name ?? '' }}</h5>
        <h5><span style="font-size:14px;">2.</span>Scope of Study: {{ $job->scopeStudy->name ?? '' }}</h5>

        @php
            $secondaryscopeArray = json_decode($job->jobSecondaryScopeOfStudies, true) ?? [];
            $secondaryscopes = [];
            foreach ($secondaryscopeArray as $secondaryscope) {
                if (is_array($secondaryscope)) {
                    $secondaryscopes[] = $secondaryscope['title'];
                }
            }
        @endphp
        <h5><span style="font-size:14px;">3.</span>Secondary Scope of Study: {{ implode('| ', $secondaryscopes) ?? '' }}
        </h5>

        @php
            $certificatesArray = json_decode($job->professional_certificate, true) ?? [];
            $certificates = [];
            foreach ($certificatesArray as $certificate) {
                if (is_array($certificate) && isset($certificate['value'])) {
                    $certificates[] = $certificate['value'];
                }
            }
        @endphp
        <h5><span style="font-size:14px;">4.</span>Relevant Professional Certificates:
            {{ implode('| ', $certificates) ?? '' }}</h5>

        @php
            $relevant_trainingArray = json_decode($job->relevant_training, true) ?? [];
            $relevant_trainings = [];
            foreach ($relevant_trainingArray as $relevant_training) {
                if (is_array($relevant_training) && isset($relevant_training['value'])) {
                    $relevant_trainings[] = $relevant_training['value'];
                }
            }
        @endphp
        <h5><span style="font-size:14px;">5.</span>Relevant Training Programs:
            {{ implode(', ', $relevant_trainings) ?? '' }}</h5>
        <h5><span style="font-size:14px;">6.</span>Experience in Relevant Sector: {{ $job->work_experience ?? '' }}
            Years</h5>
    @endif

    <div class="section-title">Critical Work Functions and Key Tasks</div>
    @foreach ($critical_functions as $key => $critical)
        @php $key = 1 + $key; @endphp
        <h5 style="font-size:16px;"><span>{{ $key }}.</span>{{ $critical->description ?? 'Critical Work Functions' }}
        </h5>
        <h5>Key Tasks</h5>
        <ol type="i">
            @foreach ($critical->cwfKeys as $cwfkey)
                <li>{{ $cwfkey->name ?? '' }}</li>
            @endforeach
        </ol>
    @endforeach

    <div class="section-title">Technical Skills & Competencies</div>
    <table class="table">
        <tr class="highlight">
            <th>Skill</th>
            <th class="col2 text-center">Level</th>
        </tr>
        @foreach ($technical_skills as $techskill)
            <tr>
                <td>{{ $techskill->name ?? '' }}</td>
                <td class="col2 text-center">{{ $techskill->pivot->level ?? '' }}</td>
            </tr>
        @endforeach
    </table>

    <div class="section-title">Generic Skills & Competencies</div>
    <table class="table">
        <tr class="highlight">
            <th>Skill</th>
            <th class="col2 text-center">Level</th>
        </tr>
        @foreach ($generic_skills as $genericskill)
            <tr>
                <td>{{ $genericskill->title ?? '' }}</td>
                <td class="col2 text-center">{{ $genericskill->level ?? '' }}</td>
            </tr>
        @endforeach
    </table>

<div class="three-columns-wrapper" style="margin-top: 60px;">
    <div class="column-box">
        <div class="section-title heading-div">Employee</div>
        <div class="section-title heading-p-top">Name:</div>
        <div class="section-title heading-p-bottom">Date:</div>
    </div>
    <div class="column-box">
        <div class="section-title heading-div">Immediate Manager</div>
        <div class="section-title heading-p-top">Name:</div>
        <div class="section-title heading-p-bottom">Date:</div>
    </div>
    <div class="column-box">
        <div class="section-title heading-div">Division Head</div>
        <div class="section-title heading-p-top">Name:</div>
        <div class="section-title heading-p-bottom">Date:</div>
    </div>
</div>

    {{-- <div class="footer">
        ©CXS Analytics<br>
        Effective Date: Jan 2024, Version 1.1
    </div> --}}
</body>

</html>
