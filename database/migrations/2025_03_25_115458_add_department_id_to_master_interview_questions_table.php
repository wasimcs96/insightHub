<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentIdToMasterInterviewQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_interview_questions', function (Blueprint $table) {
        $table->unsignedBigInteger('department_id')->after('id'); // or ->after('id') if you want it first
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_interview_questions', function (Blueprint $table) {
            //
        });
    }
}
