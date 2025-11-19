<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryStateCityToJobOpening extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_openings', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('job_openings', 'country_id')) {
                $table->unsignedBigInteger('country_id')->nullable()->after('vacancies');
            }

            if (!Schema::hasColumn('job_openings', 'city_id')) {
                $table->unsignedBigInteger('city_id')->nullable()->after('country_id');
            }

            if (!Schema::hasColumn('job_openings', 'state_id')) {
                $table->unsignedBigInteger('state_id')->nullable()->after('city_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_openings', function (Blueprint $table) {
            $table->dropColumn(['country_id', 'city_id', 'state_id']);
        });

    }
}
