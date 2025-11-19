<?php

namespace App\Providers;

use App\Contracts\JobHeadcountRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\QuizRepository;
use App\Repositories\Rest\Interfaces\AnalyticsRepositoryInterface;
use App\Repositories\Rest\AnalyticsRepository;
use App\Repositories\JobHeadcountRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

// V1 Interfaces
use App\Repositories\Contracts\Api\V1\UserRepositoryInterface;
use App\Repositories\Contracts\Api\V1\RoleRepositoryInterface;
use App\Repositories\Contracts\Api\V1\PermissionRepositoryInterface;
use App\Repositories\Contracts\Api\V1\TenantRepositoryInterface;

// V1 Implementations
use App\Repositories\Eloquent\Api\V1\UserRepository;
use App\Repositories\Eloquent\Api\V1\RoleRepository;
use App\Repositories\Eloquent\Api\V1\PermissionRepository;
use App\Repositories\Eloquent\Api\V1\TenantRepository;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @var array
     */
    public $bindings = [
        // V1 Repositories
        UserRepositoryInterface::class => UserRepository::class,
        RoleRepositoryInterface::class => RoleRepository::class,
        PermissionRepositoryInterface::class => PermissionRepository::class,
        TenantRepositoryInterface::class => TenantRepository::class,
    ];

    /**
     * @var array
     */
    public array $singletons = [
        QuizRepositoryInterface::class => QuizRepository::class,
        AnalyticsRepositoryInterface::class => AnalyticsRepository::class,
        JobHeadcountRepositoryInterface::class => JobHeadcountRepository::class,
    ];

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            // Existing repositories
            QuizRepositoryInterface::class,
            AnalyticsRepositoryInterface::class,
            
            // V1 Repositories
            UserRepositoryInterface::class,
            RoleRepositoryInterface::class,
            PermissionRepositoryInterface::class,
            TenantRepositoryInterface::class,
            JobHeadcountRepositoryInterface::class,
        ];
    }
}