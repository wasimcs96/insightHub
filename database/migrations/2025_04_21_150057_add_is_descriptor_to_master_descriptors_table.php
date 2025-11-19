<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDescriptorToMasterDescriptorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_descriptors', function (Blueprint $table) {
        $table->boolean('is_descriptor')->default(0)->after('analysis_population')->comment('1: Checked, 0: Unchecked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_descriptors', function (Blueprint $table) {
        $table->dropColumn('is_descriptor');
        });
    }
}
