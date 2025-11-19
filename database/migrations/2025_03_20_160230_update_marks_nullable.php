<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMarksNullable extends Migration
{
    public function up()
    {
        Schema::table('job_opening_application_interview_responses', function (Blueprint $table) {
            $table->decimal('marks', 5, 2)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('job_opening_application_interview_responses', function (Blueprint $table) {
            $table->decimal('marks', 5, 2)->change();
        });
    }
}
