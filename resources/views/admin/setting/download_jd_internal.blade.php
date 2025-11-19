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
        .job-title-custom {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 16px;
            color: #071437;
        }
        .orange-label {
            color: #F7941C;
            font-weight: 600;
            font-size: 10px;
            margin-bottom: 2px;
        }
        .orange-label-mb {
            margin-bottom: 4px;
        }
        .info-value {
            font-size: 10px;
            color: #2E2F38;
        }
        .section-title-inter, .main-section-title {
            color: #071437;
            font-weight: 600;
            font-size: 14px;
            margin-top: 20px;
            margin-bottom: 10px;
            display: inline-block;
        }
        .tech-skill-title, .generic-skill-title {
            font-weight: 600;
            font-style: normal;
            font-size: 10px;
            line-height: 15px;
            letter-spacing: 0;
            color: #2E2F38;
            margin-top: 0;
            margin-bottom: 2px;
        }
        .tech-skill-desc, .generic-skill-desc {
            font-weight: 400;
            font-style: normal;
            font-size: 8px;
            line-height: 12px;
            letter-spacing: 0;
            color: #2E2F38;
            margin-bottom: 8px;
            margin-left: 0;
        }
        .cwf-numbered {
            font-weight: 600;
            font-size: 10px;
            color: #2E2F38;
            margin-bottom: 8px;
            margin-top: 0;
        }
        .cwf-key-tasks-title {
            font-weight: 600;
            font-size: 8px;
            color: #727790;
            margin-bottom: 4px;    
            margin-top: 0;    
        }
        .cwf-key-task-list {
            margin: 0 0 14px 18px;
            padding: 0;
        }
        .cwf-key-task-list li {
            font-size: 8px;
            color: #2E2F38;
            line-height: 9px;
            letter-spacing: 0;
            margin: 0;
            padding: 0;
            list-style-type: disc;
        }
        .three-columns-wrapper {
            margin-top: 60px;
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
        .heading-div {
            font-weight: 600;
            font-size: 10px;
            line-height: 100%;
            letter-spacing: 0;
            color: #2E2F38; 
            padding-bottom: 72px;
            border-bottom: 1px solid #C8CFD9;
            margin-bottom: 4px;
            margin-top: 0px;
            font-style: normal;
        }
        .heading-p-top, .heading-p-bottom {
            font-weight: 600;
            font-size: 8px;
            line-height: 100%;
            letter-spacing: 0;
            color: #2E2F38;
            margin-top: 0px;
            font-style: normal;
        }
        .heading-p-top { margin-bottom: 16px; }
        .heading-p-bottom { margin-bottom: 0px; }

        .job-meta-rectangles {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 16px; /* row gap, column gap */
            margin-bottom: 24px;
            width: 100%;
        }
        .job-meta-rectangle {
            background: #f8f9fb;
            border-radius: 6px;
            padding: 12px 16px;
            box-sizing: border-box;
        }
        .job-meta-label {
            color: #A0AEC0;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .job-meta-value {
            color: #2E2F38;
            font-size: 12px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .signature-box {
            width: 30%;
            text-align: left;
        }

        .signature-title {
            font-weight: 600;
            font-size: 10px;
            line-height: 100%;
            letter-spacing: 0;
            color: #2E2F38;
            margin-bottom: 24px;
        }

        .signature-line {
            border-bottom: 1px solid #C8CFD9;
            height: 18px;
            margin-bottom: 4px;
            width: 100%;
        }

        .signature-label {
            font-weight: 600;
            font-size: 8px;
            line-height: 100%;
            letter-spacing: 0;
            color: #2E2F38;
            margin-bottom: 8px;
            display: block;
        }

        .skill-level-number {
            font-weight: 600;
            font-size: 10px;
            line-height: 100%;
            letter-spacing: 0;
            color: #D5540A;
            vertical-align: middle;
            font-style: normal; 
        }

        .star-img {
            width: 10px;
            height: 10px;
            vertical-align: middle;
        }
        .generic-skill-level-label {
            font-weight: 600;
            font-size: 10px;
            line-height: 100%;
            letter-spacing: 0;
            color: #5D29AE;
            vertical-align: middle;
            font-style: normal;
            margin-top: -5px;
        }
        .job-role-desc {
            font-weight: 400;
            font-style: normal;
            font-size: 10px;
            line-height: 1.2;
            letter-spacing: 0;
            color: #2E2F38;
            margin-bottom: 20px;
        }
        .technical-skill-section > .main-section-title {
            margin-bottom: 16px;
        }
        .general-skill-section > .main-section-title {
            margin-bottom: 16px;
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
    <div class="job-title-custom long-text-wrapper">
        {{ $job->title ?? 'Job Title Placeholder' }}
    </div>

    <table style="width:100%; margin-bottom:24px; border-collapse: separate; border-spacing: 0 0;">
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

    <div class="orange-label orange-label-mb">Job Role Description</div>
    <div class="job-role-desc long-text-wrapper">
        {{ $job->description ?? 'Job Description' }}
    </div>

    <!-- Four rectangles for Position Level, Position Code, Top 3 RIASEC, Number of Headcount -->
    <table style="width:100%; margin-bottom:24px; border-collapse: separate; border-spacing: 8px; padding-left: 0; margin-left: -8px">
        <tr>
            <td style="background: #f8f9fb; border-radius: 6px; padding: 12px 16px; width: 50%;">
                <div class="job-meta-label">Position Level</div>
                <div class="job-meta-value">Level {{ $job->level ?? 'N/A' }}</div>
            </td>
            <td style="background: #f8f9fb; border-radius: 6px; padding: 12px 16px; width: 50%;">
                <div class="job-meta-label">Position Code</div>
                <div class="job-meta-value">{{ $job->code ?? 'N/A' }}</div>
            </td>
        </tr>
        <tr>
            <td style="background: #f8f9fb; border-radius: 6px; padding: 12px 16px;">
                <div class="job-meta-label">Top 3 RIASEC</div>
                <div class="job-meta-value">{{ $job->top3riasec ?? 'N/A' }}</div>
            </td>
            <td style="background: #f8f9fb; border-radius: 6px; padding: 12px 16px;">
                <div class="job-meta-label">Number of Headcount</div>
                <div class="job-meta-value">{{ $job->headcounts->count() ?? 0 }}</div>
            </td>
        </tr>
    </table>

    <div class="orange-label">Immediate Superior</div>
    <div class="info-value long-text-wrapper">{{ $job->superior->title ?? 'N/A' }}</div>

    <div class="section-title-inter" style="margin-bottom: 0px">Job Qualifications</div>
    <table style="width:100%; border-collapse: separate; border-spacing: 0 12px; table-layout: fixed; margin-top: -10px; margin-bottom: -12px">
        <tr>
            <td style="width:239.5px; height:35px; vertical-align:top; padding-right:16px;">
                <div class="orange-label">Education Level</div>
                <div class="info-value long-text-wrapper">{{ $job->educationLevel->name ?? 'N/A' }}</div>
            </td>
            <td style="width:239.5px; height:35px; vertical-align:top; padding-right:0;">
                <div class="orange-label">Scope of Study</div>
                <div class="info-value long-text-wrapper">{{ $job->scopeStudy->name ?? 'N/A' }}</div>
            </td>
        </tr>
        <tr>
            <td style="width:239.5px; height:35px; vertical-align:top; padding-right:16px;">
                <div class="orange-label">Secondary Scope of Study</div>
                <div class="info-value long-text-wrapper">
                    @php
                        $secondaryscopeArray = json_decode($job->jobSecondaryScopeOfStudies, true) ?? [];
                        $secondaryscopes = [];
                        foreach ($secondaryscopeArray as $secondaryscope) {
                            if (is_array($secondaryscope)) {
                                $secondaryscopes[] = $secondaryscope['title'];
                            }
                        }
                    @endphp
                    {{ implode(', ', $secondaryscopes) ?: 'N/A' }}
                </div>
            </td>
            <td style="width:239.5px; height:35px; vertical-align:top; padding-right:0;">
                <div class="orange-label">Relevant Professional Certificates</div>
                <div class="info-value long-text-wrapper">
                    @php
                        $certificatesArray = json_decode($job->professional_certificate, true) ?? [];
                        $certificates = [];
                        foreach ($certificatesArray as $certificate) {
                            if (is_array($certificate) && isset($certificate['value'])) {
                                $certificates[] = $certificate['value'];
                            }
                        }
                    @endphp
                    {{ implode(', ', $certificates) ?: 'N/A' }}
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:239.5px; height:35px; vertical-align:top; padding-right:16px;">
                <div class="orange-label">Relevant Training Programs</div>
                <div class="info-value long-text-wrapper">
                    @php
                        $relevant_trainingArray = json_decode($job->relevant_training, true) ?? [];
                        $relevant_trainings = [];
                        foreach ($relevant_trainingArray as $relevant_training) {
                            if (is_array($relevant_training) && isset($relevant_training['value'])) {
                                $relevant_trainings[] = $relevant_training['value'];
                            }
                        }
                    @endphp
                    {{ implode(', ', $relevant_trainings) ?: 'N/A' }}
                </div>
            </td>
            <td style="width:239.5px; height:35px; vertical-align:top; padding-right:0;">
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
    <div class="technical-skill-section" style="margin-top: -10px;">
        <div class="main-section-title">Technical Skills</div>
        @foreach ($technical_skills as $techskill)
            @php
                $level = $techskill['pivot']['level'] ?? $techskill['level'] ?? 1;
                $descKey = 'level_' . $level . '_description';
                $description = !empty($techskill[$descKey])
                    ? $techskill[$descKey]
                    : ($techskill['description'] ?? 'N/A');
            @endphp
            <div class="tech-skill-title long-text-wrapper">
                {{ $techskill['name'] ?? '' }}
                <span style="margin-left:8px; margin-bottom: -7px; display:inline-block;">
                    <img src="{{ public_path('media/star_orange.svg') }}" class="star-img" style="margin-bottom: -3px; display:inline-block;" alt="star">
                    <span style="margin-top: -6px" class="skill-level-number">{{ $level }}</span>
                </span>
            </div>
            <div class="tech-skill-desc long-text-wrapper" style="margin-left:0;">
                {{ $description }}
            </div>
        @endforeach
        </div>
    <div class="general-skill-section">
        <div class="main-section-title">Generic Skills</div>
        @foreach ($generic_skills as $genskill)
            @php
                $level = $genskill->level ?? 1;
                $levelLabels = [1 => 'Beginner', 2 => 'Intermediate', 3 => 'Advanced'];
                $levelLabel = $levelLabels[$level] ?? 'Beginner';
                $desc = '';
                foreach ($masterSkills as $ms) {
                    if ($genskill->title == $ms->name) {
                        $desc = $ms->description;
                        break;
                    }
                }
            @endphp
            <div class="generic-skill-title long-text-wrapper">
                {{ $genskill->title ?? '' }}
                <span style="margin-left:8px; margin-bottom: -7px; display:inline-block;">
                    <img src="{{ public_path('media/star_purple.svg') }}" class="star-img" style="margin-bottom: -2px; display:inline-block;" alt="star">
                    <span style="margin-top: -5px" class="generic-skill-level-label">{{ $levelLabel }}</span>
                </span>
            </div>
            <div class="generic-skill-desc long-text-wrapper" style="margin-left:0;">
                {{ $desc ?: 'N/A' }}
            </div>
        @endforeach
    </div>
    <div class="three-columns-wrapper">
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
