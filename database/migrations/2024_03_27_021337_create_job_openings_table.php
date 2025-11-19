<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOpeningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->tinyInteger('user_type')->default(1)->comment('1 is internal and 2 is external');
            $table->string('job_title', 510);
            $table->tinyInteger('employment_type')->default(1)->comment('1 is full time and 2 is part time');
            $table->text('overview_of_company');
            $table->Integer('postal_code');

            $table->text('job_role_description');
            $table->foreignId('industry_id')->constrained('master_industries');
            $table->foreignId('education_level_id')->constrained('master_education_levels');
            $table->foreignId('education_year_id')->constrained('master_education_years');
            $table->foreignId('education_program_id')->constrained('master_education_programs');
            $table->text('certificate')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 is active and 2 is inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_openings');
    }
}
