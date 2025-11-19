<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('company_values', function (Blueprint $table) {
            $table->id();
            $table->string('company_value_name');
            $table->text('company_value_description');
            $table->json('facets')->nullable(); // JSON for multiple facets
            $table->text('developmental_stage_description');
            $table->text('basic_level_description');
            $table->text('intermediate_level_description');
            $table->text('advanced_level_description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_values');
    }
};
