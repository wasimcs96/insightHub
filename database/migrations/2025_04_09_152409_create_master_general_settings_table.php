<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // For example: 'site_name', 'logo', 'favicon'
            $table->string('value')->nullable(); // Can store image path or text value
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
        Schema::dropIfExists('master_general_settings');
    }
}
