<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOpeningJobSkillsTable extends Migration
{
    public function up()
    {
        Schema::create('job_opening_job_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_opening_id')->constrained('job_openings')->onDelete('cascade');
            $table->foreignId('job_skill_id')->constrained('job_skills')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_opening_job_skills');
    }
}
