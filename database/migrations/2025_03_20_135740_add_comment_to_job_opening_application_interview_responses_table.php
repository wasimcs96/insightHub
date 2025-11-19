<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommentToJobOpeningApplicationInterviewResponsesTable extends Migration
{
    public function up()
    {
        Schema::table('job_opening_application_interview_responses', function (Blueprint $table) {
            $table->text('comment')->nullable()->after('marks');
        });
    }

    public function down()
    {
        Schema::table('job_opening_application_interview_responses', function (Blueprint $table) {
            $table->dropColumn('comment');
        });
    }

}
