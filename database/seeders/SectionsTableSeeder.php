<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Section;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Section::updateOrCreate(['id' => 1], ['name' => 'admin_dashboard', 'caption' => 'Admin Dashboard']);


        Section::updateOrCreate(['id' => 2], ['name' => 'admin_roles', 'caption' => 'Roles Management']);
        Section::updateOrCreate(['id' => 3], ['name' => 'admin_roles_read', 'section_group_id' => 2, 'caption' => 'Read']);
        Section::updateOrCreate(['id' => 4], ['name' => 'admin_roles_write', 'section_group_id' => 2, 'caption' => 'Write']);
        Section::updateOrCreate(['id' => 5], ['name' => 'admin_roles_delete', 'section_group_id' => 2, 'caption' => 'Delete']);

        Section::updateOrCreate(['id' => 6], ['name' => 'user_management', 'caption' => 'User Management']);
        Section::updateOrCreate(['id' => 7], ['name' => 'user_management_read', 'section_group_id' => 6, 'caption' => 'Read']);
        Section::updateOrCreate(['id' => 8], ['name' => 'user_management_write', 'section_group_id' => 6, 'caption' => 'Write']);
        Section::updateOrCreate(['id' => 9], ['name' => 'user_management_delete', 'section_group_id' => 6, 'caption' => 'Delete']);


        Section::updateOrCreate(['id' => 10], ['name' => 'talent_acquisition', 'caption' => 'Talent Acquisition']);
        Section::updateOrCreate(['id' => 11], ['name' => 'talent_acquisition_read', 'section_group_id' => 10, 'caption' => 'Read']);
        Section::updateOrCreate(['id' => 12], ['name' => 'talent_acquisition_write', 'section_group_id' => 10, 'caption' => 'Write']);
        Section::updateOrCreate(['id' => 13], ['name' => 'talent_acquisition_delete', 'section_group_id' => 10, 'caption' => 'Delete']);


        Section::updateOrCreate(['id' => 14], ['name' => 'talent_management', 'caption' => 'Talent Management']);
        Section::updateOrCreate(['id' => 15], ['name' => 'talent_management_read', 'section_group_id' => 14, 'caption' => 'Read']);
        Section::updateOrCreate(['id' => 16], ['name' => 'talent_management_write', 'section_group_id' => 14, 'caption' => 'Write']);
        Section::updateOrCreate(['id' => 17], ['name' => 'talent_management_delete', 'section_group_id' => 14, 'caption' => 'Delete']);



        Section::updateOrCreate(['id' => 18], ['name' => 'setting_management', 'caption' => 'Setting Management']);
        Section::updateOrCreate(['id' => 19], ['name' => 'setting_management_read', 'section_group_id' => 18, 'caption' => 'Read']);
        Section::updateOrCreate(['id' => 20], ['name' => 'setting_management_write', 'section_group_id' => 18, 'caption' => 'Write']);
        Section::updateOrCreate(['id' => 21], ['name' => 'setting_management_delete', 'section_group_id' => 18, 'caption' => 'Delete']);
    }
}
