<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']); // Drop foreign key constraint if exists
            $table->dropColumn('tenant_id');
            $table->string('slug')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->foreignId('tenant_id')->after('id')->constrained()->onDelete('cascade');
        });
    }
};