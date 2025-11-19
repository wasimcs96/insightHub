<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_technical_skill_cognitive_domains', function (Blueprint $table) {
            $table->id();
            
            // Foreign key with explicit constraint name
            $table->unsignedBigInteger('master_technical_skill_id');
            $table->foreign('master_technical_skill_id')
                  ->references('id')
                  ->on('master_technical_skills')
                  ->onDelete('cascade')
                  ->constrained()
                  ->name('mts_cd_master_technical_skill_id_foreign');

            // Name field
            $table->string('name');

            // Level field
            $table->integer('level');

            // Knowledge Ability Counts
            $table->integer('qk_ka_count')->default(0)->comment('Quantitative knowledge knowledge ability count');
            $table->integer('ck_ka_count')->default(0)->comment('Comprehension knowledge knowledge ability count');
            $table->integer('vr_ka_count')->default(0)->comment('Visual reasoning knowledge ability count');
            $table->integer('fr_ka_count')->default(0)->comment('Fluid reasoning knowledge ability count');
            $table->integer('ka_total_count')->default(0);

            // Knowledge Ability Percentages
            $table->decimal('qk_ka_percentage', 5, 2)->default(0)->comment('Quantitative knowledge knowledge ability percentage');
            $table->decimal('ck_ka_percentage', 5, 2)->default(0)->comment('Comprehension knowledge knowledge ability percentage');
            $table->decimal('vr_ka_percentage', 5, 2)->default(0)->comment('Visual reasoning knowledge ability percentage');
            $table->decimal('fr_ka_percentage', 5, 2)->default(0)->comment('Fluid reasoning knowledge ability percentage');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_technical_skill_cognitive_domains');
    }
};