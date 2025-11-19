<?php

namespace App\Providers;

use App\Models\MasterGeneralSetting;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Contracts\JobHeadcountRepositoryInterface::class,
            \App\Repositories\JobHeadcountRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Temporary: Disable tenant scopes until fully tested
        if (config('app.disable_tenant_scopes', false)) {
            // This will disable all global scopes temporarily
            \Illuminate\Database\Eloquent\Model::unsetEventDispatcher();
        }
        
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);

        ini_set('pcre.backtrack_limit', '10000000');
        ini_set('pcre.recursion_limit', '10000000');

        // View::composer('*', function ($view) {
        //     $logo = MasterGeneralSetting::where('name', 'LOGO')->first();
        //     $favicon = MasterGeneralSetting::where('name', 'FAVICON')->first(); // if you need more
    
        //     $view->with('logo', $logo)->with('favicon', $favicon);
        // });
    }
}
