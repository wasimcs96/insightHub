<?php
namespace App\Database;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TenantAwareDB
{
    protected static $tenantTables = [
        'users', 'departments', 'jobs'
    ];

    // public static function table($table, $as = null)
    // {
    //     $query = DB::table($table, $as);
        
    //     if (in_array($table, static::$tenantTables)) {
    //         $tenantId = static::getCurrentTenantId();
    //         if ($tenantId) {
    //             $query->where("{$table}.tenant_id", $tenantId);
    //         }
    //     }
        
    //     return $query;
    // }
    // New
    public static function table($table, $as = null)
    {
        // Extract table name and alias if provided in the format "table as alias"
        $tableName = $table;
        $alias = $as;
        
        if (stripos($table, ' as ') !== false) {
            [$tableName, $alias] = preg_split('/\s+as\s+/i', $table, 2);
            $tableName = trim($tableName);
            $alias = trim($alias);
        }
        
        $query = DB::table($table, $as);
        
        if (in_array($tableName, static::$tenantTables)) {
            $tenantId = static::getCurrentTenantId();
            if ($tenantId) {
                // Use alias if available, otherwise use table name
                $tableReference = $alias ?: $tableName;
                $query->where("{$tableReference}.tenant_id", $tenantId);
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

    // protected static function injectTenantCondition($query, $tenantId)
    // {
    //     foreach (static::$tenantTables as $table) {
    //         // Match table references and add tenant condition
    //         $patterns = [
    //             // FROM clause
    //             "/(\bFROM\s+`?{$table}`?(?:\s+(?:AS\s+)?\w+)?)\s*(?=\s+(?:WHERE|GROUP|ORDER|LIMIT|UNION|$))/i",
    //             // JOIN clauses  
    //             "/(\b(?:LEFT\s+|RIGHT\s+|INNER\s+)?JOIN\s+`?{$table}`?(?:\s+(?:AS\s+)?\w+)?)\s+ON\s+([^)]+?)(?=\s+(?:WHERE|GROUP|ORDER|LIMIT|LEFT|RIGHT|INNER|JOIN|UNION|$))/i"
    //         ];

    //         foreach ($patterns as $pattern) {
    //             $query = preg_replace_callback($pattern, function($matches) use ($table, $tenantId) {
    //                 if (count($matches) >= 3) {
    //                     // JOIN case
    //                     return $matches[1] . ' ON ' . $matches[2] . " AND {$table}.tenant_id = {$tenantId}";
    //                 } else {
    //                     // FROM case - add WHERE condition
    //                     $hasWhere = stripos($query, 'WHERE') !== false;
    //                     $connector = $hasWhere ? ' AND' : ' WHERE';
    //                     return $matches[1] . "{$connector} {$table}.tenant_id = {$tenantId}";
    //                 }
    //             }, $query);
    //         }
    //     }

    //     return $query;
    // }
    // protected static function injectTenantCondition($query, $tenantId)
    // {
    //     foreach (static::$tenantTables as $table) {
    //         // Simple FROM clause (no WHERE)
    //         if (preg_match("/FROM\s+`?{$table}`?(\s|$)/i", $query) && stripos($query, 'WHERE') === false) {
    //             // Add WHERE clause
    //             $query = preg_replace(
    //                 "/(FROM\s+`?{$table}`?(\s|$))/i",
    //                 "$1 WHERE {$table}.tenant_id = {$tenantId} ",
    //                 $query
    //             );
    //         }
    //         // FROM clause with WHERE
    //         elseif (preg_match("/FROM\s+`?{$table}`?(\s|$)/i", $query) && stripos($query, 'WHERE') !== false) {
    //             // Add AND to existing WHERE
    //             $query = preg_replace(
    //                 "/(FROM\s+`?{$table}`?.*?WHERE\s+)/is",
    //                 "$0{$table}.tenant_id = {$tenantId} AND ",
    //                 $query,
    //                 1
    //             );
    //         }
    //         // JOIN clause
    //         $query = preg_replace(
    //             "/(JOIN\s+`?{$table}`?.*?ON\s+)([^\s]+)(\s|$)/i",
    //             "$1$2 AND {$table}.tenant_id = {$tenantId}$3",
    //             $query
    //         );
    //     }
    //     return $query;
    // }

    // New

    protected static function injectTenantCondition($query, $tenantId)
    {
        foreach (static::$tenantTables as $table) {
            // Match table with optional alias: "table" or "table as alias" or "table alias"
            $pattern = "/\b{$table}\b(?:\s+(?:as\s+)?(\w+))?/i";
            
            if (preg_match($pattern, $query, $matches)) {
                // Use alias if present, otherwise use table name
                $tableReference = !empty($matches[1]) ? $matches[1] : $table;
                
                // Simple FROM clause (no WHERE)
                if (preg_match("/FROM\s+`?{$table}`?(?:\s+(?:as\s+)?(\w+))?/i", $query, $fromMatches) && stripos($query, 'WHERE') === false) {
                    $alias = !empty($fromMatches[1]) ? $fromMatches[1] : $table;
                    $query = preg_replace(
                        "/(FROM\s+`?{$table}`?(?:\s+(?:as\s+)?\w+)?)/i",
                        "$1 WHERE {$alias}.tenant_id = {$tenantId} ",
                        $query,
                        1
                    );
                }
                // FROM clause with WHERE
                elseif (preg_match("/FROM\s+`?{$table}`?(?:\s+(?:as\s+)?(\w+))?/i", $query, $fromMatches) && stripos($query, 'WHERE') !== false) {
                    $alias = !empty($fromMatches[1]) ? $fromMatches[1] : $table;
                    $query = preg_replace(
                        "/(FROM\s+`?{$table}`?(?:\s+(?:as\s+)?\w+)?.*?WHERE\s+)/is",
                        "$0{$alias}.tenant_id = {$tenantId} AND ",
                        $query,
                        1
                    );
                }
                
                // JOIN clause
                $query = preg_replace(
                    "/(JOIN\s+`?{$table}`?(?:\s+(?:as\s+)?(\w+))?.*?ON\s+)([^\s]+)(\s)/i",
                    function($matches) use ($table, $tenantId) {
                        $alias = !empty($matches[2]) ? $matches[2] : $table;
                        return $matches[1] . $matches[3] . " AND {$alias}.tenant_id = {$tenantId}" . $matches[4];
                    },
                    $query
                );
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