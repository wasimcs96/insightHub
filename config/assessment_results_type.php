<?php

return [
    'result_type' => [
        1 => ['assessmentType' => 'all', 'metric' => 'overall_match_rate'],
        2 => ['assessmentType' => 'all', 'metric' => 'soft_skill_score'],
        3 => ['assessmentType' => 'riasec', 'metric' => 'jmr'],
        4 => ['assessmentType' => 'ocean', 'metric' => 'ccs_match_rate'],
        5 => ['assessmentType' => 'ocean', 'metric' => 'growth_potential'],
        6 => ['assessmentType' => 'ocean', 'metric' => 'organizational_fit_forecast'],
        7 => ['assessmentType' => 'ocean', 'metric' => 'flight_risk'],
        8 => ['assessmentType' => 'cognitive', 'metric' => 'overall'],
        9 => ['assessmentType' => 'cognitive', 'metric' => 'technical_skill_match_rate'],
        10 => ['assessmentType' => 'ocean', 'metric' => 'leadership_potential'],

    ],
    'leves_type' => [
        1 => [
            'label' => 'Very High',
            'icon' => 'tdesign:forward-filled',
            'iconClass' => 'icon-green rotate-minus-90',
            'assessmentTypeIds' => [1, 2, 3, 4, 5, 9, 10],
            'value' => 5,
        ],
        2 => [
            'label' => 'High',
            'icon' => 'mdi:triangle',
            'iconClass' => 'icon-green',
            'assessmentTypeIds' => [1, 2, 3, 4, 5, 9, 10],
            'value' => 4,
            'conditionalValues' => [
                8 => 3, // For assessmentTypeId 8, High = 3
            ],
        ],
        3 => [
            'label' => 'Moderate',
            'icon' => 'material-symbols-light:square',
            'iconClass' => 'icon-yellow',
            'assessmentTypeIds' => [1, 2, 3, 4, 5, 8, 9, 10],
            'value' => 3,
            'conditionalValues' => [
                8 => 2, // For assessmentTypeId 8, Moderate = 2
            ],
        ],
        4 => [
            'label' => 'Low',
            'icon' => 'mdi:triangle-down',
            'iconClass' => 'icon-red',
            'assessmentTypeIds' => [1, 2, 3, 4, 5,9, 10],
            'value' => 2,
            'conditionalValues' => [
                8 => 1, // For assessmentTypeId 8, Low = 1
            ],
        ],
        5 => [
            'label' => 'Very Low',
            'icon' => 'tdesign:forward-filled',
            'iconClass' => 'icon-red rotate-90',
            'assessmentTypeIds' => [1, 2, 3, 4, 5,9, 10],
            'value' => 1,
        ],
        6 => [
            'label' => 'Very High Risk',
            'icon' => 'tdesign:forward-filled',
            'iconClass' => 'icon-red rotate-minus-90',
            'assessmentTypeIds' => [6, 7],
            'value' => 5,
        ],
        7 => [
            'label' => 'High Risk',
            'icon' => 'mdi:triangle',
            'iconClass' => 'icon-red',
            'assessmentTypeIds' => [6, 7],
            'value' => 4,
        ],
        8 => [
            'label' => 'Moderate Risk',
            'icon' => 'material-symbols-light:square',
            'iconClass' => 'icon-yellow',
            'assessmentTypeIds' => [6, 7],
            'value' => 3,
        ],
        9 => [
            'label' => 'Low Risk',
            'icon' => 'mdi:triangle-down',
            'iconClass' => 'icon-green',
            'assessmentTypeIds' => [6, 7],
            'value' => 2,
        ],
        10 => [
            'label' => 'Very Low Risk',
            'icon' => 'tdesign:forward-filled',
            'iconClass' => 'icon-green rotate-90',
            'assessmentTypeIds' => [6, 7],
            'value' => 1,
        ],
    ]
];
