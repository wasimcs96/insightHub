<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('days_per_year');
            $table->text('entitlement')->nullable();
            $table->enum('eligibility', ['A', 'F', 'M']);
            $table->text('purpose')->nullable();
            $table->boolean('cumulative')->default(false);
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
        Schema::dropIfExists('master_leaves');
    }
}
