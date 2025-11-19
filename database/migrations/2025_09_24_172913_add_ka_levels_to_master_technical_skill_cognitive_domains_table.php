<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('master_technical_skill_cognitive_domains', function (Blueprint $table) {
            $table->integer('qk_ka_level')->after('qk_ka_percentage');
            $table->integer('ck_ka_level')->after('ck_ka_percentage');
            $table->integer('vr_ka_level')->after('vr_ka_percentage');
            $table->integer('fr_ka_level')->after('fr_ka_percentage');
        });
    }

    public function down(): void
    {
        Schema::table('master_technical_skill_cognitive_domains', function (Blueprint $table) {
            $table->dropColumn([
                'qk_ka_level',
                'ck_ka_level',
                'vr_ka_level',
                'fr_ka_level'
            ]);
        });
    }
};