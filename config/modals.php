<?php
return [
    'jobs' => [
        'add_new_profile' => [
            'title' => 'Add Job Position',
            'view' => 'modals.jobs.add_new_profile',
            'size' => 'lg',
            'type' => 'job',
            'header'=> true
        ],
        'jd_create_redirect' => [
            'title' => '',
            'view' => 'modals.jobs.jd_create_redirect',
            'size' => 'md',
            'type' => 'job',
            'header'=> false
        ],
        'job_headcount_list' => [
            'title' => '',
            'view' => 'modals.jobs.job_headcount_list',
            'size' => 'lg',
            'type' => 'job',
            'header'=> false
        ],
        'set_top_position' => [
            'title' => 'Set as Top Position in Org Chart',
            'view' => 'modals.jobs.set_top_position',
            'size' => 'md',
            'type' => 'job',
            'header'=> true
        ],
        'set_top_position_existing' => [
            'title' => 'Set as New Top Position in Org Chart',
            'view' => 'modals.jobs.set_top_position_existing',
            'size' => 'md',
            'type' => 'job',
            'header'=> true
        ],
        'clear_existing_input' => [
            'title' => '',
            'view' => 'modals.jobs.clear_existing_input',
            'size' => 'md',
            'type' => 'job',
            'header'=> false
        ],

        'delete_jd_employee_exist' => [
            'title' => '',
            'view' => 'modals.jobs.delete_jd_employee_exist',
            'size' => 'md',
            'type' => 'job',
            'header'=> false
        ],

        'delete_jd' => [
            'title' => '',
            'view' => 'modals.jobs.delete_jd',
            'size' => 'md',
            'type' => 'job',
            'header'=> false
        ],


        'approve_jd' => [
            'title' => '',
            'view' => 'modals.jobs.approve_jd',
            'size' => 'md',
            'type' => 'job',
            'header'=> false
        ],
        'assign_superior' => [
            'title' => 'Assign Superior',
            'view' => 'modals.jobs.assign_superior',
            'size' => 'lg',
            'header'=> true
        ],
        'change_department' => [
            'title' => '',
            'view' => 'modals.jobs.change_department',
            'size' => 'md',
            'type' => 'job',
            'header'=> false
        ],
        'generic_confirm' => [
            'size'  => 'md',
            'title' => 'Confirm Updates',     // overridden at runtime
            'type' => 'job',
            'view'  => 'modals.jobs.generic-confirm',
            'header'=> true
        ],
        'change_level' => [
            'title' => '',
            'view' => 'modals.jobs.change_level',
            'size' => 'md',
            'type' => 'job',
            'header'=> false
        ],
        'change_superior'=> [
            'title' => 'Change Superior Job Position?',
            'view' => 'modals.jobs.change_superior',
            'size' => 'md',
            'header'=> false
        ],
        'change_superior_confirmation'=> [
            'title' => '',
            'view' => 'modals.jobs.change_superior_confirmation',
            'size' => 'md',
            'header'=> false
        ],
        'add_new_headcount' => [
            'title' => 'Add New Headcount',
            'view' => 'modals.jobs.add_new_headcount',
            'size' => 'md',
            'header'=> false
        ],
        'change_superior_headcount'=> [
            'title' => '',
            'view' => 'modals.jobs.change_superior_headcount',
            'size' => 'md',
            'header'=> false
        ],
        'remove_headcount' => [
            'title' => 'Remove Headcount',
            'view' => 'modals.jobs.remove_headcount',
            'size' => 'md',
            'header'=> false
        ],
        'job_position_title' => [
            'title' => 'Job Position Title',
            'view' => 'modals.jobs.job_position_title',
            'size' => 'md',
            'header'=> false
        ],
        'is_critical_position' => [
            'title' => 'Is Critical Position?',
            'view' => 'modals.jobs.is_critical_position',
            'size' => 'md',
            'header'=> false
        ],
        'remove_headcount_confirmation' => [
            'title' => 'Remove Headcount?',
            'view' => 'modals.jobs.remove_headcount_confirmation',
            'size' => 'md',
            'header'=> false
        ],
        'generate_riasec' => [
            'title' => 'Generate RIASEC Using Job Position',
            'view' => 'modals.jobs.generate_riasec',
            'size' => 'lg',
            'header'=> false
        ],
        
        'technical_skill_comparison' => [
            'title' => 'View Changes',
            'view' => 'modals.jobs.technical_skill_comparison',
            'size' => 'xl',
            'header'=> true
        ],
         'technical_skill_comparison_restore' => [
            'title' => '',
            'view' => 'modals.jobs.technical_skill_comparison_restore',
            'size' => 'md',
            'header'=> false
        ],
        'delete_technical_skill' => [
            'title' => '',
            'view' => 'modals.jobs.delete_technical_skill_blade',
            'size' => 'md',
            'header'=> false
        ],
        
    ],
    'organization_chart' => [
        'no_subordinates_found' => [
            'title' => 'No Subordinates Assigned',
            'view' => 'modals.organization_chart.no_subordinates_found',
            'size' => '',
            'header'=> false
        ],
        'add_new_position' => [
            'title' => 'Add New Position',
            'view' => 'modals.organization_chart.add_new_position',
            'size' => '',
            'header'=> true
        ],
        'assign_employee' => [
            'title' => 'Assign Employee',
            'view' => 'modals.organization_chart.assign_employee',
            'size' => '',
            'header'=> true
        ],
        'move_employee' => [
            'title' => 'Move Employee',
            'view' => 'modals.organization_chart.move_employee',
            'size' => '',
            'header'=> true
        ],
        'remove_employee' => [
            'title' => 'Remove Employee',
            'view' => 'modals.organization_chart.remove_employee',
            'size' => '',
            'header'=> true
        ],
        'reassign_subordinates' => [
            'title' => 'Reassign Subordinates',
            'view' => 'modals.organization_chart.reassign_subordinates',
            'size' => 'xl',
            'header'=> true
        ],
        'reassign_delete_case' => [
            'title' => 'Delete Position',
            'view' => 'modals.organization_chart.reassign_delete_case',
            'size' => '',
            'header'=> false
        ],
        'delete_position_employee_warning' => [
            'title' => 'Delete Position',
            'view' => 'modals.organization_chart.delete_position_employee_warning',
            'size' => '',
            'header'=> false
        ],
        'delete_position_subordinates_warning' => [
            'title' => 'Delete Position',
            'view' => 'modals.organization_chart.delete_position_subordinates_warning',
            'size' => '',
            'header'=> false
        ],
        'only_available_headcount_warning' => [
            'title' => 'Delete Position',
            'view' => 'modals.organization_chart.only_available_headcount_warning',
            'size' => '',
            'header'=> false
        ],
        'before_delete_reassign_subordinates' => [
            'title' => 'Reassign Subordinates',
            'view' => 'modals.organization_chart.before_delete_reassign_subordinates',
            'size' => 'xl',
            'header'=> false
        ],
        'delete_position' => [
            'title' => 'Delete Position',
            'view' => 'modals.organization_chart.delete_position',
            'size' => '',
            'header'=> false
        ],
        'save_organization_chart' => [
            'title' => 'Save Organization Chart',
            'view' => 'modals.organization_chart.save_organization_chart',
            'size' => 'md',
            'header'=> false
        ],
        'edit_position_confirmation' => [
            'title' => 'Edit Position Confirmation',
            'view' => 'modals.organization_chart.edit_position_confirmation',
            'size' => 'md',
            'header'=> false
        ],
        'unsaved_organization_chart' => [
            'title' => 'Unsaved Changes',
            'view' => 'modals.organization_chart.unsaved_organization_chart',
            'size' => 'md',
            'header'=> false
        ],
    ],
    'users' => [
        'deactivate_user' => [
            'title' => 'Deactivate User Account',
            'view' => 'modals.users.deactivate_user',
            'size' => 'sm',
            'header'=> true
        ],
    ],
    'company_skill_library' => [
        'overview_skill_level_edit' => [
            'title' => '',
            'view' => 'modals.company_skill_library.overview_skill_level_edit',
            'size' => 'sm',
            'header'=> false
        ],

         'edit_technical_skill' => [
            'title' => '',
            'view' => 'modals.company_skill_library.edit_technical_skill',
            'size' => 'lg',
            'header'=> false
        ],
        
        'duplicate_technical_skill' => [
            'title' => 'Create New',
            'view' => 'modals.company_skill_library.duplicate_technical_skill',
            'size' => 'md',
            'header'=> true
        ],
         'create_company_technical_skill' => [
            'title' => '',
            'view' => 'modals.company_skill_library.create_company_technical_skill',
            'size' => 'md',
            'header'=> false
        ],
         'create_another_company_technical_skill' => [
            'title' => '',
            'view' => 'modals.company_skill_library.create_another_company_technical_skill',
            'size' => 'md',
            'header'=> false
        ],
          'delete_technical_skill' => [
            'title' => '',
            'view' => 'modals.company_skill_library.delete_technical_skill',
            'size' => 'md',
            'header'=> false
        ],

          'delete_master_technical_skill' => [
            'title' => '',
            'view' => 'modals.company_skill_library.delete_master_technical_skill',
            'size' => 'md',
            'header'=> true
        ],

        'technical_skill_no_changes_detected' => [
            'title' => '',
            'view' => 'modals.company_skill_library.technical_skill_no_changes_detected',
            'size' => 'md',
            'header'=> false
        ],
    ],
    'talent_acquisition'=>[
        'convert_to_employee' => [
            'title' => '',
            'view' => 'modals.talent_acquisition.convert_to_employee',
            'size' => '',
            'header'=> false
        ],
        'convert_to_employee_success' => [
            'title' => '',
            'view' => 'modals.talent_acquisition.convert_to_employee_success',
            'size' => '',
            'header'=> false
        ],
        'convert_to_employee_success_application_filled' => [
            'title' => 'Status Changed',
            'view' => 'modals.talent_acquisition.convert_to_employee_success_application_filled',
            'size' => '',
            'header'=> true
        ],
    ],
    'employee_module' => [
        'assessment_completed' => [
            'title' => '',
            'view' => 'modals.employee_module.assessment_completed',
            'size' => 'md',
            'header'=> false
        ],
    ],
];
