<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'tenant_id' => $this->tenant_id,
            'central_portal_user_id' => $this->central_portal_user_id,
            'role_id' => $this->role_id,
            'is_admin' => $this->is_admin,
            'tenant' => [
                'id' => $this->tenant->id ?? null,
                'name' => $this->tenant->name ?? null,
                'slug' => $this->tenant->slug ?? null,
                'description' => $this->tenant->description ?? null,
                'is_active' => $this->tenant->is_active ?? null,
                'created_at' => $this->tenant->created_at?->toDateTimeString() ?? null,
                'updated_at' => $this->tenant->updated_at?->toDateTimeString() ?? null,
            ],
            'assigned_role' => $this->roles->first() ? [
                'id' => $this->roles->first()->id,
                'name' => $this->roles->first()->name,
                'tenant_id' => $this->roles->first()->tenant_id,
                'permissions' => $this->roles->first()->permissions->map(function ($permission) {
                    return [
                        'id' => $permission->id,
                        'name' => $permission->name,
                        'tenant_id' => $permission->tenant_id,
                    ];
                }),
            ] : null,
            // 'all_permissions' => $this->getAllPermissions()->map(function ($permission) {
            //     return [
            //         'id' => $permission->id,
            //         'name' => $permission->name,
            //         'tenant_id' => $permission->tenant_id,
            //     ];
            // }),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}