<?php

namespace App\Services;

use App\Models\CompanyProfile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    public function storeOrUpdate(array $data, ?CompanyProfile $company = null): CompanyProfile
    {
        if (isset($data['company_logo']) && $data['company_logo'] instanceof UploadedFile) {
            $path = $data['company_logo']->store('logos', 'public');
            $data['company_logo'] = $path;
        }

        if ($company) {
            $company->update($data);
        } else {
            $company = CompanyProfile::create($data);
        }

        return $company;
    }

    public function getCompany(): ?CompanyProfile
    {
        return CompanyProfile::first();
    }
}
