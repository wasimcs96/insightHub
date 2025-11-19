<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDepartmentToDepartmentIdInJobOpeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_openings', function (Blueprint $table) {
            // Step 3: Drop the old `department` column after ensuring that data has been correctly migrated.
            $table->dropColumn('department');

            // Optionally adjust the `department_id` column, e.g., make it unsigned, not nullable, etc.
            $table->integer('department_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_openings', function (Blueprint $table) {
            $table->dropColumn('department_id');
            // When rolling back, consider the original type and name of the 'department' column
            $table->string('department')->nullable();
        });
    }
}
