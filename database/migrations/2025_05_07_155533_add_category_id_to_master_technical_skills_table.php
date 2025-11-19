<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToMasterTechnicalSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_technical_skills', function (Blueprint $table) {
        $table->unsignedBigInteger('category_id')->after('sector_id')->nullable();
        $table->unsignedBigInteger('is_custom')->default(0)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_technical_skills', function (Blueprint $table) {
        $table->dropColumn('category_id');
        $table->dropColumn('is_custom');

        });
    }
}
