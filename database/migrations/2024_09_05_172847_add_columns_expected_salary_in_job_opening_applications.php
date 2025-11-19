<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsExpectedSalaryInJobOpeningApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->decimal('expected_salary', 10, 2)->nullable()->after('interview_address');
            $table->decimal('salary_lower_bound', 10, 2)->nullable()->after('expected_salary');
            $table->decimal('salary_upper_bound', 10, 2)->nullable()->after('salary_lower_bound');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->dropColumn('expected_salary');
            $table->dropColumn('salary_lower_bound');
            $table->dropColumn('salary_upper_bound');
        });
    }
}
