<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
             $table->string('company_name');
            $table->string('business_registration_number')->nullable();
            $table->date('date_established')->nullable();
            $table->string('country')->nullable();
            $table->string('company_size')->nullable();
            $table->integer('number_of_employees')->nullable();
            $table->string('company_contact_number')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_website')->nullable();
            $table->string('industry_sector')->nullable();
            $table->string('sub_sector')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_logo')->nullable();
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
        Schema::dropIfExists('company_profiles');
    }
}
