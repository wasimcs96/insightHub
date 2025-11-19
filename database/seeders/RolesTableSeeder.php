<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::updateOrCreate(['id' => 1], ['name' => 'employee', 'caption' => 'Employee role', 'is_admin' => 0, 'created_at' => time()]);
        \App\Models\Role::updateOrCreate(['id' => 2], ['name' => 'admin', 'caption' => 'Admin role', 'is_admin' => 1, 'created_at' => time()]);
        \App\Models\Role::updateOrCreate(['id' => 3], ['name' => 'company', 'caption' => 'Company role', 'is_admin' => 0, 'created_at' => time()]);
        \App\Models\Role::updateOrCreate(['id' => 4], ['name' => 'department', 'caption' => 'Department role', 'is_admin' => 0, 'created_at' => time()]);
    }
}
