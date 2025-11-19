<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobIdAndTypeToMasterTechnicalSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_technical_skills', function (Blueprint $table) {
            $table->unsignedInteger('job_id')->after('updated_at'); // Add job_id column
            $table->tinyInteger('type')->default(0)->after('job_id'); // Add type column with default 0
        });
    }

    public function down()
    {
        Schema::table('master_technical_skills', function (Blueprint $table) {
            $table->dropColumn(['job_id', 'type']);
        });
    }
}
