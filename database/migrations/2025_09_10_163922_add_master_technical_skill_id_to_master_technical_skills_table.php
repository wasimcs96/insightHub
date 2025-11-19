<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMasterTechnicalSkillIdToMasterTechnicalSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        Schema::table('master_technical_skills', function (Blueprint $table) {
            $table->unsignedBigInteger('master_technical_skill_id')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('master_technical_skills', function (Blueprint $table) {
            $table->dropColumn('master_technical_skill_id');
        });
    }
}
