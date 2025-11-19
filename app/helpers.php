<?php

if (!function_exists('tenant_id')) {
    function tenant_id() {
        return \App\Helpers\TenantHelper::id();
    }
}

function is_TC(){
    return config('app.is_TC') ?? false;
}
