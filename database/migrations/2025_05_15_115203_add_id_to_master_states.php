<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddIdToMasterStates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::table('master_states', function (Blueprint $table) {
    //         if (!Schema::hasColumn('master_states', 'id')) {
    //             $table->unsignedBigInteger('id')->nullable()->first();
    //         }
    //     });

    //     $states = DB::table('master_states')->get();
    //     $counter = 1;
    //     foreach ($states as $state) {
    //         DB::table('master_states')
    //             ->where('name', $state->name)
    //             ->where('country_id', $state->country_id)
    //             ->update(['id' => $counter++]);
    //     }

    //     Schema::table('master_states', function (Blueprint $table) {
    //         $table->unsignedBigInteger('id')->nullable(false)->change();
    //         $table->primary('id');
    //     });
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_states', function (Blueprint $table) {
            //
        });
    }
}
