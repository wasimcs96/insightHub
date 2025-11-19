<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToJobOpeningApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->dateTime('applied_date')->nullable();
            $table->dateTime('offered_date')->nullable();
            $table->dateTime('offer_accepted_date')->nullable();
            $table->dateTime('status_changed_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            $table->dropColumn([
                'status_changed_date',
                'offer_accepted_date',
                'offered_date',
                'applied_date',
            ]);
        });
    }
}
