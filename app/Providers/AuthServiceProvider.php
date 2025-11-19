<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use App\Models\Section;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

         // Gate::define('see-analytics', function (?User $user, $role) {

        //     return $role === 'admin';

        // });
        // $minutes = 60 * 60; // 1 hour
        // $sections = Cache::remember('sections', $minutes, function () {
        //     return Section::all();
        // });

        // $scopes = [];
        // foreach ($sections as $section) {
        //     $scopes[$section->name] = $section->caption;
        //     Gate::define($section->name, function ($user) use ($section) {
        //         // dd($user->role);
        //         return $user->hasPermission($section->name);
        //     });
        // }
        
        // Define gates for permissions
        Gate::before(function ($user, $ability) {
            // Super admin bypass
            if ($user->hasRole('super-admin')) {
                return true;
            }
            // dd($ability);
            // Check if user has the permission
            return $user->hasPermission($ability) ?: null;
        });
    }
}
