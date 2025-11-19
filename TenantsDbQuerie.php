
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $tenantTables = [
            'users', 'departments', 'jobs', 'quiz_domain_value_answers', 
            'skill_reviews', 'skill_review_details', 'master_descriptors'
        ];

        foreach ($tenantTables as $table) {
            $this->createTenantView($table);
        }
    }

    protected function createTenantView($table)
    {
        $tenantId = $this->getCurrentTenantId();
        
        DB::statement("
            CREATE OR REPLACE VIEW {$table}_tenant AS 
            SELECT * FROM {$table} 
            WHERE tenant_id = COALESCE(@current_tenant_id, {$tenantId})
        ");
    }

    protected function getCurrentTenantId()
    {
        if (auth()->check()) {
            return auth()->user()->tenant_id ?? 1;
        }
        return session('tenant_id', 1);
    }

    public function down()
    {
        $tenantTables = [
            'users', 'departments', 'jobs', 'quiz_domain_value_answers', 
            'skill_reviews', 'skill_review_details', 'master_descriptors'
        ];

        foreach ($tenantTables as $table) {
            DB::statement("DROP VIEW IF EXISTS {$table}_tenant");
        }
    }
};


// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Database/TenantAwareConnection.php

// namespace App\Database;

use Illuminate\Database\MySqlConnection;
use Illuminate\Support\Facades\Auth;

class TenantAwareConnection extends MySqlConnection
{
    protected $tenantTables = [
        'users', 'departments', 'jobs', 'quiz_domain_value_answers',
        'skill_reviews', 'skill_review_details', 'master_descriptors'
    ];

    public function select($query, $bindings = [], $useReadPdo = true)
    {
        $query = $this->addTenantScope($query);
        return parent::select($query, $bindings, $useReadPdo);
    }

    public function selectOne($query, $bindings = [], $useReadPdo = true)
    {
        $query = $this->addTenantScope($query);
        return parent::selectOne($query, $bindings, $useReadPdo);
    }

    public function insert($query, $bindings = [])
    {
        $query = $this->addTenantInsert($query);
        return parent::insert($query, $bindings);
    }

    public function update($query, $bindings = [])
    {
        $query = $this->addTenantScope($query);
        return parent::update($query, $bindings);
    }

    public function delete($query, $bindings = [])
    {
        $query = $this->addTenantScope($query);
        return parent::delete($query, $bindings);
    }

    protected function addTenantScope($query)
    {
        $tenantId = $this->getCurrentTenantId();
        if (!$tenantId) {
            return $query;
        }

        // Skip if query already has tenant_id condition
        if (stripos($query, 'tenant_id') !== false) {
            return $query;
        }

        // Parse and modify the query
        $query = $this->injectTenantCondition($query, $tenantId);
        
        return $query;
    }

    protected function injectTenantCondition($query, $tenantId)
    {
        // Simple regex-based approach for common patterns
        foreach ($this->tenantTables as $table) {
            // Handle FROM clause
            $pattern = "/FROM\s+`?{$table}`?(?:\s+AS\s+\w+)?(?:\s+WHERE|\s+GROUP|\s+ORDER|\s+LIMIT|\s*$)/i";
            if (preg_match($pattern, $query, $matches)) {
                $replacement = str_replace(
                    $matches[0], 
                    rtrim($matches[0], ' ') . " WHERE {$table}.tenant_id = {$tenantId}" . 
                    (stripos($matches[0], 'WHERE') !== false ? ' AND' : '') . 
                    substr($matches[0], stripos($matches[0], 'WHERE') ?: strlen($matches[0])), 
                    $matches[0]
                );
                $query = str_replace($matches[0], $replacement, $query);
            }

            // Handle JOIN clauses
            $query = preg_replace(
                "/(JOIN\s+`?{$table}`?\s+(?:AS\s+\w+\s+)?ON[^)]+)/i",
                "$1 AND {$table}.tenant_id = {$tenantId}",
                $query
            );
        }

        return $query;
    }

    protected function addTenantInsert($query)
    {
        $tenantId = $this->getCurrentTenantId();
        if (!$tenantId) {
            return $query;
        }

        // Handle INSERT statements
        foreach ($this->tenantTables as $table) {
            if (stripos($query, "INSERT INTO `{$table}`") !== false || 
                stripos($query, "INSERT INTO {$table}") !== false) {
                
                // Add tenant_id to INSERT
                $query = preg_replace(
                    "/(INSERT\s+INTO\s+`?{$table}`?\s*\([^)]+)\)/i",
                    "$1, tenant_id)",
                    $query
                );
                
                $query = preg_replace(
                    "/(VALUES\s*\([^)]+)\)/i",
                    "$1, {$tenantId})",
                    $query
                );
            }
        }

        return $query;
    }

    protected function getCurrentTenantId()
    {
        // Priority order
        if (Auth::check() && Auth::user()->tenant_id) {
            return Auth::user()->tenant_id;
        }
        
        if (session()->has('tenant_id')) {
            return session('tenant_id');
        }
        
        if (request()->header('x-tenant-id')) {
            return request()->header('x-tenant-id');
        }

        return null;
    }
}

// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Database/TenantAwareDB.php

// namespace App\Database;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TenantAwareDB
{
    protected static $tenantTables = [
        'users', 'departments', 'jobs', 'quiz_domain_value_answers',
        'skill_reviews', 'skill_review_details', 'master_descriptors'
    ];

    public static function table($table, $as = null)
    {
        $query = DB::table($table, $as);
        
        if (in_array($table, static::$tenantTables)) {
            $tenantId = static::getCurrentTenantId();
            if ($tenantId) {
                $query->where("{$table}.tenant_id", $tenantId);
            }
        }
        
        return $query;
    }

    public static function select($query, $bindings = [])
    {
        $query = static::addTenantScope($query);
        return DB::select($query, $bindings);
    }

    public static function selectOne($query, $bindings = [])
    {
        $query = static::addTenantScope($query);
        return DB::selectOne($query, $bindings);
    }

    public static function raw($value)
    {
        return DB::raw($value);
    }

    protected static function addTenantScope($query)
    {
        $tenantId = static::getCurrentTenantId();
        if (!$tenantId) {
            return $query;
        }

        // Skip if already has tenant condition
        if (stripos($query, 'tenant_id') !== false) {
            return $query;
        }

        return static::injectTenantCondition($query, $tenantId);
    }

    protected static function injectTenantCondition($query, $tenantId)
    {
        foreach (static::$tenantTables as $table) {
            // Match table references and add tenant condition
            $patterns = [
                // FROM clause
                "/(\bFROM\s+`?{$table}`?(?:\s+(?:AS\s+)?\w+)?)\s*(?=\s+(?:WHERE|GROUP|ORDER|LIMIT|UNION|$))/i",
                // JOIN clauses  
                "/(\b(?:LEFT\s+|RIGHT\s+|INNER\s+)?JOIN\s+`?{$table}`?(?:\s+(?:AS\s+)?\w+)?)\s+ON\s+([^)]+?)(?=\s+(?:WHERE|GROUP|ORDER|LIMIT|LEFT|RIGHT|INNER|JOIN|UNION|$))/i"
            ];

            foreach ($patterns as $pattern) {
                $query = preg_replace_callback($pattern, function($matches) use ($table, $tenantId) {
                    if (count($matches) >= 3) {
                        // JOIN case
                        return $matches[1] . ' ON ' . $matches[2] . " AND {$table}.tenant_id = {$tenantId}";
                    } else {
                        // FROM case - add WHERE condition
                        $hasWhere = stripos($query, 'WHERE') !== false;
                        $connector = $hasWhere ? ' AND' : ' WHERE';
                        return $matches[1] . "{$connector} {$table}.tenant_id = {$tenantId}";
                    }
                }, $query);
            }
        }

        return $query;
    }

    protected static function getCurrentTenantId()
    {
        if (Auth::check() && Auth::user()->tenant_id) {
            return Auth::user()->tenant_id;
        }
        
        if (session()->has('tenant_id')) {
            return session('tenant_id');
        }
        
        if (request()->header('x-tenant-id')) {
            return request()->header('x-tenant-id');
        }

        return null;
    }

    // Proxy other DB methods
    public static function __callStatic($method, $parameters)
    {
        return DB::$method(...$parameters);
    }
}

// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Providers/TenantDatabaseServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Database\TenantAwareConnection;
use App\Database\TenantAwareDB;

class TenantDatabaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register custom DB facade
        $this->app->singleton('tenant.db', function () {
            return new TenantAwareDB();
        });
    }

    public function boot()
    {
        // Override default MySQL connection
        $this->app['db']->extend('tenant_mysql', function ($config, $name) {
            $connector = new \Illuminate\Database\Connectors\MySqlConnector();
            $connection = $connector->connect($config);
            
            return new TenantAwareConnection(
                $connection,
                $config['database'],
                $config['prefix'] ?? '',
                $config
            );
        });
    }
}

// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Helpers/AssessmentHelper.php

namespace App\Helpers;

use App\Database\TenantAwareDB as DB; // Use custom DB
// OR use the trait approach:
use App\Traits\TenantAwareQueries;

class AssessmentHelper
{
    use TenantAwareQueries; // If using trait approach

    public static function getSoftSkills($userId)
    {
        // This will automatically add tenant_id condition
        $allSkillReviews = DB::table('skill_reviews')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $softSkills = [];
        foreach ($allSkillReviews as $review) {
            $reviewYear = date('Y', strtotime($review->review_date));
            
            // This will also auto-add tenant_id
            $softSkillDetails = DB::table('skill_review_details')
                ->where('skill_review_id', $review->id)
                ->where('skill_type', 'soft')
                ->get();

            $reviewSkills = $softSkillDetails->map(fn ($detail) => [
                'title' => $detail->name ?? 'N/A',
                'level' => $detail->level ?? 'N/A',
                'remarks' => $detail->remark ?? 'N/A'
            ])->toArray();

            $softSkills[] = [
                'review_id' => $review->id,
                'year' => $reviewYear,
                'skills' => $reviewSkills
            ];
        }

        return $softSkills;
    }

