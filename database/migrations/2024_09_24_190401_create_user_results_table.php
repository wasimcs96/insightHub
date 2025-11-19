<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('assessment_type', 255)->comment('ocean, riasec, cognitive');
            $table->string('result_type', 255)->comment('job_match_rate, cognitive_assessment, technical_assessment, growth_potential, organizational_fit_forecast, flight_risk, soft_skills, ccs');
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable(); 
            $table->string('code', 255)->nullable();
            $table->text('description')->nullable();
            $table->double('score', 8, 2)->default(0);
            $table->double('z_score', 8, 2)->default(0); 
            $table->string('level', 255)->nullable();
            $table->double('percentage', 8, 2)->default(0);
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_results');
    }
}
