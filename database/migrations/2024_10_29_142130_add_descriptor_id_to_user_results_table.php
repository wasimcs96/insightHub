<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptorIdToUserResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_results', function (Blueprint $table) {
            $table->unsignedBigInteger('descriptor_id')->nullable()->after('code'); // Replace 'column_name' with the column you want to add this after, or remove 'after' if not needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_results', function (Blueprint $table) {
            $table->dropColumn('descriptor_id');
        });
    }
}
