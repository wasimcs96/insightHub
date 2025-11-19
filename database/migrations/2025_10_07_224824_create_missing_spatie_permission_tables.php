<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    protected $command;

    public function up()
    {
        $this->command = $this->command ?? app('Illuminate\Console\Command');
        $tableNames = $this->getTableNames();
        $columnNames = $this->getColumnNames();
        $teams = $this->teamsEnabled();

        // 1. Check/Create permissions table
        if (!Schema::hasTable($tableNames['permissions'])) {
            Schema::create($tableNames['permissions'], function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 191);
                $table->string('guard_name', 191);
                $table->timestamps();
                $table->unique(['name', 'guard_name']);
            });
        } else {
            // Check and add missing columns
            Schema::table($tableNames['permissions'], function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'id')) {
                    $table->bigIncrements('id')->first();
                }
                if (!Schema::hasColumn($table->getTable(), 'name')) {
                    $table->string('name', 191)->after('id');
                }
                if (!Schema::hasColumn($table->getTable(), 'guard_name')) {
                    $table->string('guard_name', 191)->after('name');
                }
                if (!Schema::hasColumn($table->getTable(), 'created_at')) {
                    $table->timestamps();
                }
            });

            // Add unique constraint if it doesn't exist
            $this->addUniqueConstraintIfNotExists($tableNames['permissions'], ['name', 'guard_name']);
        }

        // 2. Check/Create roles table
        if (!Schema::hasTable($tableNames['roles'])) {
            Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
                $table->bigIncrements('id');
                
                if ($teams) {
                    $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                    $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
                }
                
                $table->string('name', 191);
                $table->string('guard_name', 191);
                $table->timestamps();

                if ($teams) {
                    $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
                } else {
                    $table->unique(['name', 'guard_name']);
                }
            });
        } else {
            // Check and add missing columns
            Schema::table($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
                if (!Schema::hasColumn($table->getTable(), 'id')) {
                    $table->bigIncrements('id')->first();
                }
                if (!Schema::hasColumn($table->getTable(), 'name')) {
                    $table->string('name', 191)->after('id');
                }
                if (!Schema::hasColumn($table->getTable(), 'guard_name')) {
                    $table->string('guard_name', 191)->after('name');
                }
                if (!Schema::hasColumn($table->getTable(), 'created_at')) {
                    $table->timestamps();
                }
                
                if ($teams && !Schema::hasColumn($table->getTable(), $columnNames['team_foreign_key'])) {
                    $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                    $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
                }
            });

            // Add unique constraint if it doesn't exist
            if ($teams) {
                $this->addUniqueConstraintIfNotExists($tableNames['roles'], [$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $this->addUniqueConstraintIfNotExists($tableNames['roles'], ['name', 'guard_name']);
            }
        }

        // 3. Check/Create model_has_permissions table
        if (!Schema::hasTable($tableNames['model_has_permissions'])) {
            Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
                $table->unsignedBigInteger('permission_id');
                $table->string('model_type');
                $table->unsignedBigInteger($columnNames['model_morph_key']);
                
                $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

                $table->foreign('permission_id')
                    ->references('id')
                    ->on($tableNames['permissions'])
                    ->onDelete('cascade');

                if ($teams) {
                    $table->unsignedBigInteger($columnNames['team_foreign_key']);
                    $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

                    $table->primary([
                        $columnNames['team_foreign_key'], 
                        'permission_id', 
                        $columnNames['model_morph_key'], 
                        'model_type'
                    ], 'model_has_permissions_permission_model_type_primary');
                } else {
                    $table->primary([
                        'permission_id', 
                        $columnNames['model_morph_key'], 
                        'model_type'
                    ], 'model_has_permissions_permission_model_type_primary');
                }
            });
        } else {
            // Check and add missing columns
            Schema::table($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
                if (!Schema::hasColumn($table->getTable(), 'permission_id')) {
                    $table->unsignedBigInteger('permission_id');
                }
                if (!Schema::hasColumn($table->getTable(), 'model_type')) {
                    $table->string('model_type');
                }
                if (!Schema::hasColumn($table->getTable(), $columnNames['model_morph_key'])) {
                    $table->unsignedBigInteger($columnNames['model_morph_key']);
                }
                
                if ($teams && !Schema::hasColumn($table->getTable(), $columnNames['team_foreign_key'])) {
                    $table->unsignedBigInteger($columnNames['team_foreign_key']);
                }
            });

            // Add foreign keys and indexes if they don't exist
            $this->addForeignKeyIfNotExists($tableNames['model_has_permissions'], 'permission_id', $tableNames['permissions'], 'id');
            $this->addIndexIfNotExists($tableNames['model_has_permissions'], [$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');
            
            if ($teams) {
                $this->addIndexIfNotExists($tableNames['model_has_permissions'], [$columnNames['team_foreign_key']], 'model_has_permissions_team_foreign_key_index');
            }
        }

        // 4. Check/Create model_has_roles table
        if (!Schema::hasTable($tableNames['model_has_roles'])) {
            Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
                $table->unsignedBigInteger('role_id');
                $table->string('model_type');
                $table->unsignedBigInteger($columnNames['model_morph_key']);
                
                $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

                $table->foreign('role_id')
                    ->references('id')
                    ->on($tableNames['roles'])
                    ->onDelete('cascade');

                if ($teams) {
                    $table->unsignedBigInteger($columnNames['team_foreign_key']);
                    $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                    $table->primary([
                        $columnNames['team_foreign_key'], 
                        'role_id', 
                        $columnNames['model_morph_key'], 
                        'model_type'
                    ], 'model_has_roles_role_model_type_primary');
                } else {
                    $table->primary([
                        'role_id', 
                        $columnNames['model_morph_key'], 
                        'model_type'
                    ], 'model_has_roles_role_model_type_primary');
                }
            });
        } else {
            // Check and add missing columns
            Schema::table($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
                if (!Schema::hasColumn($table->getTable(), 'role_id')) {
                    $table->unsignedBigInteger('role_id');
                }
                if (!Schema::hasColumn($table->getTable(), 'model_type')) {
                    $table->string('model_type');
                }
                if (!Schema::hasColumn($table->getTable(), $columnNames['model_morph_key'])) {
                    $table->unsignedBigInteger($columnNames['model_morph_key']);
                }
                
                if ($teams && !Schema::hasColumn($table->getTable(), $columnNames['team_foreign_key'])) {
                    $table->unsignedBigInteger($columnNames['team_foreign_key']);
                }
            });

            // Add foreign keys and indexes if they don't exist
            $this->addForeignKeyIfNotExists($tableNames['model_has_roles'], 'role_id', $tableNames['roles'], 'id');
            $this->addIndexIfNotExists($tableNames['model_has_roles'], [$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');
            
            if ($teams) {
                $this->addIndexIfNotExists($tableNames['model_has_roles'], [$columnNames['team_foreign_key']], 'model_has_roles_team_foreign_key_index');
            }
        }

        // 5. Check/Create role_has_permissions table
        if (!Schema::hasTable($tableNames['role_has_permissions'])) {
            Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
                $table->unsignedBigInteger('permission_id');
                $table->unsignedBigInteger('role_id');

                $table->foreign('permission_id')
                    ->references('id')
                    ->on($tableNames['permissions'])
                    ->onDelete('cascade');

                $table->foreign('role_id')
                    ->references('id')
                    ->on($tableNames['roles'])
                    ->onDelete('cascade');

                $table->primary(['permission_id', 'role_id'], 'role_has_permissions_permission_id_role_id_primary');
            });
        } else {
            // Check and add missing columns
            Schema::table($tableNames['role_has_permissions'], function (Blueprint $table) {
                if (!Schema::hasColumn($table->getTable(), 'permission_id')) {
                    $table->unsignedBigInteger('permission_id');
                }
                if (!Schema::hasColumn($table->getTable(), 'role_id')) {
                    $table->unsignedBigInteger('role_id');
                }
            });

            // Add foreign keys if they don't exist
            $this->addForeignKeyIfNotExists($tableNames['role_has_permissions'], 'permission_id', $tableNames['permissions'], 'id');
            $this->addForeignKeyIfNotExists($tableNames['role_has_permissions'], 'role_id', $tableNames['roles'], 'id');
            $this->addPrimaryKeyIfNotExists($tableNames['role_has_permissions'], ['permission_id', 'role_id'], 'role_has_permissions_permission_id_role_id_primary');
        }

        // Clear permission cache
        if (class_exists('\Spatie\Permission\PermissionRegistrar')) {
            app(PermissionRegistrar::class)->forgetCachedPermissions();
        }
    }

    public function down()
    {
        $tableNames = $this->getTableNames();

        Schema::dropIfExists($tableNames['role_has_permissions']);
        Schema::dropIfExists($tableNames['model_has_roles']);
        Schema::dropIfExists($tableNames['model_has_permissions']);
        Schema::dropIfExists($tableNames['roles']);
        Schema::dropIfExists($tableNames['permissions']);
    }

    protected function getTableNames(): array
    {
        $config = config('permission.table_names');
        
        if (empty($config)) {
            return [
                'roles' => 'roles',
                'permissions' => 'permissions',
                'model_has_permissions' => 'model_has_permissions',
                'model_has_roles' => 'model_has_roles',
                'role_has_permissions' => 'role_has_permissions',
            ];
        }

        return $config;
    }

    protected function getColumnNames(): array
    {
        $config = config('permission.column_names');
        
        if (empty($config)) {
            return [
                'role_pivot_key' => 'role_id',
                'permission_pivot_key' => 'permission_id',
                'model_morph_key' => 'model_id',
                'team_foreign_key' => 'team_id',
            ];
        }

        return array_merge([
            'role_pivot_key' => 'role_id',
            'permission_pivot_key' => 'permission_id',
            'model_morph_key' => 'model_id',
            'team_foreign_key' => 'team_id',
        ], $config);
    }

    protected function teamsEnabled(): bool
    {
        return config('permission.teams', false);
    }

    protected function addForeignKeyIfNotExists($table, $column, $referencedTable, $referencedColumn)
    {
        try {
            $foreignKeys = $this->getForeignKeys($table);
            $exists = false;
            
            foreach ($foreignKeys as $key) {
                if ($key['column_name'] === $column) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                Schema::table($table, function (Blueprint $table) use ($column, $referencedTable, $referencedColumn) {
                    $table->foreign($column)
                        ->references($referencedColumn)
                        ->on($referencedTable)
                        ->onDelete('cascade');
                });
            }
        } catch (\Exception $e) {
            // Ignore if foreign key already exists or other constraint issues
        }
    }

    protected function addIndexIfNotExists($table, $columns, $indexName)
    {
        try {
            $indexes = $this->getIndexes($table);
            $exists = false;
            
            foreach ($indexes as $index) {
                if ($index['key_name'] === $indexName) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                Schema::table($table, function (Blueprint $table) use ($columns, $indexName) {
                    $table->index($columns, $indexName);
                });
            }
        } catch (\Exception $e) {
            // Ignore if index already exists
        }
    }

    protected function addUniqueConstraintIfNotExists($table, $columns)
    {
        try {
            $indexes = $this->getIndexes($table);
            $exists = false;
            
            foreach ($indexes as $index) {
                if ($index['non_unique'] == 0 && 
                    count($columns) === count(explode(',', $index['column_name']))) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                Schema::table($table, function (Blueprint $table) use ($columns) {
                    $table->unique($columns);
                });
            }
        } catch (\Exception $e) {
            // Ignore if unique constraint already exists
        }
    }

    protected function addPrimaryKeyIfNotExists($table, $columns, $constraintName)
    {
        try {
            $primaryKeys = $this->getPrimaryKeys($table);
            
            if (empty($primaryKeys)) {
                Schema::table($table, function (Blueprint $table) use ($columns, $constraintName) {
                    $table->primary($columns, $constraintName);
                });
            }
        } catch (\Exception $e) {
            // Ignore if primary key already exists
        }
    }

    protected function getForeignKeys($table)
    {
        return \DB::select("
            SELECT 
                COLUMN_NAME as column_name,
                REFERENCED_TABLE_NAME as referenced_table,
                REFERENCED_COLUMN_NAME as referenced_column
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = ? 
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ", [$table]);
    }

    protected function getIndexes($table)
    {
        return \DB::select("
            SELECT 
                INDEX_NAME as key_name,
                COLUMN_NAME as column_name,
                NON_UNIQUE as non_unique
            FROM INFORMATION_SCHEMA.STATISTICS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = ?
        ", [$table]);
    }

    protected function getPrimaryKeys($table)
    {
        return \DB::select("
            SELECT COLUMN_NAME 
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = ? 
            AND CONSTRAINT_NAME = 'PRIMARY'
        ", [$table]);
    }
};
