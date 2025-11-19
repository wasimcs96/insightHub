<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTechnicalSkillsCognitiveDomainKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_technical_skills_cognitive_domain_kas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_technical_skill_id');
            $table->string('name');
            $table->string('level');
            $table->text('level_description')->nullable();
            $table->enum('type', ['knowledge', 'ability'])->comment('knowledge or ability');
            $table->text('description')->nullable();
            $table->string('cognitive_domain_name');
            $table->string('cognitive_domain_short_name');
            $table->unsignedBigInteger('cognitive_domain_id');
            $table->timestamps();

            // Foreign key constraints (uncomment if related tables exist)
            // $table->foreign('master_technical_skill_id')->references('id')->on('master_technical_skills');
            // $table->foreign('cognitive_domain_id')->references('id')->on('cognitive_domains');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_technical_skills_cognitive_domain_kas');
    }
}

