<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust as needed based on your authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'mandatory_fields.company_name' => 'required|string',
            'mandatory_fields.company_address' => 'required|string',
            'mandatory_fields.full_name' => 'required|string',
            'mandatory_fields.position' => 'required|string',
            'mandatory_fields.commencement_date' => 'required|date',
            'mandatory_fields.basic_salary' => 'required|string',
            'mandatory_fields.pay_frequency' => 'required|string',
            'mandatory_fields.regular_working_hours' => 'required|string',
            'mandatory_fields.rest_days' => 'required|string',
            'mandatory_fields.holiday_entitlement' => 'required|string',
            'mandatory_fields.leave_entitlement' => 'required|string',
            'mandatory_fields.notice_period' => 'required|string',
            'mandatory_fields.grounds_for_termination' => 'required|string',
            'mandatory_fields.confidentiality_agreement' => 'required|string',
            'mandatory_fields.non_compete_clause' => 'required|string',
            'mandatory_fields.acknowledgement_of_company_policies' => 'required|string',
            'mandatory_fields.acknowledgement_of_receipt_of_handbook' => 'required|string',
            'mandatory_fields.employee_signature' => 'required|string',
            'mandatory_fields.date_signed_by_employee' => 'required|date',
            // Add other mandatory fields validation rules here
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Template name is required.',
            'mandatory_fields.company_name.required' => 'Company name is required.',
            'mandatory_fields.company_address.required' => 'Company address is required.',
            'mandatory_fields.full_name.required' => 'Full name is required.',
            'mandatory_fields.position.required' => 'Position/Job Title is required.',
            'mandatory_fields.commencement_date.required' => 'Commencement date is required.',
            'mandatory_fields.basic_salary.required' => 'Basic salary is required.',
            'mandatory_fields.pay_frequency.required' => 'Pay frequency is required.',
            'mandatory_fields.regular_working_hours.required' => 'Regular working hours are required.',
            'mandatory_fields.rest_days.required' => 'Rest days are required.',
            'mandatory_fields.holiday_entitlement.required' => 'Holiday entitlement is required.',
            'mandatory_fields.leave_entitlement.required' => 'Leave entitlement is required.',
            'mandatory_fields.notice_period.required' => 'Notice period is required.',
            'mandatory_fields.grounds_for_termination.required' => 'Grounds for termination are required.',
            'mandatory_fields.confidentiality_agreement.required' => 'Confidentiality agreement is required.',
            'mandatory_fields.non_compete_clause.required' => 'Non-compete clause is required.',
            'mandatory_fields.acknowledgement_of_company_policies.required' => 'Acknowledgement of company policies is required.',
            'mandatory_fields.acknowledgement_of_receipt_of_handbook.required' => 'Acknowledgement of receipt of handbook is required.',
            'mandatory_fields.employee_signature.required' => 'Employee signature is required.',
            'mandatory_fields.date_signed_by_employee.required' => 'Date signed by employee is required.',
            // Add custom messages for other mandatory fields here
        ];
    }
}
