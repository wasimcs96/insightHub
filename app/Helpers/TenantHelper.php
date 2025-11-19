<?php

namespace App\Helpers;

class TenantHelper
{
    public static function id()
    {
        return auth()->check() && auth()->user()->tenant_id
            ? auth()->user()->tenant_id
            : session('tenant_id');
    }
}