<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToJobDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_drafts', function (Blueprint $table) {
            // Add the user_id column as nullable
            $table->unsignedBigInteger('user_id')->nullable()->after('job_id');
            
            // Optionally, if you want to add a foreign key constraint for user_id:
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
            // Drop the user_id column if we roll back the migration
            $table->dropColumn('user_id');
        });
    }
}
