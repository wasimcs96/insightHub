<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('job_subordinates', function (Blueprint $table) {
            if (!Schema::hasColumn('job_subordinates', 'created_at') && !Schema::hasColumn('job_subordinates', 'updated_at')) {
                $table->timestamps();
            }
        });
    }

    public function down(): void
    {
        Schema::table('job_subordinates', function (Blueprint $table) {
            if (Schema::hasColumn('job_subordinates', 'created_at')) {
                $table->dropColumn('created_at');
            }

            if (Schema::hasColumn('job_subordinates', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