    public static function getOCEANAllFacetsResult($user_id, $isPopulation = 0)
    {
        if ($isPopulation) {
            $tenantId = static::getCurrentTenantId();
            
            // Raw query with manual tenant injection
            $results = DB::select("
                SELECT 
                    AVG(CASE WHEN quiz_domain_value_question_id IN (117, 147, 177, 207) THEN answer ELSE NULL END) as daydreaming_avg,
                    AVG(CASE WHEN quiz_domain_value_question_id IN (122, 152, 182, 212) THEN answer ELSE NULL END) as aesthetic_appreciation_avg
                    -- ... other cases
                FROM quiz_domain_value_answers qdva
                JOIN users u ON qdva.user_id = u.id
                WHERE u.tenant_id = ? AND u.is_admin = 0
            ", [$tenantId]);
        } else {
            // Single user query - will auto-add tenant scope
            $results = DB::table('quiz_domain_value_answers')
                ->select([
                    DB::raw('AVG(CASE WHEN quiz_domain_value_question_id IN (117, 147, 177, 207) THEN answer ELSE NULL END) as daydreaming_avg'),
                    // ... other selects
                ])
                ->where('user_id', $user_id)
                ->first();
        }

        return $results;
    }

    protected static function getCurrentTenantId()
    {
        if (auth()->check() && auth()->user()->tenant_id) {
            return auth()->user()->tenant_id;
        }
        
        return session('tenant_id');
    }
}

// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Traits/TenantAwareQueries.php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait TenantAwareQueries
{
    protected static $tenantTables = [
        'users', 'departments', 'jobs', 'quiz_domain_value_answers',
        'skill_reviews', 'skill_review_details', 'master_descriptors'
    ];

    protected static function tenantSelect($query, $bindings = [])
    {
        $tenantId = static::getCurrentTenantId();
        
        // Add tenant_id to bindings if query references tenant tables
        foreach (static::$tenantTables as $table) {
            if (stripos($query, $table) !== false && stripos($query, 'tenant_id') === false) {
                // Inject tenant condition
                $query = static::injectTenantCondition($query, $table, $tenantId);
            }
        }

        return DB::select($query, $bindings);
    }

    protected static function tenantTable($table)
    {
        $query = DB::table($table);
        
        if (in_array($table, static::$tenantTables)) {
            $tenantId = static::getCurrentTenantId();
            if ($tenantId) {
                $query->where("{$table}.tenant_id", $tenantId);
            }
        }
        
        return $query;
    }

    protected static function injectTenantCondition($query, $table, $tenantId)
    {
        // Add WHERE or AND condition for tenant
        if (stripos($query, 'WHERE') !== false) {
            $query = str_ireplace(
                "FROM {$table}",
                "FROM {$table} WHERE {$table}.tenant_id = {$tenantId} AND",
                $query
            );
            // Fix the AND placement
            $query = str_replace(' AND WHERE ', ' WHERE ', $query);
        } else {
            $query = str_ireplace(
                "FROM {$table}",
                "FROM {$table} WHERE {$table}.tenant_id = {$tenantId}",
                $query
            );
        }

        return $query;
    }

    protected static function getCurrentTenantId()
    {
        if (auth()->check() && auth()->user()->tenant_id) {
            return auth()->user()->tenant_id;
        }
        
        return session('tenant_id', 1);
    }
}

// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/config/database.php
[
'connections' => [
    'mysql' => [
        'driver' => 'tenant_mysql', // Use custom driver
        'url' => env('DATABASE_URL'),
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        // ... other config
    ],
],

// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/config/app.php

'providers' => [
    // ... other providers
    App\Providers\TenantDatabaseServiceProvider::class,
],

'aliases' => [
    // ... other aliases
    'TenantDB' => App\Database\TenantAwareDB::class,
],
];
use TenantDB;
// Instead of:
DB::table('users')->get();

// Use:
TenantDB::table('users')->get(); // Auto-adds tenant_id

// Instead of:
DB::select('SELECT * FROM users');

// Use:
TenantDB::select('SELECT * FROM users'); // Auto-adds WHERE tenant_id = ?

// Raw queries with manual tenant handling:
$tenantId = auth()->user()->tenant_id;
DB::select('SELECT * FROM users WHERE tenant_id = ?', [$tenantId]);


use App\Traits\TenantAwareQueries;
use TenantAwareQueries; //write in the class
$users = self::tenantTable('departments')->get();
//dd($users);
$users = self::tenantSelect('SELECT * FROM departments');


use App\Helpers\TenantHelper;

// public function index()
// {
//     $tenantId = TenantHelper::id();
//     // or
//     $tenantId = tenant_id();
//     // use $tenantId as needed...
// }