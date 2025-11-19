<?php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MasterGeneralSetting;
use Illuminate\Support\Facades\Storage;

class CompanyDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        // Cast mobile to string for JS safety
        $mobile = isset($this->mobile_number) ? (string) $this->mobile_number : null;

        // Fetch logo from MasterGeneralSetting
        $logoSetting = MasterGeneralSetting::where('name', 'LOGO')->first();
        $logo = null;

        if ($logoSetting && $logoSetting->value) {
            $logoPath = $logoSetting->value;
            if (Storage::disk('public')->exists($logoPath)) {
                $logo = asset('storage/' . $logoPath);
            }
        }

        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'mobile_number'    => $mobile,
            'email'            => $this->email,
            'website'          => $this->website,
            'address'          => $this->address,
            'logo'             => $logo,
            'company_dbms'     => env('DB_DATABASE'),
            'business_registration_number' => $this->business_registration_number ?? null,
            'date_established' => $this->date_established ? $this->date_established->toDateString() : null,
            'company_size'     => $this->company_size ?? null,
            'number_of_employees' => $this->number_of_employees ?? null,
            'sector'           => $this->masterSector->name ?? null,
            'sub_sector'       => $this->masterSubSector->name ?? null,
        ];
    }
}