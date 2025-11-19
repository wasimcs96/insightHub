<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFieldsNullableInMasterTechnicalQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_technical_questions', function (Blueprint $table) {
            $table->integer('job_id')->default(0)->change();
            $table->integer('sierra_id')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_technical_questions', function (Blueprint $table) {
            $table->integer('job_id')->default(NULL)->change();
            $table->integer('sierra_id')->default(NULL)->change();
        });
    }
}
