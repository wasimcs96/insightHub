<?php

use Illuminate\Database\Migrations\Migration;   
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOpeningApplicationDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_opening_application_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_opening_id');
            $table->unsignedBigInteger('application_document_id')->nullable();
            $table->string('name');
            $table->string('type');
            $table->boolean('is_required');
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
        Schema::dropIfExists('job_opening_application_documents');
    }
}
