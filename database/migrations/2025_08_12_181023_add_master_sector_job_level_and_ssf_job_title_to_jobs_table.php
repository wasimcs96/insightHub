<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMasterSectorJobLevelAndSsfJobTitleToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('master_sector_id')->nullable()->after('education_level');
            $table->unsignedBigInteger('master_sub_sector_id')->nullable()->after('master_sector_id');
            $table->string('job_level', 100)->nullable()->after('master_sub_sector_id');
            $table->text('ssf_job_title')->nullable()->after('job_level'); // You can use mediumText if expecting more than 65,535 chars
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn([
                'master_sector_id',
                'master_sub_sector_id',
                'job_level',
                'ssf_job_title'
            ]);
        });
    }
}
