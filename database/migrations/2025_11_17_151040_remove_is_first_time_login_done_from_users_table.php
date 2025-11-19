<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveIsFirstTimeLoginDoneFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'is_first_time_login_done')) {
                $table->dropColumn('is_first_time_login_done');
            }
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_first_time_login_done')->default(false);
        });
    }
}
