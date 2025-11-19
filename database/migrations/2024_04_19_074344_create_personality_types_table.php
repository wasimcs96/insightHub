<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personality_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('dimension_one');
            $table->integer('dimension_two');
            $table->text('descriptions')->nullable();
            $table->string('personality_name');
            $table->timestamps();  // Optionally add created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personality_types');
    }
}
