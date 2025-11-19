<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_domains', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('order');
            $table->string('color')->nullable();
            $table->json('low')->nullable();
            $table->json('moderate')->nullable();
            $table->json('high')->nullable();
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
        Schema::dropIfExists('quiz_domains');
    }
}
