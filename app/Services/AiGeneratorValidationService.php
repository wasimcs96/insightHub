<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class AiGeneratorValidationService
{
    public function validateJobDescriptionRequest(array $data): array
    {
        $validator = Validator::make($data, [
            'job_role' => 'required|string',
            'job_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return [
                'status' => false,
                'errors' => $validator->errors()
            ];
        }

        return ['status' => true];
    }
}
