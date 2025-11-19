<?php

return [
    'TYPE_FIELDS' => [
        // 'login' => 'Login',
        // 'assessment_link' => 'Assessment',
        // 'employee_on_board' => 'Employee Onboard',
        'send_assessment_link' => 'Send Assessment Link',
        // 'schedule_interview' => 'Schedule Interview',
        // 'issue_contract' => 'Issue Contract',
        'convert_to_employee' => 'Convert to Employee',
        // 'reject_candidate' => 'Reject Candidate',
        'OTP' => 'OTP Confirmation',
        'send_application_status_change_email' => 'Auto-email response for Candidate status change',
        'send_interview_invite_email_in_person' => 'Send Interview Invite Email (In Person)',
        'send_interview_invite_email_virtual_interview' => 'Send Interview Invite Email (Virtual Interview)',
        'send_interview_invite_email_phone_interview' => 'Send Interview Invite Email (Phone Interview)',
        // 'send_hired_email' => 'Send Hired Email',
        'send_employees_email' => 'Employee Onboarding Email',
        'assessment_resent_email' => 'Assessment Resent Email',
        'send_contract_issued_email' => 'Send Contract Issued Email',
        'technical_assessment_mail' => 'Send Technical Assessment',
        // 'send_candidate_email' => 'Send Candidate Email',
        'manual_employee_onboarding' => 'Manual Employee Onboarding'
    ],
    'EMAIL_BY_INTERVIEW_TYPE'=>[
        '1' => 'send_interview_invite_email_in_person',
        '2' => 'send_interview_invite_email_virtual_interview',
        '3' => 'send_interview_invite_email_phone_interview'
    ],
    'MARITAL_STATUSES' => [
        1 => 'Single',
        2 => 'Married',
        3 => 'Widowed',
        4 => 'Separated',
        5 => 'Divorced',
        6 => 'Annulled',
    ],

    'RELATION_EMPLOYEE'=>[
        1 => 'Parent',
        2=>'Spouse',
        3 =>'Sibling',
        4=>'Friend',
    ],
    'EMPLOYMENT_STATUSES'=>[
        1 =>'Full-Time',
        2=>'Part-Time',
        3 =>'Probationary',
        4=>'Contractual',
    ],
    'SECTORS' => [
        'Agriculture',
        'Manufacturing',
        'Services',
        'Construction',
        'Mining and Quarrying',
        'Energy',
        'Transportation and Logistics',
        'Information Technology',
        'Healthcare',
        'Media and Entertainment',
    ],
    'RIASEC_CODES' => ['Realistic'=>'R','Investigative'=>'I','Artistic'=>'A','Social'=>'S','Enterprising'=>'E','Conventional'=>'C'],
    'ALLOWANCE' =>[
        'uniform_allowance'=>'Uniform and clothing allowance',
       'rice_subsidy'=> 'Rice subsidy',
        'laundry_allowance'=>'Laundry allowance',
       'daily_meal_allowance'=> 'Daily meal allowance for business trips'
    ],
    'LEAVES' => [
        'SIL' => [
            'name' => 'Service Incentive Leave (SIL)',
            'entitlement' => 'Five (5) days of paid leave per year.',
            'eligibility' => 'Employees who have rendered at least one year of service.',
            'purpose' => 'Can be used for personal reasons, sickness, or vacation.',
        ],
        'ML' => [
            'name' => 'Maternity Leave',
            'entitlement' => '105 days of paid leave for live childbirth (can be extended for an additional 30 days without pay).',
            'additional_benefit' => '15 days additional leave for solo parents.',
            'eligibility' => 'Female employees in both the private and public sectors.',
            'purpose' => 'For childbirth and recovery.',
        ],
        'PL' => [
            'name' => 'Paternity Leave',
            'entitlement' => 'Seven (7) days of paid leave.',
            'eligibility' => 'Married male employees.',
            'purpose' => 'For the first four deliveries of the legitimate spouse with whom he is cohabiting.',
        ],
        'PLSP' => [
            'name' => 'Parental Leave for Solo Parents',
            'entitlement' => 'Seven (7) days of paid leave per year.',
            'eligibility' => 'Solo parents as defined under the Solo Parents Welfare Act (RA 8972).',
            'purpose' => 'To enable solo parents to perform parental duties and responsibilities.',
        ],
        'VAWCL' => [
            'name' => 'Leave for Victims of Violence Against Women and Their Children (VAWC Leave)',
            'entitlement' => 'Up to ten (10) days of paid leave.',
            'eligibility' => 'Female employees who are victims of violence as defined by RA 9262.',
            'purpose' => 'For medical and legal assistance.',
        ],
        'SLWGL' => [
            'name' => 'Special Leave for Women (Gynecological Leave)',
            'entitlement' => 'Up to two (2) months of paid leave.',
            'eligibility' => 'Female employees who have undergone surgery due to gynecological disorders.',
            'purpose' => 'For recovery from gynecological surgery.',
        ],
        'BL' => [
            'name' => 'Bereavement Leave',
            'entitlement' => 'Varies by company policy; not mandated by law but commonly provided.',
            'purpose' => 'For the death of an immediate family member.',
        ],
        'EML' => [
            'name' => 'Expanded Maternity Leave (RA 11210)',
            'entitlement' => 'Sixty (60) days of paid leave for miscarriage or emergency termination of pregnancy.',
            'eligibility' => 'Female employees.',
            'purpose' => 'For recovery after miscarriage or emergency termination of pregnancy.',
        ],
        'VL' => [
            'name' => 'Vacation Leave',
            'entitlement' => 'The employee is entitled to 15 days of paid vacation leave per calendar year.',
            'eligibility' => 'This benefit is available to all regular employees.',
            'purpose' => 'Vacation leave is provided for personal time off, including rest, relaxation, and travel.',
            'carryover'=>'Unused vacation leave may be carried over to the next year, subject to company policy. Specific carry-over limits or additional leave based on length of service will be outlined in the companys leave policy.'
        ],
        'SL' => [
            'name' => 'Sick Leave',
            'entitlement' => 'The employee is entitled to 15 days of paid sick leave per calendar year.',
            'eligibility' => 'This benefit is available to all regular employees.',
            'purpose' => 'Sick leave is provided to allow employees to recover from illness or medical conditions without loss of income.',
            'cumulative' => 'Unused sick leave may accumulate from year to year, subject to company policy. Extended illness or special conditions for additional sick leave will be managed according to company policy',

        ],
    ],
    'WEEK_DAYS' => [
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
        7 => 'Sunday',
    ],

    'BENEFITS' =>[
        'tranportation'=>'Transportation',
        'medical'=> 'Medical cash',
    ],

    "EMPLOYMENT_STATUS" => [
        1 => 'Full-Time',
        2 => 'Part-Time',
        3 => 'Contract',
        4 => 'Interns',
        5 => 'Freelancer'
    ],
    'LEVELS' => [
        1 => 'Level 1',
        2 => 'Level 2',
        3 => 'Level 3',
        4 => 'Level 4',
        5 => 'Level 5',
        6 => 'Level 6',
        7 => 'Level 7',
        8 => 'Level 8',
        9 => 'Level 9',
        10 => 'Level 10',
        11 => 'Level 11',
        12 => 'Level 12',
        13 => 'Level 13',
    ],
    'ALLOWED_ACTIONS_ORG_STRUCTURE' => [
        1 => 'Assign Employee',
        2 => 'Add Subordinate',
        3 => 'Move Employee',
        4 => 'Remove Employee',
        5 => 'Delete Position',
        6 => 'Edit JD',
        7 => 'Reassign Subordinates'        
    ],
    'ORG_STRUCTURE_LEVEL_COLORS' => [
        1 => '#14A6A6', // Level 1
        2 => '#FFCD44', // Level 2
        3 => '#54CF6E', // Level 3
        4 => '#49C0F3', // Level 4
        5 => '#AA91F4', // Level 5
        6 => '#1877A0', // Level 6
        7 => '#D4A21A', // Level 7
        8 => '#218336', // Level 8
        9 => '#1E95C8', // Level 9
        10 => '#7F66CA', // Level 10
        11 => '#3FD0D0', // Level 11
        12 => '#FFE18F', // Level 12
        13 => '#99E2A8', // Level 13
    ],
    'NON_STRUCTURAL' => [
        'job_title_change' => 'Job Title Change',
        'mark_as_critical' => 'Mark as Critical Job Position',
        'change_level' => 'Position Level Change',
        'assign_employee' => 'Assign Employee',
        'remove_employee' => 'Remove Employee',
        'edit_employee_assigned' => 'Edit Employee Assigned to Headcount',
        'remove_headcount' => 'Remove Headcount',
    ],
    'STRUCTURAL' => [
        'change_superior_confirmation' => 'Update Superior Job Position',
        'change_superior_headcount' => 'Update Superior Headcount ID',
        'add_new_headcount' => 'Add Headcount',
        'create_new_position' => 'Create New Job Position and Localise the Job Position - Create JD',
        'set_as_top_position' => 'Set as New Top Position in Org Chart',
        'delete_position_reassign' => 'Delete Position & Reassign Subordinates (if there is any subordinates)',
        'change_department'=> 'Change Department',
    ],

    'EMAIL_CONTENT_FIELDS' => [
        'OTP',
        'Job Title',
        'Assessment Link',
        'Interview Date',
        'Interview Time',
        'Interviewer Type',
        'Interview Link',
        'Interview Location',
        'Employee Email',
        'Employee Password',
        'HR Admin’s Full Name',
        'HR Admin’s Job Title',
        'Company Name',
        'Company Address',
        'Company Phone Number',
        'Company Email Address',
        'Employee Full Name',
        'Employee First Name',
        'Employee Middle Name',
        'Employee Last Name',
        'Start Date',
        'Basic Salary',
        'File Path',
    ],

    'SUBJECT_LINE_FIELDS' => [
        'Candidate’s First Name',
        'Candidate’s Last Name',
        'Candidate’s Full Name',
        'Job Title',
        'Assessment Link'
    ],

    '30_facets' => [
        'daydreaming' => 'Daydreaming',
        'aesthetic_appreciation' => 'Aesthetic Appreciation',
        'feeling_aware' => 'Feeling Aware',
        'explorer' => 'Explorer',
        'innovation' => 'Innovation',
        'open_mindedness' => 'Open-Mindedness',
        'self_confidence' => 'Self-Confidence',
        'tidiness' => 'Tidiness',
        'responsibility' => 'Responsibility',
        'drive_to_achieve' => 'Drive to Achieve',
        'willpower' => 'Willpower',
        'careful_thinking' => 'Careful Thinking',
        'sociability' => 'Sociability',
        'crowd_enjoyment' => 'Crowd Enjoyment',
        'confidence' => 'Confidence',
        'energetic_lifestyle' => 'Energetic Lifestyle',
        'thrill_seeking' => 'Thrill Seeking',
        'optimism' => 'Optimism',
        'belief' => 'Belief',
        'honesty' => 'Honesty',
        'helpfulness' => 'Helpfulness',
        'diplomacy' => 'Diplomacy',
        'humility' => 'Humility',
        'compassion' => 'Compassion',
        'steadiness' => 'Steadiness',
        'tolerance' => 'Tolerance',
        'positivity' => 'Positivity',
        'social_sensitivity' => 'Social Sensitivity',
        'impulse_control' => 'Impulse Control',
        'stress_response' => 'Stress Response',
    ],
];






