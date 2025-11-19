<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOceanAllFacetsCombinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocean_all_facets_combinations', function (Blueprint $table) {
            $table->id();
            $table->string('facet')->nullable();
            $table->string('opposite_facet')->nullable();
            $table->string('ea')->nullable();
            $table->string('eb')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('ocean_all_facets_combinations');
    }
}
