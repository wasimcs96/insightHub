<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryNameToJobProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('job_profiles', function (Blueprint $table) {
        $table->string('category_name')->nullable(); // varchar(255) by default
    });
}

public function down()
{
    Schema::table('job_profiles', function (Blueprint $table) {
        $table->dropColumn('category_name');
    });
}
}
