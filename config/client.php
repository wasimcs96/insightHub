<?php

return [
    'base_ph_dev' => [
        'custom_header' => false,
        'ta_omr_required' => true,
        'admin_dashboard'=>false,
        'custom_org_menu'=>false,
        'employee_jd_tab'=>true


    ],
    'eei'=>[
        'custom_header' => false,
        'ta_omr_required' => true,
        'admin_dashboard'=>false,
        'custom_org_menu'=>true,
        'employee_jd_tab'=>true

    ],
    'jgs_olefins' => [
        'custom_header' => true,
        'ta_omr_required' => false,
        'admin_dashboard'=>true,
        'custom_org_menu'=>false,
        'employee_jd_tab'=>false



    ],
    'aboitiz_food' => [
        'custom_header' => true,
        'ta_omr_required' => false,
        'admin_dashboard'=>true,
        'custom_org_menu'=>false,
        'employee_jd_tab'=>true


    ],

    'omr_ta_not_required' => ['aboitiz_food_dev', 'jgs_olefins_dev', 'aboitiz_food_prod', 'jgs_olefins_prod', 'eight8_prod_copy']
];

// 



