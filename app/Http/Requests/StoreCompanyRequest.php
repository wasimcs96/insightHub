<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
       return [
            'company_name' => 'required|string|max:255',
            'business_registration_number' => 'nullable|string|max:255',
            'date_established' => 'nullable|date',
            'country' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:255',
            'number_of_employees' => 'nullable|integer',
            'company_contact_number' => 'nullable|string|max:20',
            'company_email' => 'nullable|email|max:255',
            'company_website' => 'nullable|url|max:255',
            'industry_sector' => 'nullable|string|max:255',
            'sub_sector' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:500',
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ];
    }
}
