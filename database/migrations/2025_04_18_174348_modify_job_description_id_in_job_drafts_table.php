<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyJobDescriptionIdInJobDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_drafts', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['job_id']);
            
            // Modify the column to be nullable
            $table->unsignedBigInteger('job_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_drafts', function (Blueprint $table) {
            // Re-add the foreign key constraint
            $table->unsignedBigInteger('job_id')->nullable(false)->change();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });
    }
}
