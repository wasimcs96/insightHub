<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            if (!Schema::hasColumn('templates', 'tenant_id')) {
                $table->unsignedBigInteger('tenant_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('templates', 'module')) {
                $table->string('module', 150)->nullable()->after('tenant_id');
            }
            if (!Schema::hasColumn('templates', 'action_key')) {
                $table->string('action_key', 150)->nullable()->after('module');
            }
            if (!Schema::hasColumn('templates', 'body')) {
                $table->longText('body')->nullable()->after('subject');
            }
            if (!Schema::hasColumn('templates', 'placeholders')) {
                $table->json('placeholders')->nullable()->after('body');
            }
            if (!Schema::hasColumn('templates', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable()->after('placeholders');
            }

            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('templates', function (Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['tenant_id', 'module', 'action_key', 'body', 'placeholders', 'updated_by']);
        });
    }
};
