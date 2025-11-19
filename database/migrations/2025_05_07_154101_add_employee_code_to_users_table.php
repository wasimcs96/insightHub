<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeCodeToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the employee_code column
            $table->string('employee_code')->nullable(); // You can add constraints if needed, e.g. unique
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the employee_code column if rolling back
            $table->dropColumn('employee_code');
        });
    }
}
