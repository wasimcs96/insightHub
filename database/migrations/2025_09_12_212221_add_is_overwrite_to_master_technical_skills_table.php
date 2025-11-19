<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsOverwriteToMasterTechnicalSkillsTable extends Migration
{
    public function up()
    {
        Schema::table('master_technical_skills', function (Blueprint $table) {
            $table->boolean('is_overwrite')->default(0)->after('is_custom'); // Replace 'some_column' with actual column after which you want to add
        });
    }

    public function down()
    {
        Schema::table('master_technical_skills', function (Blueprint $table) {
            $table->dropColumn('is_overwrite');
        });
    }
}
