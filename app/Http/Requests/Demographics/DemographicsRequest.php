<?php

namespace App\Http\Requests\Demographics;

use Illuminate\Foundation\Http\FormRequest;

class DemographicsRequest extends FormRequest
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
    public function rules()
    {
        return [
          'insti_name' => 'nullable|max:255',
          'campus' => 'nullable|max:255',
          'faculty' => 'nullable|max:255',
          'study_program' => 'nullable|max:255',
          'year_of_study' => 'nullable|max:255'
        ];
    }

    public function filter($model){

      $data = $this->validated();

      $query = $model::where(function($query) use ($data){

        foreach($data as $key => $value){

          $query->whereIn($key, explode(',', $value));

        }

      });

      return $query;

    }
}
