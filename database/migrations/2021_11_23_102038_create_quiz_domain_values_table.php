<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizDomainValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_domain_values', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            // $table->unsignedInteger('quiz_domain_id');
            $table->foreignId('quiz_domain_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('order');
            $table->string('color')->nullable();
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
        Schema::dropIfExists('quiz_domain_values');
    }
}
