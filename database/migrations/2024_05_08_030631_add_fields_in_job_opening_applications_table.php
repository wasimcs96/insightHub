<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInJobOpeningApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->date('interview_date')->nullable();
            $table->string('interviewer_name')->nullable();
            $table->tinyInteger('interview_mode')->comment('1 for Physical, 2 for Online')->nullable();
            $table->integer('interview_score')->default(0);
            $table->integer('interview_performance')->nullable();
            $table->text('suggestion')->nullable();
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
            $table->dropColumn([
                'interview_date',
                'interviewer_name',
                'interview_mode',
                'interview_score',
                'interview_performance',
                'suggestion'
            ]);
        });
    }
}
