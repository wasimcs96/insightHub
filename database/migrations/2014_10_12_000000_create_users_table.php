<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('is_personality_motivation_completed')->default(0); # 0 = Not given; 1 = Given
            $table->integer('is_work_interest_completed')->default(0); # 0 = Not given; 1 = Given (Work interest and career explorer is same)
            $table->integer('is_english_proficiency_completed')->default(0); # 0 = Not given; 1 = Given
            $table->integer('is_work_values_completed')->default(0); # 0 = Not given; 1 = Given
            $table->integer('is_employability_completed')->default(0); # 0 = Not given; 1 = Given
            $table->integer('is_future_of_work_completed')->default(0); # 0 = Not given; 1 = Given
            $table->integer('is_cognitive_ability_completed')->default(0); # 0 = Not given; 1 = Given
            $table->date('birth_date'); # default date format is 'YYYY-MM-DD'
            $table->string('education_level');
            $table->string('scope_of_study');
            $table->string('do_you_have_experience_in_it_sector'); # 0 = No and 1 = Yes
            $table->string('year_of_experience_in_it_sector');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
