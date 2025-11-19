<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDepartmentTechnicalSkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_technical_skills', function (Blueprint $table) {
            $table->id();  // Auto-increment primary key
            $table->unsignedBigInteger('master_technical_skill_id');  // Foreign key for master technical skill
            $table->unsignedBigInteger('department_id');  // Foreign key for job family
            $table->timestamps();  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_technical_skills');
    }
}
