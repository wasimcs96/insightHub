<?php
namespace App\Modules\Headcounts\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Headcounts\Repositories\JobHeadcountRepositoryInterface;
use App\Modules\Headcounts\Repositories\EloquentJobHeadcountRepository;

class HeadcountsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            JobHeadcountRepositoryInterface::class,
            EloquentJobHeadcountRepository::class
        );
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }
}
