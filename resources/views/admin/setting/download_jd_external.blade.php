<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ ($job->OrgDepartment->name ?? 'Department') . '-' . ($job->title ?? 'Position') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <style>
        @page {
            margin-top: 50px;
            margin-right: 50px;
            margin-left: 50px;
            margin-bottom: 50px;
        }
        body {
            font-family: 'Inter', Helvetica, Arial, sans-serif;
            margin: 0;
            line-height: 1.5;
            padding: 0;
        }
        .long-text-wrapper {
            word-break: break-all;
            overflow-wrap: break-word;
            word-wrap: break-word;
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
        .job-title-custom {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 16px;
            color: #071437;
            word-break: break-all;
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

        .footer {
            text-align: left;
            margin-top: 40px;
            font-size: 0.8em;
            color: #666;
        }

        .col1 {
            width: 100px;
        }

        .col2 {
            width: 200px;
        }

        .col3 {
            width: 300px;
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

        .orange-label {
            color: #F7941C;
            font-weight: 600;
            font-style: normal;
            font-size: 10px;
            line-height: 16px;
            letter-spacing: 0;
            margin-bottom: 2px;
        }

        .section-title-inter {
            color: #071437;
            font-weight: 600;
            font-style: normal;
            font-size: 14px;
            line-height: 100%;
            letter-spacing: 0;
            margin-top: 20px;
            margin-bottom: 10px;
            padding: 0;
            border-radius: 0;
            display: inline-block;
     }

        .main-section-title {
            color: #071437;
            font-weight: 600;
            font-style: normal;
            font-size: 14px;
            line-height: 100%;
            letter-spacing: 0;
            margin-top: 20px;
            margin-bottom: 10px;
            padding: 0;
            border-radius: 0;
            display: inline-block;
            }

        .info-value {
            font-weight: 400;
            font-style: normal;
            font-size: 10px;
            line-height: 15px;
            letter-spacing: 0;
            color: #2E2F38;
            word-break: break-all;
        }

        .cwf-numbered {
            font-weight: 600;
            font-style: normal;
            font-size: 10px;
            line-height: 15px;
            letter-spacing: 0;
            color: #2E2F38;
            margin-bottom: 8px;    
            margin-top: 0;
            word-break: break-all;
        }

        .cwf-key-tasks-title {
            font-weight: 600;
            font-style: normal;
            font-size: 8px;
            line-height: 12px;
            letter-spacing: 0;
            color: #727790;
            margin-bottom: 4px;    
            margin-top: 0;         
        }

        .cwf-key-task-list {
            margin: 0 0 14px 18px; 
            padding: 0;
        }

        .cwf-key-task-list li {
            font-weight: 400;
            font-style: normal;
            font-size: 8px;
            line-height: 9px;
            letter-spacing: 0;
            color: #2E2F38;
            margin: 0;
            padding: 0;
            list-style-type: disc;
            word-break: break-all;
        }
        .cwf-key-task-list li:first-child {
            margin-top: 4px; /* Space between "Key Tasks" and first bullet */
        }

        .tech-skill-title {
            font-weight: 600;
            font-style: normal;
            font-size: 10px;
            line-height: 15px;
            letter-spacing: 0;
            color: #2E2F38;
            margin-bottom: 2px;
            margin-top: 14px;
        }

        .tech-skill-desc {
            font-weight: 400;
            font-style: normal;
            font-size: 8px;
            line-height: 12px;
            letter-spacing: 0;
            color: #2E2F38;
            margin-bottom: 8px;
            margin-left: 0;
        }

        .generic-skill-title {
            font-weight: 600;
            font-style: normal;
            font-size: 10px;
            line-height: 15px;
            letter-spacing: 0;
            color: #2E2F38;
            margin-bottom: 2px;
            margin-top: 14px;
        }

        .generic-skill-desc {
            font-weight: 400;
            font-style: normal;
            font-size: 8px;
            line-height: 12px;
            letter-spacing: 0;
            color: #2E2F38;
            margin-bottom: 8px;
            margin-left: 0;
        }

        .job-role-desc {
            font-weight: 400;
            font-style: normal;
            font-size: 10px;
            line-height: 1.2;
            letter-spacing: 0;
            color: #2E2F38;
            word-break: break-all;
            /* margin-bottom: 20px; */
        }

        .logo-company {
            min-height: 32px;
            max-height: 128px;
            height: auto;
            width: auto;
            display: block;
            margin-left: 0;
            margin-top: 0;
}
    </style>
</head>

<body>
    @if ($base64Image)
        <img class="logo-company" src="data:image/png;base64,{{ $base64Image }}" alt="Company Logo">
    @endif
    <div style="height: 24px;"></div>
<div class="job-title-custom long-text-wrapper ">
    {{ $job->title ?? 'Job Title Placeholder' }}
</div>

<table style="width:100%; margin-bottom:16px; border-collapse: separate; border-spacing: 0 0;">
    <tr>
        <td style="width:154.33px; vertical-align:top; padding-right:12px;">
            <div class="orange-label">Business Unit</div>
            <div class="info-value long-text-wrapper">{{ $job->businessUnit->name ?? 'N/A' }}</div>
        </td>
        <td style="width:154.33px; vertical-align:top; padding-right:12px;">
            <div class="orange-label">Company/Division</div>
            <div class="info-value long-text-wrapper">{{ $job->division->head_of_division ?? 'N/A' }}</div>
        </td>
        <td style="width:154.33px; vertical-align:top; padding-right:0;">
            <div class="orange-label">Department</div>
            <div class="info-value long-text-wrapper">{{ $job->OrgDepartment->name ?? 'N/A' }}</div>
        </td>
    </tr>
</table>

<div class="orange-label" style="margin-bottom: 4px;">Job Role Description</div>
<div class="job-role-desc long-text-wrapper">
    {{ $job->description ?? 'Job Description' }}
</div>

<div class="section-title-inter">Job Qualifications</div>
<table style="width:100%; margin-top:6px">
    <tr>
        <td style="width:154.33px; vertical-align:top; padding-right:0;">
            <div class="orange-label">Education Level</div>
            <div class="info-value long-text-wrapper">{{ $job->educationLevel->name ?? 'N/A' }}</div>
        </td>
        <td style="width:154.33px; vertical-align:top; padding-right:0;">
            <div class="orange-label">Scope of Study</div>
            <div class="info-value long-text-wrapper">{{ $job->scopeStudy->name ?? 'N/A' }}</div>
        </td>
        <td style="width:154.33px; vertical-align:top; padding-right:0;">
            <div class="orange-label">Experience in Relevant Sector</div>
            <div class="info-value long-text-wrapper">{{ $job->work_experience ?? 'N/A' }}</div>
        </td>
    </tr>
</table>

    <div class="main-section-title">Critical Work Functions and Key Tasks</div>
    @foreach ($critical_functions as $key => $critical)
        @php $key = 1 + $key; @endphp
        <div class="cwf-numbered long-text-wrapper">{{ $key }}. {{ $critical->description ?? 'Critical Work Functions' }}</div>
        <div class="cwf-key-tasks-title">Key Tasks</div>
        <ul class="cwf-key-task-list">
            @foreach ($critical->cwfKeys as $cwfkey)
                <li class="long-text-wrapper">{{ $cwfkey->name ?? '' }}</li>
            @endforeach
        </ul>
    @endforeach
    <div class="technical-skill-section">
        <div class="main-section-title">Technical Skills</div>
        @foreach ($technical_skills as $techskill)
            @php
                $level = $techskill['pivot']['level'] ?? 1;
                $descKey = 'level_' . $level . '_description';
                $description = !empty($techskill[$descKey])
                    ? $techskill[$descKey]
                    : ($techskill['description'] ?? 'N/A');
            @endphp
            <div class="tech-skill-title long-text-wrapper">
                {{ $techskill['name'] ?? '' }}
            </div>
            <div class="tech-skill-desc long-text-wrapper">
                {{ $description }}
            </div>
        @endforeach
    </div>
    <div class="main-section-title">Generic Skills</div>
    @foreach ($generic_skills as $genskill)
        <div class="generic-skill-title long-text-wrapper">
            {{ $genskill->title ?? '' }}
        </div>
        <div class="generic-skill-desc long-text-wrapper">
            @php
                $desc = '';
                foreach ($masterSkills as $ms) {
                    if ($genskill->title == $ms->name) {
                        $desc = $ms->description;
                        break;
                    }
                }
            @endphp
            {{ $desc ?: 'N/A' }}
        </div>
    @endforeach

    <script type="text/php">
    if (isset($pdf)) {
        $pdf->page_script('
        $font = $fontMetrics->get_font("Helvetica", "normal");
        $size = 8;
        $y = 816;
        $x = 545;
        $color = array(102/255, 102/255, 102/255);
        $pdf->text(37, $y, "© CXS Analytics", $font, $size, $color);
        $pageNum = $PAGE_NUM;
        $pdf->text($x, $y, $pageNum, $font, $size, $color);
    ');
    }
</script>
</body>
</html>
