<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/config/api.php

return [
    /*
    |--------------------------------------------------------------------------
    | API Configuration
    |--------------------------------------------------------------------------
    */
    'version' => 'v1',
    'base_url' => env('APP_URL', 'http://insighthub.local/apps/tc'),
    
    /*
    |--------------------------------------------------------------------------
    | Allowed Services Configuration
    |--------------------------------------------------------------------------
    */
    'allowed_services' => [
        'insightaccess-bsc' => [
            'api_key' => env('BSC_APP_API_KEY', 'TC-BSC'),
            'secret' => env('BSC_APP_SECRET', 'TC-BSC-SECRET'),
            'permissions' => [
                'users.read',
                'users.validate_access',
                'tenants.read',
                'employees.read',
                'departments.read',
                'performance.read'
            ],
            'rate_limit' => 100, // requests per minute
        ],
        'central-app' => [
            'api_key' => env('CENTRAL_APP_API_KEY', 'central_api_key_2024'),
            'secret' => env('CENTRAL_APP_SECRET', 'central_secret_key_2024'),
            'permissions' => [
                'tenants.read',
                'tenants.write',
                'subscriptions.read',
                'users.read',
                'users.write'
            ],
            'rate_limit' => 200,
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    */
    'security' => [
        'signature_algorithm' => 'sha256',
        'max_timestamp_drift' => 300, // 5 minutes
        'require_https' => env('API_REQUIRE_HTTPS', false),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | CORS Configuration
    |--------------------------------------------------------------------------
    */
    'cors' => [
        'allowed_origins' => [
            'http://insighthub.local',
            'http://insighthub.local/apps/bsc',
            'http://insighthub.local/apps/tc',
            'http://localhost/central-app',
        ],
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
        'allowed_headers' => [
            'Content-Type', 
            'Authorization', 
            'X-API-Key', 
            'X-Signature', 
            'X-Timestamp',
            'X-Service-Name'
        ],
    ],
];