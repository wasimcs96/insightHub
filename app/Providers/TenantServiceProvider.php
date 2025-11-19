<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Providers/TenantServiceProvider.php

namespace App\Providers;

use App\Services\TenantManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class TenantServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(TenantManager::class);
        $this->app->alias(TenantManager::class, 'tenant');
    }

    public function boot()
    {
        // Register global tenant facade
        $this->app->bind('tenant', function () {
            return $this->app->make(TenantManager::class);
        });

        // Boot tenant context for Eloquent models
        Model::addGlobalScope(new \App\Scopes\TenantScope);
    }
}

//access tenent data any where in the app 
//app('tenant')->setCurrentTenant($this->tenantId);