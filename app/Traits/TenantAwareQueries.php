<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Traits/TenantAwareQueries.php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait TenantAwareQueries
{
    protected static $tenantTables = [
        'users', 'departments'
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