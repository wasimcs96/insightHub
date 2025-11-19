<?php

return [
    'user_type' => array(1 => 'Internal',2 => 'External'),
    'status' => array(1 => 'Active',2 => 'InActive'),
    'employment_type' => array(1 => 'Full Time',2 => 'Part Time'),
    'job_advertisement_employment_type' => array(1 => 'Full Time',2 => 'Part Time'),

    // 'application_status' => array(
    // //    1 => 'Pending review',
    // //    2 =>  'Rejected',
    // //    3 =>  'Assessment in Progress',
    // //    4 =>  'Assessment Submitted',
    // //    5 => 'Interview Scheduled',
    // //    6 =>  'Interview Completed',
    // //    7 =>  'Offer Issued',
    // //    8 =>  'Offer Accepted',
    // //    9 => 'Offer Decline',
    // //    10 => 'Hired',
    // //    11 => 'Offer Expired'

    // 1 => 'Pending',

    // 2 => 'Assessment Pending',

    // 3 =>  'Assessment Completed',

    // 4 =>  'Shortlisted',

    // 5 =>  'Interview Scheduled',

    // 6 =>   'Interview Completed',

    // 7 =>  'Contract Issued',

    // 8 =>  'Hired',
    // ),
    'application_status' => array(
       1 =>  'Applied',
       2 =>  'Assessment Link Sent',
       3 =>  'Assessment Pending',
       4 =>  'Assessment Completed',
       5 =>  'Shortlisted',
       6 =>  'Interview Scheduled',
       7 =>  'Interview Completed',
       8 =>  'Offered',
       9 =>  'Offer Accepted',
       10 => 'Offer Declined',
       11 => 'Offer Expired',
       12 => 'Hired'

    ),
    'levels' => array(
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
        // 14 => 'Level 14',
        // 15 => 'Level 15'
    ),

    'position_levels' => array(
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
        // 14 => 'Level 14',
        // 15 => 'Level 15'
    ),

    'interview_mode' => array(
        1 => 'Physical',
        2 => 'Online',
        3 => 'Phone'
    ),

    'interview_option' => array(
        1 => 'Needs Improvement',
        3 => 'Meets Expectations',
        5 => 'Exceeds Expectations'
    ),
    'interview_performance' => array(
        1 => 'Excellent',
        2 => 'Good',
        3 => 'Marginal'
    ),
    'interview_completion' => array(
        1 => 'Yes',
        0 => 'No'
    ),
    'register_steps_completed' => array(1 => 'personal-info',2 => 'location-info',3 => 'education-info',4 => 'job-preference', 5 => 'employment-history-and-skills', 6=> 'upload-documents'),
    'steps_completed_name_first' => array(
        'personal-info' => 1,
        'location-info' => 2,
        'education-info' => 3,
        'job-preference' => 4,
        'employment-history-and-skills' => 5,
        'upload-documents' => 6
    ),
    // 'stats' => [
    //     'Openness to Experience' => ['mean' => 3.44, 'sd' => 0.35],
    //     'Conscientiousness' => ['mean' => 4.03, 'sd' => 0.55],
    //     'Extraversion' => ['mean' => 3.41, 'sd' => 0.37],
    //     'Agreeableness' => ['mean' => 3.80, 'sd' => 0.45],
    //     'Emotional Stability' => ['mean' => 3.34, 'sd' => 0.55],
    //     'Developing People' => ['mean' => 80.71, 'sd' => 9.55],
    //     'Learning Agility' => ['mean' => 72.67, 'sd' => 13.07], 
    //     'Adaptability' => ['mean' => 65.56, 'sd' => 9.80],
    //     'Self Management' => ['mean' => 72.16, 'sd' => 12.32],
    //     'Collaboration' => ['mean' => 64.22, 'sd' => 10.73], 
    //     'Influence' => ['mean' => 77.86, 'sd' => 9.76],
    //     'Creative Thinking' => ['mean' => 68.77, 'sd' => 9.89],
    //     'Sense Making' => ['mean' => 74.04, 'sd' => 9.94],
    //     'Communication' => ['mean' => 73.48, 'sd' => 10.70],
    //     'Transdisciplinary Thinking' => ['mean' => 65.01, 'sd' => 12.23],
    //     'Decision Making' => ['mean' => 69.04, 'sd' => 10.26],
    //     'Digital Fluency' => ['mean' => 63.15, 'sd' => 15.46],
    //     'Global Perspective' => ['mean' => 68.83, 'sd' => 11.07],
    //     'Customer Orientation' => ['mean' => 83.33, 'sd' => 10.97],
    //     'Building Inclusivity' => ['mean' => 76.54, 'sd' => 11.15],
    //     'Problem Solving' => ['mean' => 76.54, 'sd' => 11.15],
    //     'Daydreaming' => ['mean' => 3.16, 'sd' => 0.77], 
    //     'Aesthetic Appreciation' => ['mean' => 3.89, 'sd' => 0.66], 
    //     'Feeling Aware' => ['mean' => 3.67, 'sd' => 0.53], 
    //     'Explorer' => ['mean' => 3.25, 'sd' => 0.61], 
    //     'Innovation' => ['mean' => 3.64, 'sd' => 0.65], 
    //     'Open-Mindedness' => ['mean' => 3.04, 'sd' => 0.51], 
    //     'Self-Confidence' => ['mean' => 4.18, 'sd' => 0.59], 
    //     'Tidiness' => ['mean' => 3.93, 'sd' => 0.80], 
    //     'Responsibility' => ['mean' => 4.24, 'sd' => 0.66], 
    //     'Drive to Achieve' => ['mean' => 3.95, 'sd' => 0.71], 
    //     'Willpower' => ['mean' => 4.00, 'sd' => 0.64], 
    //     'Careful Thinking' => ['mean' => 3.86, 'sd' => 0.88], 
    //     'Sociability' => ['mean' => 3.37, 'sd' => 0.46], 
    //     'Crowd Enjoyment' => ['mean' => 2.93, 'sd' => 0.83], 
    //     'Confidence' => ['mean' => 3.57, 'sd' => 0.65], 
    //     'Energetic Lifestyle' => ['mean' => 3.40, 'sd' => 0.56], 
    //     'Thrill Seeking' => ['mean' => 2.99, 'sd' => 0.61], 
    //     'Optimism' => ['mean' => 4.22, 'sd' => 0.54], 
    //     'Belief' => ['mean' => 3.52, 'sd' => 0.65], 
    //     'Honesty' => ['mean' => 4.40, 'sd' => 0.69], 
    //     'Helpfulness' => ['mean' => 4.09, 'sd' => 0.60], 
    //     'Diplomacy' => ['mean' => 3.74, 'sd' => 0.67], 
    //     'Humility' => ['mean' => 3.36, 'sd' => 0.88], 
    //     'Compassion' => ['mean' => 3.70, 'sd' => 0.62], 
    //     'Steadiness' => ['mean' => 3.03, 'sd' => 0.82], 
    //     'Tolerance' => ['mean' => 3.53, 'sd' => 0.84], 
    //     'Positivity' => ['mean' => 3.87, 'sd' => 0.73], 
    //     'Social Sensitivity' => ['mean' => 2.92, 'sd' => 0.69], 
    //     'Impulse Control' => ['mean' => 3.18, 'sd' => 0.69], 
    //     'Stress Response' => ['mean' => 3.53, 'sd' => 0.71],
    //     'Growth Potential' => ['mean' => 71.30, 'sd' => 6.90],
    //     'Flight Risk' => ['mean'=>3.50, 'sd'=> 0.39],
    //     'Organizational Fit Forecast' => ['mean'=>3.64, 'sd'=> 0.34],
    //     'Dare to dream' => ['mean' => 3.64, 'sd' => 0.39], 
    //     'All for One, One for All' => ['mean' => 3.57, 'sd' => 0.44], 
    //     'Make a difference' => ['mean' => 3.90, 'sd' => 0.52], 
    //     'Celebrate all individuals' => ['mean' => 3.70, 'sd' => 0.46], 
    //     'Keep it simple' => ['mean' => 3.81, 'sd' => 0.59], 
    //     'Be transparent' => ['mean' => 4.00, 'sd' => 0.56], 
    //     'Have empathy and respect' => ['mean' => 3.72, 'sd' => 0.51], 
    //     'Safety #1' => ['mean' => 4.03, 'sd' => 0.62]
    // ],
    'stats' => [
       'ph' => [
            'Openness to Experience' => ['mean' => 3.37, 'sd' => 0.34],
            'Conscientiousness' => ['mean' => 3.92, 'sd' => 0.53],
            'Extraversion' => ['mean' => 3.45, 'sd' => 0.41],
            'Agreeableness' => ['mean' => 3.66, 'sd' => 0.44],
            'Emotional Stability' => ['mean' => 3.24, 'sd' => 0.52],
            'Developing People' => ['mean' => 77.95, 'sd' => 10.36],
            'Learning Agility' => ['mean' => 70.35, 'sd' => 12.47],
            'Adaptability' => ['mean' => 65.74, 'sd' => 9.62],
            'Self Management' => ['mean' => 69.61, 'sd' => 11.77],
            'Collaboration' => ['mean' => 62.76, 'sd' => 9.91],
            'Influence' => ['mean' => 79.17, 'sd' => 10.33],
            'Creative Thinking' => ['mean' => 67.58, 'sd' => 9.12],
            'Sense Making' => ['mean' => 73.35, 'sd' => 9.53],
            'Communication' => ['mean' => 70.95, 'sd' => 10.77],
            'Transdisciplinary Thinking' => ['mean' => 64.02, 'sd' => 11.51],
            'Decision Making' => ['mean' => 67.71, 'sd' => 9.47],
            'Digital Fluency' => ['mean' => 63.31, 'sd' => 13.72],
            'Global Perspective' => ['mean' => 65.90, 'sd' => 10.16],
            'Customer Orientation' => ['mean' => 81.38, 'sd' => 10.27],
            'Building Inclusivity' => ['mean' => 74.24, 'sd' => 10.44],
            'Problem Solving' => ['mean' => 82.70, 'sd' => 11.61],
            'Daydreaming' => ['mean' => 3.16, 'sd' => 0.68],
            'Aesthetic Appreciation' => ['mean' => 3.77, 'sd' => 0.62],
            'Feeling Aware' => ['mean' => 3.54, 'sd' => 0.52],
            'Explorer' => ['mean' => 3.20, 'sd' => 0.56],
            'Innovation' => ['mean' => 3.51, 'sd' => 0.61],
            'Open-Mindedness' => ['mean' => 3.04, 'sd' => 0.49],
            'Self-Confidence' => ['mean' => 4.14, 'sd' => 0.56],
            'Tidiness' => ['mean' => 3.81, 'sd' => 0.65],
            'Responsibility' => ['mean' => 4.17, 'sd' => 0.66],
            'Drive to Achieve' => ['mean' => 3.81, 'sd' => 0.66],
            'Willpower' => ['mean' => 3.92, 'sd' => 0.65],
            'Careful Thinking' => ['mean' => 3.73, 'sd' => 0.84],
            'Sociability' => ['mean' => 3.37, 'sd' => 0.47],
            'Crowd Enjoyment' => ['mean' => 2.92, 'sd' => 0.81],
            'Confidence' => ['mean' => 3.62, 'sd' => 0.60],
            'Energetic Lifestyle' => ['mean' => 3.37, 'sd' => 0.56],
            'Thrill Seeking' => ['mean' => 2.99, 'sd' => 0.60],
            'Optimism' => ['mean' => 4.16, 'sd' => 0.57],
            'Belief' => ['mean' => 3.28, 'sd' => 0.62],
            'Honesty' => ['mean' => 4.37, 'sd' => 0.78],
            'Helpfulness' => ['mean' => 3.89, 'sd' => 0.62],
            'Diplomacy' => ['mean' => 3.83, 'sd' => 0.61],
            'Humility' => ['mean' => 3.33, 'sd' => 0.77],
            'Compassion' => ['mean' => 3.35, 'sd' => 0.65],
            'Steadiness' => ['mean' => 3.19, 'sd' => 0.63],
            'Tolerance' => ['mean' => 3.55, 'sd' => 0.73],
            'Positivity' => ['mean' => 3.81, 'sd' => 0.60],
            'Social Sensitivity' => ['mean' => 3.31, 'sd' => 0.69],
            'Impulse Control' => ['mean' => 3.56, 'sd' => 0.71],
            'Stress Response' => ['mean' => 3.47, 'sd' => 0.72],
            'Growth Potential' => ['mean' => 69.92, 'sd' => 5.95],
            'Flight Risk' => ['mean' => 3.42, 'sd' => 0.35],
            'Organizational Fit Forecast' => ['mean' => 3.56, 'sd' => 0.30],
            'Dare to dream' => ['mean' => 3.64, 'sd' => 0.39],
            'All for One, One for All' => ['mean' => 3.59, 'sd' => 0.59],
            'Make a difference' => ['mean' => 3.72, 'sd' => 0.45],
            'Celebrate all individuals' => ['mean' => 3.47, 'sd' => 0.51],
            'Keep it simple' => ['mean' => 3.58, 'sd' => 0.55],
            'Be transparent' => ['mean' => 3.83, 'sd' => 0.46],
            'Have empathy and respect' => ['mean' => 3.71, 'sd' => 0.62],
            'Safety #1' => ['mean' => 4.03, 'sd' => 0.62]
        ],
        
        'my' => [
            'Openness to Experience' => ['mean' => 3.31, 'sd' => 0.35],
            'Conscientiousness' => ['mean' => 3.98, 'sd' => 0.51],
            'Extraversion' => ['mean' => 3.42, 'sd' => 0.44],
            'Agreeableness' => ['mean' => 3.68, 'sd' => 0.43],
            'Emotional Stability' => ['mean' => 3.28, 'sd' => 0.53],
            'Developing People' => ['mean' => 79.40, 'sd' => 12.09],
            'Learning Agility' => ['mean' => 67.88, 'sd' => 13.61],
            'Adaptability' => ['mean' => 63.98, 'sd' => 9.51],
            'Self Management' => ['mean' => 72.55, 'sd' => 12.61],
            'Collaboration' => ['mean' => 62.73, 'sd' => 10.02],
            'Influence' => ['mean' => 78.27, 'sd' => 11.30],
            'Creative Thinking' => ['mean' => 67.12, 'sd' => 11.17],
            'Sense Making' => ['mean' => 72.30, 'sd' => 9.65],
            'Communication' => ['mean' => 71.46, 'sd' => 12.95],
            'Transdisciplinary Thinking' => ['mean' => 63.50, 'sd' => 12.64],
            'Decision Making' => ['mean' => 68.08, 'sd' => 10.11],
            'Digital Fluency' => ['mean' => 62.43, 'sd' => 14.97],
            'Global Perspective' => ['mean' => 63.36, 'sd' => 10.63],
            'Customer Orientation' => ['mean' => 81.42, 'sd' => 10.90],
            'Building Inclusivity' => ['mean' => 75.95, 'sd' => 9.96],
            'Problem Solving' => ['mean' => 82.83, 'sd' => 10.54],
            'Daydreaming' => ['mean' => 3.12, 'sd' => 0.75],
            'Aesthetic Appreciation' => ['mean' => 3.59, 'sd' => 0.75],
            'Feeling Aware' => ['mean' => 3.57, 'sd' => 0.65],
            'Explorer' => ['mean' => 3.17, 'sd' => 0.63],
            'Innovation' => ['mean' => 3.39, 'sd' => 0.68],
            'Open-Mindedness' => ['mean' => 3.01, 'sd' => 0.54],
            'Self-Confidence' => ['mean' => 4.14, 'sd' => 0.53],
            'Tidiness' => ['mean' => 4.01, 'sd' => 0.77],
            'Responsibility' => ['mean' => 4.24, 'sd' => 0.66],
            'Drive to Achieve' => ['mean' => 3.81, 'sd' => 0.66],
            'Willpower' => ['mean' => 3.89, 'sd' => 0.69],
            'Careful Thinking' => ['mean' => 3.80, 'sd' => 0.66],
            'Sociability' => ['mean' => 3.34, 'sd' => 0.43],
            'Crowd Enjoyment' => ['mean' => 2.83, 'sd' => 0.77],
            'Confidence' => ['mean' => 3.60, 'sd' => 0.60],
            'Energetic Lifestyle' => ['mean' => 3.31, 'sd' => 0.56],
            'Thrill Seeking' => ['mean' => 3.10, 'sd' => 0.62],
            'Optimism' => ['mean' => 4.17, 'sd' => 0.59],
            'Belief' => ['mean' => 3.27, 'sd' => 0.62],
            'Honesty' => ['mean' => 4.37, 'sd' => 0.78],
            'Helpfulness' => ['mean' => 3.89, 'sd' => 0.62],
            'Diplomacy' => ['mean' => 3.83, 'sd' => 0.61],
            'Humility' => ['mean' => 3.33, 'sd' => 0.77],
            'Compassion' => ['mean' => 3.35, 'sd' => 0.65],
            'Steadiness' => ['mean' => 3.19, 'sd' => 0.63],
            'Tolerance' => ['mean' => 3.55, 'sd' => 0.73],
            'Positivity' => ['mean' => 3.81, 'sd' => 0.60],
            'Social Sensitivity' => ['mean' => 3.31, 'sd' => 0.69],
            'Impulse Control' => ['mean' => 3.56, 'sd' => 0.71],
            'Stress Response' => ['mean' => 3.47, 'sd' => 0.72],
            'Growth Potential' => ['mean' => 69.60, 'sd' => 6.18],
            'Flight Risk' => ['mean' => 3.38, 'sd' => 0.36],
            'Organizational Fit Forecast' => ['mean' => 3.57, 'sd' => 0.31],
            'Dare to dream' => ['mean' => 3.64, 'sd' => 0.39],
            'All for One, One for All' => ['mean' => 3.59, 'sd' => 0.59],
            'Make a difference' => ['mean' => 3.72, 'sd' => 0.45],
            'Celebrate all individuals' => ['mean' => 3.47, 'sd' => 0.51],
            'Keep it simple' => ['mean' => 3.58, 'sd' => 0.55],
            'Be transparent' => ['mean' => 3.83, 'sd' => 0.46],
            'Have empathy and respect' => ['mean' => 3.71, 'sd' => 0.62],
            'Safety #1' => ['mean' => 4.03, 'sd' => 0.62]
        ],
    
        'all' => [
            'Openness to Experience' => ['mean' => 3.34, 'sd' => 0.34],
            'Conscientiousness' => ['mean' => 3.95, 'sd' => 0.52],
            'Extraversion' => ['mean' => 3.44, 'sd' => 0.42],
            'Agreeableness' => ['mean' => 3.67, 'sd' => 0.43],
            'Emotional Stability' => ['mean' => 3.26, 'sd' => 0.53],
            'Developing People' => ['mean' => 78.68, 'sd' => 11.22],
            'Learning Agility' => ['mean' => 69.11, 'sd' => 13.04],
            'Adaptability' => ['mean' => 64.86, 'sd' => 9.56],
            'Self Management' => ['mean' => 71.08, 'sd' => 12.19],
            'Collaboration' => ['mean' => 62.74, 'sd' => 9.96],
            'Influence' => ['mean' => 78.72, 'sd' => 10.82],
            'Creative Thinking' => ['mean' => 67.35, 'sd' => 10.14],
            'Sense Making' => ['mean' => 72.82, 'sd' => 9.59],
            'Communication' => ['mean' => 71.20, 'sd' => 11.86],
            'Transdisciplinary Thinking' => ['mean' => 63.76, 'sd' => 12.07],
            'Decision Making' => ['mean' => 67.90, 'sd' => 9.79],
            'Digital Fluency' => ['mean' => 62.87, 'sd' => 14.35],
            'Global Perspective' => ['mean' => 64.63, 'sd' => 10.39],
            'Customer Orientation' => ['mean' => 81.40, 'sd' => 10.59],
            'Building Inclusivity' => ['mean' => 75.10, 'sd' => 10.20],
            'Problem Solving' => ['mean' => 82.77, 'sd' => 11.08],
            'Daydreaming' => ['mean' => 3.14, 'sd' => 0.72],
            'Aesthetic Appreciation' => ['mean' => 3.68, 'sd' => 0.69],
            'Feeling Aware' => ['mean' => 3.56, 'sd' => 0.59],
            'Explorer' => ['mean' => 3.19, 'sd' => 0.60],
            'Innovation' => ['mean' => 3.45, 'sd' => 0.65],
            'Open-Mindedness' => ['mean' => 3.03, 'sd' => 0.52],
            'Self-Confidence' => ['mean' => 4.14, 'sd' => 0.55],
            'Tidiness' => ['mean' => 3.91, 'sd' => 0.71],
            'Responsibility' => ['mean' => 4.20, 'sd' => 0.66],
            'Drive to Achieve' => ['mean' => 3.81, 'sd' => 0.66],
            'Willpower' => ['mean' => 3.91, 'sd' => 0.67],
            'Careful Thinking' => ['mean' => 3.77, 'sd' => 0.75],
            'Sociability' => ['mean' => 3.36, 'sd' => 0.45],
            'Crowd Enjoyment' => ['mean' => 2.88, 'sd' => 0.79],
            'Confidence' => ['mean' => 3.61, 'sd' => 0.60],
            'Energetic Lifestyle' => ['mean' => 3.34, 'sd' => 0.56],
            'Thrill Seeking' => ['mean' => 3.05, 'sd' => 0.61],
            'Optimism' => ['mean' => 4.17, 'sd' => 0.58],
            'Belief' => ['mean' => 3.28, 'sd' => 0.62],
            'Honesty' => ['mean' => 4.37, 'sd' => 0.78],
            'Helpfulness' => ['mean' => 3.89, 'sd' => 0.62],
            'Diplomacy' => ['mean' => 3.83, 'sd' => 0.61],
            'Humility' => ['mean' => 3.33, 'sd' => 0.77],
            'Compassion' => ['mean' => 3.35, 'sd' => 0.65],
            'Steadiness' => ['mean' => 3.19, 'sd' => 0.63],
            'Tolerance' => ['mean' => 3.55, 'sd' => 0.73],
            'Positivity' => ['mean' => 3.81, 'sd' => 0.60],
            'Social Sensitivity' => ['mean' => 3.31, 'sd' => 0.69],
            'Impulse Control' => ['mean' => 3.56, 'sd' => 0.71],
            'Stress Response' => ['mean' => 3.47, 'sd' => 0.72],
            'Growth Potential' => ['mean' => 69.76, 'sd' => 6.07],
            'Flight Risk' => ['mean' => 3.40, 'sd' => 0.36],
            'Organizational Fit Forecast' => ['mean' => 3.57, 'sd' => 0.30],
            'Dare to dream' => ['mean' => 3.64, 'sd' => 0.39],
            'All for One, One for All' => ['mean' => 3.59, 'sd' => 0.59],
            'Make a difference' => ['mean' => 3.72, 'sd' => 0.45],
            'Celebrate all individuals' => ['mean' => 3.47, 'sd' => 0.51],
            'Keep it simple' => ['mean' => 3.58, 'sd' => 0.55],
            'Be transparent' => ['mean' => 3.83, 'sd' => 0.46],
            'Have empathy and respect' => ['mean' => 3.71, 'sd' => 0.62],
            'Safety #1' => ['mean' => 4.03, 'sd' => 0.62],
        ]
    ],
    'growth_potential_levels' => [
        0 => 'N/A',
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'flight_risk_levels' => [
        0 => 'N/A',
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'organizational_fit_forecast_levels' => [
        0 => 'N/A',
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'cognitive_ability_levels' => [
        0 => 'N/A',
        1 => 'Low',
        2 => 'Moderate',
        3 => 'High'
    ],
    'interview_levels' => [
        0 => 'Interview Not Completed',
        // 1 => 'Unsatisfactory',
        // 2 => 'Below Expectation',
        // 3 => 'Adequate',
        // 4 => 'Strong',
        // 5 => 'Outstanding'
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'overall_match_rate_levels' => [
        // 0 => 'N/A',
        // 1 => 'Minimal',
        // 2 => 'Limited',
        // 3 => 'Moderate',
        // 4 => 'Strong',
        // 5 => 'Exceptional'
        0 => 'N/A',
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'behavior_fit_rate_levels' => [
        0 => 'N/A',
        // 1 => 'Minimal',
        // 2 => 'Limited',
        // 3 => 'Moderate',
        // 4 => 'Strong',
        // 5 => 'Exceptional'
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'job_match_rate_levels' => [
        0 => 'N/A',
        // 1 => 'Minimal',
        // 2 => 'Limited',
        // 3 => 'Moderate',
        // 4 => 'Strong',
        // 5 => 'Exceptional'
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'technical_skill_match_rate_levels' => [
        0 => 'N/A',
        // 1 => 'Minimal',
        // 2 => 'Limited',
        // 3 => 'Moderate',
        // 4 => 'Strong',
        // 5 => 'Exceptional'
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'leadership_potential_levels' => [
        0 => 'N/A',
        // 1 => 'Minimal',
        // 2 => 'Limited',
        // 3 => 'Moderate',
        // 4 => 'Strong',
        // 5 => 'Exceptional'
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'performance_predictive_rate_levels' => [
        0 => 'N/A',
        // 1 => 'Minimal',
        // 2 => 'Limited',
        // 3 => 'Moderate',
        // 4 => 'Strong',
        // 5 => 'Exceptional'
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'technical_assessment_levels' => [
        // 0 => 'N/A',
        // 1 => 'Insufficient Proficiency',
        // 2 => 'Limited Proficiency',
        // 3 => 'Satisfactory Proficiency',
        // 4 => 'Strong Proficiency',
        // 5 => 'Exceptional Proficiency'
        0 => 'N/A',
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'soft_skill_match_rate_levels' => [
        0 => 'N/A',
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'talent_pillar_match_rate_levels' => [
        -1 => 'N/A',
        0 => 'N/A',
        // 0 => 'Development Stage',
        // 1 => 'Basic Skill',
        // 2 => 'Intermediate Skill',
        // 3 => 'Advanced Skill'
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'suitability_rate_levels' => [
        0 => 'N/A',
        // 1 => 'Not Suitable',
        // 2 => 'Moderately Suitable',
        // 3 => 'Suitable',
        // 4 => 'Very Suitable',
        // 5 => 'Highly Suitable'
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'rci_levels' => [
        -1 => 'N/A',
        0 => 'Somewhat Consistent',
        1 => 'Fairly Consistent',
        2 => 'Consistent'
    ],
    'suggestion_levels' => [
       -2 => 'N/A',
       -1 => 'Interview Not Completed',
        0 => 'Technical Assessment & Interview Not Completed',  
        1 => 'Further Review',
        2 => 'Consider Further',
        3 => 'Hire'
    ],
    'ccs_levels' => [
        0 => 'Development Stage',
        1 => 'Basic',
        2 => 'Intermediate',
        3 => 'Advanced'
    ],
    'ocean_levels' => [
        0 => 'N/A',
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'ocean_domain_mapping' => [
        'openness-to-experience' => ['low' => 'openness', 'high' => 'pragmatism'],
        'conscientiousness' => ['low' => 'low-self-control', 'high' => 'high-self-control'],
        'extraversion' => ['low' => 'extraversion', 'high' => 'Pragmatism'],
        'agreeableness' => ['low' => 'agreeableness', 'high' => 'independence'],
        'emotional-stability' => ['low' => 'low-anxiety', 'high' => 'high-anxiety'],
    ],
    'ocean_all_facets_mapping' => [
        'daydreaming' => ['slug' => 'practically', 'name' => 'Practicality'],
        'aesthetic-appreciation' => ['slug' => 'practical-aesthetics', 'name' => 'Practical Aesthetics'],
        'feeling-aware' => ['slug' => 'measured-emotionality', 'name' => 'Measured Emotionality'],
        'explorer' => ['slug' => 'consistent-reliability', 'name' => 'Consistent Reliability'],
        'innovation' => ['slug' => 'realistic-pragmatism', 'name' => 'Realistic Pragmatism'],
        'open-mindedness' => ['slug' => 'traditional-values', 'name' => 'Traditional Values'],
        'self-confidence' => ['slug' => 'humble-capability', 'name' => 'Humble Capability'],
        'tidiness' => ['slug' => 'flexibility', 'name' => 'Flexibility'],
        'responsibility' => ['slug' => 'autonomy', 'name' => 'Autonomy'],
        'drive-to-achieve' => ['slug' => 'contentment', 'name' => 'Contentment'],
        'willpower' => ['slug' => 'spontaneity', 'name' => 'Spontaneity'],
        'careful-thinking' => ['slug' => 'impulsiveness', 'name' => 'Impulsiveness'],
        'sociability' => ['slug' => 'reservedness', 'name' => 'Reservedness'],
        'crowd-enjoyment' => ['slug' => 'independence', 'name' => 'Independence'],
        'confidence' => ['slug' => 'humility', 'name' => 'Humility'],
        'energetic-lifestyle' => ['slug' => 'calmness', 'name' => 'Calmness'],
        'thrill-seeking' => ['slug' => 'risk-aversion', 'name' => 'Risk Aversion'],
        'optimism' => ['slug' => 'composed-outlook', 'name' => 'Composed Outlook'],
        'belief' => ['slug' => 'skepticism', 'name' => 'Skepticism'],
        'honesty' => ['slug' => 'tactfulness', 'name' => 'Tactfulness'],
        'helpfulness' => ['slug' => 'self-reliance', 'name' => 'Self-Reliance'],
        'diplomacy' => ['slug' => 'self-assuredness', 'name' => 'Self-Assuredness'],
        'humility' => ['slug' => 'self-belief', 'name' => 'Self-Belief'],
        'compassion' => ['slug' => 'tough-mindedness', 'name' => 'Tough-Mindedness'],
        'steadiness' => ['slug' => 'stress-sensitivity', 'name' => 'Stress Sensitivity'],
        'tolerance' => ['slug' => 'irritability', 'name' => 'Irritability'],
        'positivity' => ['slug' => 'discouragement', 'name' => 'Discouragement'],
        'social-sensitivity' => ['slug' => 'self-doubt', 'name' => 'Self-Doubt'],
        'impulse-control' => ['slug' => 'rashness', 'name' => 'Rashness'],
        'stress-response' => ['slug' => 'stress-prone', 'name' => 'Stress Prone'],
    ],
    'icon_based_on_levels' => [
        0 => '',
        1 => '',
        2 => '',
        3 => '',
        4 => '',
        5 => '',

    ],
    'ccs_class_based_on_levels' => [
       0 => 'spring',
       1 => 'green',
       2 => 'cyan',
       3 => 'purple'
    ],

    'ccs_badge_color_class_based_on_levels' => [
        0 => 'color-yellow',
        1 => 'orange-basic',
        2 => 'Intermediate-critical',
        3 => 'advance-higly-aligned',
    ],

    'other_class_based_on_levels' => [
       0 => 'purple-high',
       1 => 'purple-high',
       2 => 'purple',
       3 => 'green',
       4 => 'cyan',
       5 => 'cyan-high'
    ],
    
    // 'rci_class_based_on_levels' => [
    //     0 => '#fc6759',
    //     1 => '#E39B00',
    //     2 => '#2AA443',
    // ],
    'rci_class_based_on_levels' => [
        0 => '#FFAE00',
        1 => '#2AA443',
        2 => '#2AA443',
    ],
    'rci_class_based_on_levelss' => [
        0 => 'circle-orange',
        1 => 'circle-green',
        2 => 'circle-green',
    ],
    'icon_class_levels' => [
        0 => '',
        1 => '/admin/media/svg/org-chart-svg/double-chevron-down-red.svg',
        2 => '/admin/media/svg/org-chart-svg/single-chevron-down-red.svg',
        3 => '/admin/media/svg/org-chart-svg/moderate-rotate-icon-yellow.svg',
        4 => '/admin/media/svg/org-chart-svg/single-chevron-up-green.svg',
        5 => '/admin/media/svg/org-chart-svg/double-chevron-up-green.svg'
    ],
        'organizational_fit_forecast_levels' => [
        0 => 'N/A',
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],
    'icon_class_levels_opposite' => [
        0 => '',
        1 => '/admin/media/svg/org-chart-svg/double-chevron-down-green.svg',
        2 => '/admin/media/svg/org-chart-svg/single-chevron-down-green.svg',
        3 => '/admin/media/svg/org-chart-svg/moderate-rotate-icon-yellow.svg',
        4 => '/admin/media/svg/org-chart-svg/single-chevron-up-red.svg',
        5 => '/admin/media/svg/org-chart-svg/double-chevron-up-red.svg'
    ],
    'cognitive_ability_rates' => [
        0 => "0px",
        1 => "100px",
        2 => "250px",
        3 => "380px"
    ],
    'cognitive_ability_badges' => [
        0 => 'moderate-badge',
        1 => 'low-badge',
        2 => 'moderate-badge',
        3 => 'high-badge'
    ],
    'talent_insight_positive_levels_class' => [
        0 => 'na',
        1 => 'low',
        2 => 'low',
        3 => 'moderate',
        4 => 'high',
        5 => 'high'
    ],
    'talent_insight_positive_3_levels_class' => [
        0 => 'na',
        1 => 'low',
        2 => 'moderate',
        3 => 'high'
    ],
    'talent_insight_positive_3_levels_class_rci' => [
        -1 => 'na',
        0 => 'moderate',
        1 => 'high',
        2 => 'high'
    ],
    'talent_insight_negative_levels_class' => [
        0 => 'na',
        1 => 'high',
        2 => 'high',
        3 => 'moderate',
        4 => 'low',
        5 => 'low'
    ],
    'talent_insight_9_grid' => [
        1 => ['bfr' => [4,5], 'performance_rating' => 1, 'final_result' => 'Key Prospect'],
        2 => ['bfr' => [4,5], 'performance_rating' => 2, 'final_result' => 'High Prospect'],
        3 => ['bfr' => [4,5], 'performance_rating' => 3, 'final_result' => 'Star'],
        4 => ['bfr' => [3], 'performance_rating' => 1, 'final_result' => 'Inconsistent Player'],
        5 => ['bfr' => [3], 'performance_rating' => 2, 'final_result' => 'Core Player'],
        6 => ['bfr' => [3], 'performance_rating' => 3, 'final_result' => 'High Performer'],
        7 => ['bfr' => [1,2], 'performance_rating' => 1, 'final_result' => 'Risk'],
        8 => ['bfr' => [1,2], 'performance_rating' => 2, 'final_result' => 'Average Performer'],
        9 => ['bfr' => [1,2], 'performance_rating' => 3, 'final_result' => 'Solid Performer']
    ],
    'employee_detail_level_class' => [
        0 => 'spring',
        1 => 'orange',
        2 => 'orange',
        3 => 'cyan',
        4 => 'purple',
        5 => 'purple'
    ],
    'employee_detail_positive_3_levels_class' => [
        0 => 'spring',
        1 => 'orange',
        2 => 'cyan',
        3 => 'purple'
    ],

    'constants' => [
        'name' => 'EEI Corporation',
        'country' => 'Philippines'
    ],

    'advanced_comparison_report_options' => [
        1 => 'OCEAN Domains',
        2 => '30 Facets - Openness to Experience',
        3 => '30 Facets - Conscientiousness',
        4 => '30 Facets - Extraversion',
        5 => '30 Facets - Agreeableness',
        6 => '30 Facets - Emotional Stability',
        7 => 'RIASEC',
        8 => 'Cognitive Ability'
    ],

    'ocean_summary_descriptors_admin' => [
        'openness-to-experience' => [
            1 => 'Low Openness (O) indicates that the employee excels in structured, predictable environments and bring a strong sense of practicality and focus to their work. They excel at maintaining consistency, refining processes, and ensuring high-quality outcomes. By creating a supportive environment that values their practical strengths and introducing changes thoughtfully, organizations can fully leverage their potential for success.',
            2 => 'Low Openness (O) indicates that the employee excels in structured, predictable environments and bring a strong sense of practicality and focus to their work. They excel at maintaining consistency, refining processes, and ensuring high-quality outcomes. By creating a supportive environment that values their practical strengths and introducing changes thoughtfully, organizations can fully leverage their potential for success.',
            3 => '',
            4 => 'High Openness (O) indicates that the employee is highly creative, curious, and open to new ideas, thriving in environments that encourage innovation and exploration. They bring fresh perspectives and excel in roles requiring adaptability and visionary thinking.',
            5 => 'High Openness (O) indicates that the employee is highly creative, curious, and open to new ideas, thriving in environments that encourage innovation and exploration. They bring fresh perspectives and excel in roles requiring adaptability and visionary thinking.',
        ],

        'conscientiousness' => [
            1 => 'Low Conscientiousness ( C ) indicates that the employee is adaptable, spontaneous, and flexible in their approach to work. They thrive in dynamic environments where creativity, quick thinking, and responsiveness are valued over rigid structures or strict planning. By providing support for prioritization, leveraging their spontaneity, and encouraging collaboration, organizations can maximize their contributions to team success.',
            2 => 'Low Conscientiousness ( C ) indicates that the employee is adaptable, spontaneous, and flexible in their approach to work. They thrive in dynamic environments where creativity, quick thinking, and responsiveness are valued over rigid structures or strict planning. By providing support for prioritization, leveraging their spontaneity, and encouraging collaboration, organizations can maximize their contributions to team success.',
            3 => '',
            4 => 'High Conscientiousness (C) indicates that the employee is highly organized, disciplined, and dependable. They excel at planning, meeting deadlines, and following structured processes, making them reliable in executing tasks with precision and consistency.',
            5 => 'High Conscientiousness (C) indicates that the employee is highly organized, disciplined, and dependable. They excel at planning, meeting deadlines, and following structured processes, making them reliable in executing tasks with precision and consistency.',
        ],

        'extraversion' => [
            1 => 'Low Extraversion (E) indicates that the employee is introvert, excel in environments that value focus, reflection, and independent work. They are thoughtful, introspective, and prefer meaningful one-on-one interactions over large social gatherings or high-energy group settings.',
            2 => 'Low Extraversion (E) indicates that the employee is introvert, excel in environments that value focus, reflection, and independent work. They are thoughtful, introspective, and prefer meaningful one-on-one interactions over large social gatherings or high-energy group settings.',
            3 => '',
            4 => 'High Extraversion (E) indicates that the employee is outgoing, energetic, and thrives in social settings. They enjoy engaging with others, building relationships, and working in collaborative environments.',
            5 => 'High Extraversion (E) indicates that the employee is outgoing, energetic, and thrives in social settings. They enjoy engaging with others, building relationships, and working in collaborative environments.',
        ],

        'agreeableness' => [
            1 => 'Low Agreeableness (A) indicates that the employee is assertive, independent, and objective in their approach. They focus on achieving goals and making decisions based on logic and critical analysis rather than prioritizing harmony or consensus. By creating an environment that values their directness and objectivity while fostering collaborative opportunities, organizations can maximize their impact and drive success.',
            2 => 'Low Agreeableness (A) indicates that the employee is assertive, independent, and objective in their approach. They focus on achieving goals and making decisions based on logic and critical analysis rather than prioritizing harmony or consensus. By creating an environment that values their directness and objectivity while fostering collaborative opportunities, organizations can maximize their impact and drive success.',
            3 => '',
            4 => 'High Agreeableness (A) indicates that the employee is kind, cooperative, and focused on maintaining positive relationships. They value teamwork, harmony, and helping others, making them approachable and empathetic.',
            5 => 'High Agreeableness (A) indicates that the employee is kind, cooperative, and focused on maintaining positive relationships. They value teamwork, harmony, and helping others, making them approachable and empathetic.',
        ],

        'emotional-stability' => [
            1 => 'Low Emotional Stability (ES) indicates that the employee is deeply attuned to their emotions and sensitive to their surroundings, which allows them to identify potential risks and areas of concern that others might overlook. They value stability and prefer to approach situations cautiously, ensuring careful consideration of outcomes. By leveraging their strengths in leadership, crisis management, and team support, organizations can enhance stability and drive success.',
            2 => 'Low Emotional Stability (ES) indicates that the employee is deeply attuned to their emotions and sensitive to their surroundings, which allows them to identify potential risks and areas of concern that others might overlook. They value stability and prefer to approach situations cautiously, ensuring careful consideration of outcomes. By leveraging their strengths in leadership, crisis management, and team support, organizations can enhance stability and drive success.',
            3 => '',
            4 => 'High Emotional Stability (ES) indicates that the employee is emotionally stable, calm, and resilient. They maintain a positive and composed demeanor, even in high-pressure situations, making them dependable in managing stress and navigating challenges.',
            5 => 'High Emotional Stability (ES) indicates that the employee is emotionally stable, calm, and resilient. They maintain a positive and composed demeanor, even in high-pressure situations, making them dependable in managing stress and navigating challenges.',
        ]

    ],
    'ocean_summary_descriptors_employee' => [
        'openness-to-experience' => [
            1 => 'Low Openness (O) indicate that you prefer routine, practicality, and established methods over novelty or abstract thinking. You are likely to value tradition and clarity, favoring proven approaches over experimentation or untested ideas.',
            2 => 'Low Openness (O) indicate that you prefer routine, practicality, and established methods over novelty or abstract thinking. You are likely to value tradition and clarity, favoring proven approaches over experimentation or untested ideas.',
            3 => '',
            4 => 'High Openness (O) indicate that you are highly creative, curious, and open to new ideas, thriving in environments that encourage innovation and exploration. You bring fresh perspectives and excel in roles that require adaptability and visionary thinking.',
            5 => 'High Openness (O) indicate that you are highly creative, curious, and open to new ideas, thriving in environments that encourage innovation and exploration. You bring fresh perspectives and excel in roles that require adaptability and visionary thinking.',
        ],

        'conscientiousness' => [
            1 => 'Low Conscientiousness (C) indicate that you prefer flexibility over rigid structures, enabling you to approach tasks with spontaneity and embrace dynamic, evolving situations',
            2 => 'Low Conscientiousness (C) indicate that you prefer flexibility over rigid structures, enabling you to approach tasks with spontaneity and embrace dynamic, evolving situations',
            3 => '',
            4 => 'High Conscientiousness (C) indicate that you are highly organized, disciplined, and dependable. You excel at planning, meeting deadlines, and following structured processes, making you reliable in executing tasks with precision and consistency.',
            5 => 'High Conscientiousness (C) indicate that you are highly organized, disciplined, and dependable. You excel at planning, meeting deadlines, and following structured processes, making you reliable in executing tasks with precision and consistency.',
        ],

        'extraversion' => [
            1 => 'Low Extraversion (E) indicate that you are more reserved and prefer working independently or in quieter settings rather than seeking out social interactions or high-energy environments.',
            2 => 'Low Extraversion (E) indicate that you are more reserved and prefer working independently or in quieter settings rather than seeking out social interactions or high-energy environments.',
            3 => '',
            4 => 'High Extraversion (E) indicate that you are outgoing, energetic, and thrive in social settings. You enjoy engaging with others, building relationships, and working in collaborative environments.',
            5 => 'High Extraversion (E) indicate that you are outgoing, energetic, and thrive in social settings. You enjoy engaging with others, building relationships, and working in collaborative environments.',
        ],

        'agreeableness' => [
            1 => 'Low Agreeableness (A) indicate that you are more independent and skeptical, often challenging ideas and prioritizing logic and objectivity over consensus. This makes you assertive and driven in pursuing your goals.',
            2 => 'Low Agreeableness (A) indicate that you are more independent and skeptical, often challenging ideas and prioritizing logic and objectivity over consensus. This makes you assertive and driven in pursuing your goals.',
            3 => '',
            4 => 'High Agreeableness (A) indicate that you are kind, cooperative, and focused on maintaining positive relationships. You value teamwork, harmony, and helping others, making you approachable and empathetic.',
            5 => 'High Agreeableness (A) indicate that you are kind, cooperative, and focused on maintaining positive relationships. You value teamwork, harmony, and helping others, making you approachable and empathetic.',
        ],

        'emotional-stability' => [
            1 => 'Low Emotional Stability (ES) indicate that you are deeply attuned to your emotions and sensitive to your surroundings, which allows you to identify potential risks and areas of concern that others might overlook. You value stability and prefer to approach situations cautiously, ensuring careful consideration of outcomes.',
            2 => 'Low Emotional Stability (ES) indicate that you are deeply attuned to your emotions and sensitive to your surroundings, which allows you to identify potential risks and areas of concern that others might overlook. You value stability and prefer to approach situations cautiously, ensuring careful consideration of outcomes.',
            3 => '',
            4 => 'High Emotional Stability (ES) indicate that you are emotionally stable, calm under pressure, and resilient in the face of challenges, allowing you to remain focused and composed even in high-stress situations.',
            5 => 'High Emotional Stability (ES) indicate that you are emotionally stable, calm under pressure, and resilient in the face of challenges, allowing you to remain focused and composed even in high-stress situations.',
        ]
    ],

    'panel_names' => [
        'eight8_prod' => 'eight8',
        'eight8_uat' => 'eight8_uat',
        'eight8_dev' => 'eight8_dev',
        'eei_prod' => 'eei',
        'eei_uat' => 'eei_uat',
        'eei_dev' => 'eei_dev',
        'jc_prod' => 'jc',
        'jc_uat' => 'jc_uat',
        'jc_dev' => 'jc_dev',
        'airasia_prod' => 'airasia',
        'airasia_uat' => 'airasia_uat',
        'airasia_dev' => 'airasia_dev',
        'base_prod' => 'base',
        'base_uat' => 'base_uat',
        'base_dev' => 'base_dev',
        'base_ph_prod' => 'base_ph',
        'base_ph_uat' => 'base_ph_uat',
        'base_ph_dev' => 'base_ph_dev',
        'jgs_olefins_dev' => 'jgs_olefins_dev',
        'aboitiz_food_dev' => 'aboitiz_food_dev',
        'viventis' => 'viventis'
    ],

    'employment_type' => [
        'full_time' => 1,
        'part_time' => 2,
        'contract' => 3,
        'freelance' => 4,
        'internship' => 5
    ],

    'job_location_type' => [
        'remote' => 'remote',
        'onsite' => 'onsite', 
        'hybrid' => 'hybrid'
    ],

    'status_of_job' => [
        1 => 'Ready',
        2 => 'Active',
        3 => 'Expired',
        4 => 'Filled',
        5 => 'Draft'
    ],

    'education_level' => [
        1 => 'Ph.D.',
        2 => 'Master',
        3 => 'Bachelor',
        4 => 'Diploma',
        5 => 'High School'
    ],

    'suitability_criteria' => [
        1 => 'Education Program',
        2 => 'Education Level',
        3 => 'Expected Salary',
        4 => 'Work Experience'
    ],

    'steps_completed' => [
        1 => 'Vacancy',
        2 => 'Job Details',
        3 => 'Job Qualifications',
        4 => 'Job Skills',
        5 => 'Other Details',
        6 => 'Hiring Workflow',
        7 => 'Review Details',
        8 => 'Posting Review'
    ],

    'country_code' => [
        "+93" => "Afghanistan (+93)",
        "+355" => "Albania (+355)",
        "+213" => "Algeria (+213)",
        "+376" => "Andorra (+376)",
        "+244" => "Angola (+244)",
        "+1-268" => "Antigua and Barbuda (+1-268)",
        "+54" => "Argentina (+54)",
        "+374" => "Armenia (+374)",
        "+61" => "Australia (+61)",
        "+43" => "Austria (+43)",
        "+994" => "Azerbaijan (+994)",
        "+1-242" => "Bahamas (+1-242)",
        "+973" => "Bahrain (+973)",
        "+880" => "Bangladesh (+880)",
        "+1-246" => "Barbados (+1-246)",
        "+375" => "Belarus (+375)",
        "+32" => "Belgium (+32)",
        "+501" => "Belize (+501)",
        "+229" => "Benin (+229)",
        "+975" => "Bhutan (+975)",
        "+591" => "Bolivia (+591)",
        "+387" => "Bosnia and Herzegovina (+387)",
        "+267" => "Botswana (+267)",
        "+55" => "Brazil (+55)",
        "+673" => "Brunei (+673)",
        "+359" => "Bulgaria (+359)",
        "+226" => "Burkina Faso (+226)",
        "+257" => "Burundi (+257)",
        "+855" => "Cambodia (+855)",
        "+237" => "Cameroon (+237)",
        "+1" => "Canada (+1)",
        "+238" => "Cape Verde (+238)",
        "+236" => "Central African Republic (+236)",
        "+235" => "Chad (+235)",
        "+56" => "Chile (+56)",
        "+86" => "China (+86)",
        "+57" => "Colombia (+57)",
        "+269" => "Comoros (+269)",
        "+242" => "Congo (+242)",
        "+506" => "Costa Rica (+506)",
        "+385" => "Croatia (+385)",
        "+53" => "Cuba (+53)",
        "+357" => "Cyprus (+357)",
        "+420" => "Czech Republic (+420)",
        "+45" => "Denmark (+45)",
        "+253" => "Djibouti (+253)",
        "+1-767" => "Dominica (+1-767)",
        "+1-809" => "Dominican Republic (+1-809)",
        "+593" => "Ecuador (+593)",
        "+20" => "Egypt (+20)",
        "+503" => "El Salvador (+503)",
        "+240" => "Equatorial Guinea (+240)",
        "+291" => "Eritrea (+291)",
        "+372" => "Estonia (+372)",
        "+251" => "Ethiopia (+251)",
        "+679" => "Fiji (+679)",
        "+358" => "Finland (+358)",
        "+33" => "France (+33)",
        "+995" => "Georgia (+995)",
        "+49" => "Germany (+49)",
        "+233" => "Ghana (+233)",
        "+30" => "Greece (+30)",
        "+1-473" => "Grenada (+1-473)",
        "+502" => "Guatemala (+502)",
        "+224" => "Guinea (+224)",
        "+245" => "Guinea-Bissau (+245)",
        "+592" => "Guyana (+592)",
        "+509" => "Haiti (+509)",
        "+504" => "Honduras (+504)",
        "+852" => "Hong Kong (+852)",
        "+36" => "Hungary (+36)",
        "+354" => "Iceland (+354)",
        "+91" => "India (+91)",
        "+62" => "Indonesia (+62)",
        "+98" => "Iran (+98)",
        "+964" => "Iraq (+964)",
        "+353" => "Ireland (+353)",
        "+972" => "Israel (+972)",
        "+39" => "Italy (+39)",
        "+1-876" => "Jamaica (+1-876)",
        "+81" => "Japan (+81)",
        "+962" => "Jordan (+962)",
        "+7" => "Kazakhstan (+7)",
        "+254" => "Kenya (+254)",
        "+965" => "Kuwait (+965)",
        "+996" => "Kyrgyzstan (+996)",
        "+856" => "Laos (+856)",
        "+371" => "Latvia (+371)",
        "+961" => "Lebanon (+961)",
        "+231" => "Liberia (+231)",
        "+218" => "Libya (+218)",
        "+423" => "Liechtenstein (+423)",
        "+370" => "Lithuania (+370)",
        "+352" => "Luxembourg (+352)",
        "+853" => "Macau (+853)",
        "+389" => "Macedonia (+389)",
        "+261" => "Madagascar (+261)",
        "+60" => "Malaysia (+60)",
        "+960" => "Maldives (+960)",
        "+223" => "Mali (+223)",
        "+356" => "Malta (+356)",
        "+52" => "Mexico (+52)",
        "+373" => "Moldova (+373)",
        "+377" => "Monaco (+377)",
        "+976" => "Mongolia (+976)",
        "+382" => "Montenegro (+382)",
        "+212" => "Morocco (+212)",
        "+258" => "Mozambique (+258)",
        "+95" => "Myanmar (+95)",
        "+264" => "Namibia (+264)",
        "+977" => "Nepal (+977)",
        "+31" => "Netherlands (+31)",
        "+64" => "New Zealand (+64)",
        "+505" => "Nicaragua (+505)",
        "+227" => "Niger (+227)",
        "+234" => "Nigeria (+234)",
        "+47" => "Norway (+47)",
        "+968" => "Oman (+968)",
        "+92" => "Pakistan (+92)",
        "+507" => "Panama (+507)",
        "+51" => "Peru (+51)",
        "+63" => "Philippines (+63)",
        "+48" => "Poland (+48)",
        "+351" => "Portugal (+351)",
        "+974" => "Qatar (+974)",
        "+40" => "Romania (+40)",
        "+7" => "Russia (+7)",
        "+250" => "Rwanda (+250)",
        "+966" => "Saudi Arabia (+966)",
        "+221" => "Senegal (+221)",
        "+65" => "Singapore (+65)",
        "+421" => "Slovakia (+421)",
        "+386" => "Slovenia (+386)",
        "+27" => "South Africa (+27)",
        "+82" => "South Korea (+82)",
        "+34" => "Spain (+34)",
        "+94" => "Sri Lanka (+94)",
        "+249" => "Sudan (+249)",
        "+46" => "Sweden (+46)",
        "+41" => "Switzerland (+41)",
        "+963" => "Syria (+963)",
        "+66" => "Thailand (+66)",
        "+90" => "Turkey (+90)",
        "+380" => "Ukraine (+380)",
        "+971" => "United Arab Emirates (+971)",
        "+44" => "United Kingdom (+44)",
        "+1" => "United States (+1)",
        "+84" => "Vietnam (+84)",
        "+967" => "Yemen (+967)",
        "+260" => "Zambia (+260)",
        "+263" => "Zimbabwe (+263)"
    ],
    
    'work_experience' => [
        0=>'No Experience',
        1=>'Less than 1 Year',
        2=>'1-2 Years',
        3=>'3-5 Years',
        4=>'6-8 Years',
        5=>'9-10 Years',
        6=> 'More than 10 Years'
    ],

    ['company_id' => 3],

    'applicant_details_positive_levels_class' => [
        0 => 'moderate',
        1 => 'low',
        2 => 'low',
        3 => 'moderate',
        4 => 'high',
        5 => 'high'
    ],

    'applicant_details_classifications' => [
        0 => 'N / A',
        1 => 'Very Low',
        2 => 'Low',
        3 => 'Moderate',
        4 => 'High',
        5 => 'Very High'
    ],

    'applicant_details_icon_class_levels' => [
        0 => '',
        1 => 'tdesign:forward-filled',
        2 => 'mdi:triangle-down',
        3 => 'mdi:square',
        4 => 'mdi:triangle',
        5 => 'tdesign:forward-filled',
        // 5 => 'mdi:circle',
    ],

    'applicant_details_icon_class_levels_opposite' => [
        0 => '',
        1 => 'tdesign:forward-filled',
        2 => 'mdi:triangle',
        3 => 'mdi:square',
        4 => 'mdi:triangle-down',
        5 => 'tdesign:forward-filled',
        // 5 => 'mdi:circle',
    ],

    'applicant_details_icon_color_levels' => [
        0 => 'moderate-icon',
        1 => 'rotate-minus-90-red',
        2 => 'red-icon-color',
        3 => 'moderate-icon',
        4 => 'green-icon-color',
        5 => 'rotate-90-green',
    ],
 
    'applicant_details_icon_color_levels_opposite' => [
        0 => 'moderate-icon',
        1 => 'rotate-minus-90-green',
        2 => 'green-icon-color',
        3 => 'moderate-icon',
        4 => 'red-icon-color',
        5 => 'rotate-90-red',
    ],

    'applicant_details_circle_content_class' => [
        0 => 'circle-moderate',
        1 => 'circle-low',
        2 => 'circle-low',
        3 => 'circle-moderate',
        4 => 'circle-high',
        5 => 'circle-high',
    ],

    'applicant_details_circle_color_class' => [
        0 => 'color-moderate',
        1 => 'color-low',
        2 => 'color-low',
        3 => 'color-moderate',
        4 => 'color-high',
        5 => 'color-high',
    ],

    'applicant_details_ocean_badge_percentile_color_class' => [
        0 => 'yellow',
        1 => 'green',
        2 => 'cyan',
        3 => 'purple',
        4 => 'green',
        5 => 'green',
    ],

    'applicant_details_ocean_badge_color_class' => [
        0 => 'color-yellow',
        1 => 'green',
        2 => 'cyan',
        3 => 'color-purple',
        4 => 'color-green',
        5 => 'color-green',
    ],

    'applicant_details_positive_3_levels_class' => [
        0 => 'color-yellow',
        1 => 'color-yellow',
        2 => 'color-cyan',
        3 => 'color-purple'
    ],

    'applicant_details_positive_3_levels_color_class' => [
        0 => 'yellow',
        1 => 'yellow',
        2 => 'purple',
        3 => 'purple-high'
    ],

    'ccs_alignment_levels' => [
        0 => 'N/A',
        1 => 'Needs Development',
        2 => 'Aligned',
        3 => 'Highly Aligned'
    ],

    'work_authorization' => [
        0 => 'No',
        1 => 'Yes'
    ],

    'selection_matrix' => [
        1  => ['omr' => 5, 'interview_performance' => 1, 'final_result' => 'Review', 'final_result_level' => 2],
        2  => ['omr' => 5, 'interview_performance' => 2, 'final_result' => 'Consider Further', 'final_result_level' => 3],
        3  => ['omr' => 5, 'interview_performance' => 3, 'final_result' => 'Consider Further', 'final_result_level' => 3],
        4  => ['omr' => 5, 'interview_performance' => 4, 'final_result' => 'Hire', 'final_result_level' => 4],
        5  => ['omr' => 5, 'interview_performance' => 5, 'final_result' => 'Hire', 'final_result_level' => 4],

        6  => ['omr' => 4, 'interview_performance' => 1, 'final_result' => 'Review', 'final_result_level' => 2],
        7  => ['omr' => 4, 'interview_performance' => 2, 'final_result' => 'Review', 'final_result_level' => 2],
        8  => ['omr' => 4, 'interview_performance' => 3, 'final_result' => 'Consider Further', 'final_result_level' => 3],
        9  => ['omr' => 4, 'interview_performance' => 4, 'final_result' => 'Consider Further', 'final_result_level' => 3],
        10 => ['omr' => 4, 'interview_performance' => 5, 'final_result' => 'Hire', 'final_result_level' => 4],

        11 => ['omr' => 3, 'interview_performance' => 1, 'final_result' => 'Reject', 'final_result_level' => 1],
        12 => ['omr' => 3, 'interview_performance' => 2, 'final_result' => 'Review', 'final_result_level' => 2],
        13 => ['omr' => 3, 'interview_performance' => 3, 'final_result' => 'Review', 'final_result_level' => 2],
        14 => ['omr' => 3, 'interview_performance' => 4, 'final_result' => 'Consider Further', 'final_result_level' => 3],
        15 => ['omr' => 3, 'interview_performance' => 5, 'final_result' => 'Consider Further', 'final_result_level' => 3],

        16 => ['omr' => 2, 'interview_performance' => 1, 'final_result' => 'Reject', 'final_result_level' => 1],
        17 => ['omr' => 2, 'interview_performance' => 2, 'final_result' => 'Reject', 'final_result_level' => 1],
        18 => ['omr' => 2, 'interview_performance' => 3, 'final_result' => 'Review', 'final_result_level' => 2],
        19 => ['omr' => 2, 'interview_performance' => 4, 'final_result' => 'Review', 'final_result_level' => 2],
        20 => ['omr' => 2, 'interview_performance' => 5, 'final_result' => 'Consider Further', 'final_result_level' => 3],

        21 => ['omr' => 1, 'interview_performance' => 1, 'final_result' => 'Reject', 'final_result_level' => 1],
        22 => ['omr' => 1, 'interview_performance' => 2, 'final_result' => 'Reject', 'final_result_level' => 1],
        23 => ['omr' => 1, 'interview_performance' => 3, 'final_result' => 'Reject', 'final_result_level' => 1],
        24 => ['omr' => 1, 'interview_performance' => 4, 'final_result' => 'Review', 'final_result_level' => 2],
        25 => ['omr' => 1, 'interview_performance' => 5, 'final_result' => 'Review', 'final_result_level' => 2],
    ],

    'selection_matrix_levels' => [
        0 => 'N/A',
        1 => 'Reject',
        2 => 'Review',
        3 => 'Consider Further',
        4 => 'Hire'
    ],
    // First key [1D] is omr and second key [2D] is interview performance
    'selection_matrix_level_conversion' => [
            0 => [
                0 => 0,
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
            ],
            1 => [
                0 => 0,
                1 => 1,
                2 => 1,
                3 => 1,
                4 => 2,
                5 => 2,
            ],
            2 => [
                0 => 0,
                1 => 1,
                2 => 1,
                3 => 2,
                4 => 2,
                5 => 3,
            ],
            3 => [
                0 => 0,
                1 => 1,
                2 => 2,
                3 => 2,
                4 => 3,
                5 => 3,
            ],
            4 => [
                0 => 0,
                1 => 2,
                2 => 2,
                3 => 3,
                4 => 3,
                5 => 4,
            ],
            5 => [
                0 => 0,
                1 => 2,
                2 => 3,
                3 => 3,
                4 => 4,
                5 => 4,
            ],
        ],

    'all_applicant_fields' => [
        ['id' => 'employee','info_icon'=>'false','info_description'=>'','show'=>'false','filter_key'=>'employeeCounts','label' => 'Applicant','list' => ['all-applicants'=>[ 'all' => 1,'withdraw' => 0,'rejected' => 2],'hiring-pipeline'=>['Applied' => 1,

    'Assessment Link Sent' => 2,
    'Assessment Pending' => 3,
    'Assessment Completed' => 4,
    'Shortlisted' => 5,
    'Interview Scheduled' => 6,
    'Interview Completed' => 7,
    'Offered' => 8,
    'Offer Accepted' => 9,
    'Offer Declined' => 10,
    'Offer Expired' => 11,
    'Hired' => 12]]],
        ['id' => 'lastHiringStatus','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'lastStatusCounts','label' => 'Last Hiring Status','list' => ['all-applicants'=>[ 'rejected' => 2],'hiring-pipeline'=>[]]],
        ['id' => 'hiringStatus','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'statusCounts','label' => 'Hiring Status','list' => ['all-applicants'=>[ 'all' => 1],'hiring-pipeline'=>['Offered' => 8]]],
        ['id' => 'interviewTimeColumn','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'interviewTimeCounts','label' => 'Interview Time','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Interview Scheduled' => 6]]],
        ['id' => 'currentLocation','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'currentLocationCounts','label' => 'Current Location','list' => ['all-applicants'=>[ 'all' => 1,'withdraw' => 0,'rejected' => 2],'hiring-pipeline'=>['Applied' => 1,'Shortlisted' => 5,'Interview Scheduled' => 6,'Interview Completed' => 7,'Offered' => 8,'Hired' => 12]]],
        ['id' => 'nationality','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'countryCounts','label' => 'Nationality','list' => ['all-applicants'=>[ 'all' => 1,'withdraw' => 0,'rejected' => 2],'hiring-pipeline'=>['Applied' => 1,'Shortlisted' => 5,'Interview Scheduled' => 6,'Interview Completed' => 7,'Offered' => 8]]],
        ['id' => 'workAuthorisation','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'workAuthorisationCounts','label' => 'Work Authorisation','list' => ['all-applicants'=>[ 'all' => 1,'rejected' => 2],'hiring-pipeline'=>['Applied' => 1,'Shortlisted' => 5,'Interview Scheduled' => 6,'Interview Completed' => 7,'Offered' => 8,'Hired' => 12]]],
        ['id' => 'selectionMatrix','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'selectionMatrixCounts','label' => 'Selection Matrix','list' => ['all-applicants'=>[ 'all' => 1,'rejected' => 2],'hiring-pipeline'=>['Interview Completed' => 7,'Offered' => 8]]],
        ['id' => 'interviewPerformance','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'interviewPerformanceCounts','label' => 'Interview Performance','list' => ['all-applicants'=>[ 'all' => 1,'rejected' => 2],'hiring-pipeline'=>['Interview Completed' => 7,'Offered' => 8,'Hired' => 12]]],
        ['id' => 'omr', 'show'=>'true','info_icon'=>'true','info_description'=>'Overall Match Rate','filter_key'=>'omrLevelCounts','label' => 'OMR','list' => ['all-applicants'=>[],'hiring-pipeline'=>[]]],
        ['id' => 'suitabilityRate','info_icon'=>'true','info_description'=>'The suitability rate is based on the percentage of criteria specified in the job details. A higher percentage indicates better alignment with the job scope.','show'=>'true', 'filter_key'=>'suitabilityRateCounts','label' => 'Suitability Rate','list' => ['all-applicants'=>[ 'all' => 1,'withdraw' => 0,'rejected' => 2],'hiring-pipeline'=>['Applied' => 1,'Shortlisted' => 5,'Interview Scheduled' => 6,'Interview Completed' => 7,'Offered' => 8,'Hired' => 12]]],
        ['id' => 'workExperience','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'workExperienceCounts','label' => 'Work Experience','list' => ['all-applicants'=>[ 'all' => 1,'withdraw' => 0,'rejected' => 2],'hiring-pipeline'=>['Applied' => 1,'Shortlisted' => 5,'Interview Scheduled' => 6,'Interview Completed' => 7,'Offered' => 8,'Hired' => 12]]],
        ['id' => 'educationProgram','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'educationProgramCounts','label' => 'Education Program','list' => ['all-applicants'=>[ 'all' => 1,'withdraw' => 0,'rejected' => 2],'hiring-pipeline'=>['Applied' => 1,'Shortlisted' => 5,'Interview Scheduled' => 6,'Interview Completed' => 7,'Offered' => 8,'Hired' => 12]]],
        ['id' => 'educationLevel','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'educationLevelCounts','label' => 'Education Level','list' => ['all-applicants'=>[ 'all' => 1,'withdraw' => 0,'rejected' => 2],'hiring-pipeline'=>['Applied' => 1,'Shortlisted' => 5,'Interview Scheduled' => 6,'Interview Completed' => 7,'Offered' => 8,'Hired' => 12]]],
        ['id' => 'expectedSalary','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'expectedSalaryCounts','label' => 'Expected Monthly Salary (MYR)','list' => ['all-applicants'=>[ 'all' => 1,'withdraw' => 0,'rejected' => 2],'hiring-pipeline'=>['Applied' => 1,'Shortlisted' => 5,'Interview Scheduled' => 6,'Interview Completed' => 7,'Offered' => 8,'Hired' => 12]]],
        ['id' => 'oceanStatus','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'oceanStatusCounts','label' => 'OCEAN Status','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Pending' => 3]]],
        ['id' => 'riasecStatus','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'riasecStatusCounts','label' => 'RIASEC Status','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Pending' => 3]]],
        ['id' => 'cognitiveAssessmentStatus','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'cognitiveAssessmentStatusCounts','label' => 'Cognitive Status','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Pending' => 3]]],
        ['id' => 'technicalAssessmentStatus','info_icon'=>'false','info_description'=>'','show'=>'true', 'filter_key'=>'technicalAssessmentStatusCounts','label' => 'Technical Status','list' => ['all-applicants'=>[],'hiring-pipeline'=>[]]],
        ['id' => 'ta','info_icon'=>'true','info_description'=>'Technical Assessment','show'=>'true', 'filter_key'=>'taLevelCounts','label' => 'TA','list' => ['all-applicants'=>[],'hiring-pipeline'=>[]]],
        ['id' => 'bfr','info_icon'=>'true','info_description'=>'Behavior Fit Rate','show'=>'true', 'filter_key'=>'bfrLevelCounts','label' => 'BFR','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Completed' => 4]]],
        ['id' => 'ssmr','info_icon'=>'true','info_description'=>'Soft Skill Match Rate','show'=>'true', 'filter_key'=>'ssmrLevelCounts','label' => 'SSMR','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Completed' => 4]]],
        ['id' => 'jmr', 'info_icon'=>'true','info_description'=>'Job Match Rate','show'=>'true', 'filter_key'=>'jmrLevelCounts','label' => 'JMR','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Completed' => 4]]],
        ['id' => 'cat', 'info_icon'=>'true','info_description'=>'Cognitive Ability','show'=>'true', 'filter_key'=>'catLevelCounts','label' => 'CAT','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Completed' => 4]]],
        ['id' => 'gp', 'info_icon'=>'true','info_description'=>'Growth Potential','show'=>'true', 'filter_key'=>'gpLevelCounts','label' => 'GP','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Completed' => 4]]],
        ['id' => 'rci', 'info_icon'=>'true','info_description'=>'Response Consistency Index','show'=>'true', 'filter_key'=>'rciLevelCounts','label' => 'RCI','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Completed' => 4]]],
        ['id' => 'fr', 'info_icon'=>'true','info_description'=>'Flight Risk','show'=>'true', 'filter_key'=>'frLevelCounts','label' => 'FR','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Completed' => 4]]],
        ['id' => 'waf', 'info_icon'=>'true','info_description'=>'Organizational Fit Forecast','show'=>'true', 'filter_key'=>'wafLevelCounts','label' => 'WAF','list' => ['all-applicants'=>[],'hiring-pipeline'=>['Assessment Completed' => 4]]],
    ],
    'all_applicant_status' => [
        0 => 'withdraw',
        1 => 'applied',
        2 => 'rejected'
    ],
    'work_authorisation' => [
        1 => 'Yes',
        2 => 'No'
    ],
    'year_of_experience_in_it_sector' => [
        'None' => 'year_of_experience_in_it_sector IS NULL OR year_of_experience_in_it_sector = 0',
        'Less Than 1 Year' => 'year_of_experience_in_it_sector BETWEEN 1 AND 1',
        '1-2 Years' => 'year_of_experience_in_it_sector BETWEEN 1 AND 2',
        '3-5 Years' => 'year_of_experience_in_it_sector BETWEEN 3 AND 5',
        '6-8 Years' => 'year_of_experience_in_it_sector BETWEEN 6 AND 8',
        '9-10 Years' => 'year_of_experience_in_it_sector BETWEEN 9 AND 10',
        'More than 10 Years' => 'year_of_experience_in_it_sector > 10'
    ],
    'application_status_colors' => array(
       1 =>  'applied',
       2 =>  'dark-green',
       3 =>  'yellow',
       4 =>  'green',
       5 =>  'purple',
       6 =>  'teal',
       7 =>  'teal',
       8 =>  'green',
       9 =>  'green',
       10 => 'red',
       11 => 'red',
       12 => 'dark-green'
    ),

    'trait_facets' => [
        'Openness' => [
            'daydreaming', 'aesthetic-appreciation', 'feeling-aware',
            'explorer', 'innovation', 'open-mindedness',
        ],
        'Conscientiousness' => [
            'self-confidence', 'tidiness', 'responsibility',
            'drive-to-achieve', 'willpower', 'careful-thinking',
        ],
        'Extraversion' => [
            'sociability', 'crowd-enjoyment', 'confidence',
            'energetic-lifestyle', 'thrill-seeking', 'optimism',
        ],
        'Agreeableness' => [
            'belief', 'honesty', 'helpfulness',
            'diplomacy', 'humility', 'compassion',
        ],
        'Emotional Stability' => [
            'steadiness', 'tolerance', 'positivity',
            'social-sensitivity', 'impulse-control', 'stress-response',
        ],
    ],

    'bfr_percentage_level' => [
        'very_high' => ['min' => 98, 'max' => null],
        'high' => ['min' => 84, 'max' => 98],
        'moderate' => ['min' => 16, 'max' => 84],
        'low' => ['min' => 2, 'max' => 16],
        'very_low' => ['min' => null, 'max' => 2],
    ],
    'domain_colors' => array(
       'Very Low' => 'red',
       'Low' => 'red',
       'Moderate' => 'yellow',
       'High' => 'green',
       'Very High' => 'green',
       'Consistent' => 'green',
       'Fairly Consistent' => 'green',
       'Somewhat Consistent' => 'yellow',
       'Very Low Risk'=> 'green',
       'Low Risk' => 'green',
       'Moderate Risk' => 'yellow',
       'High Risk' => 'red',
       'Very High Risk' => 'red',
       'Reject' => 'red',
       'Hire' => 'green',
       'Consider Further' => 'yellow',
       'Review' => 'dark-orange',
       'N/A' => 'grey',
    ),

    'talent_insight_strategies' => [
        1 => 'High Potential Talent',
        2 => 'Low Potential Talent',
        3 => 'Stable Potential Talent',
        4 => 'Critical Risk Talent',
        5 => 'Stable Alignment Talent'
    ],

    'talent_insight_export_fields' => [
        'omr_level' => 'OMR',
        'bfr_level' => 'BFR',
        'ta_level' => 'TA',
        'tsmr_level' => 'TSMR',
        'ssmr_level' => 'SSMR',
        'jmr_level' => 'JMR',
        'cat_level' => 'CAT',
        'lp_level' => 'LP',
        'gp_level' => 'GP',
        'rci_level' => 'RCI',
        'fr_level' => 'FR',
        'waf_level' => 'WAF',
        
    ],

    'all_star_job_alignment' => [ 
        0 => [
            'title' => 'Needs Development',
            'class' => 'needs-development',
        ],
        1 => [
            'title' => 'Aligned',
            'class' => 'aligned',
        ],
        2 => [
            'title' => 'Highly Aligned',
            'class' => 'highly-aligned',
        ],
        3 => [
            'title' => 'Highly Aligned',
            'class' => 'highly-aligned',
        ]
    ],

    // Added configs during employee detail transfer

    'applicant_details_positive_levels_class_bfr' => [
        0 => 'na',
        1 => 'low',
        2 => 'low',
        3 => 'moderate',
        4 => 'high',
        5 => 'high'
    ],

    'employee_detail_level_class_bfr' => [
        0 => '#000000',
        1 => '#ef382f', // Light Red for "Very Low"
        2 => '#ef382f', // Red for "Low"
        3 => '#f5872c', // Yellow for "Moderate"
        4 => '#227735', // Light Green for "High"
        5 => '#227735' // Green for "Very High"
    ],

    'cognitive_ability_circle_class' => [
        0 => 'yellow-round',
        1 => 'yellow-round',
        2 => 'green-round',
        3 => 'blue-round'
    ],

    'cognitive_ability_levels_class' => [
        0 => 'cognitive-grey',
        1 => 'cognitive-orange',
        2 => 'cognitive-green',
        3 => 'cognitive-blue'
    ],

    'employee_detail_positive_3_text_color' => [
        0 => '#2AA443',
        1 => '#FFC549',
        2 => '#2AA443',
        3 => '#108585'
    ],

    'strategic_insight_potential_class' => [
        1 => 'low',
        2 => 'moderate',
        3 => 'high'
    ],

    'strategic_insight_alignment_class' => [
        1 => 'low',
        2 => 'moderate',
        3 => 'high'
    ]
];
