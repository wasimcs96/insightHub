<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('job_opening_applications', 'cover_letter')) {
                $table->text('cover_letter')->nullable()->after('tech_skill_score');
            }

            if (!Schema::hasColumn('job_opening_applications', 'application_status')) {
                $table->bigInteger('application_status')->nullable()->after('cover_letter');
            }
        });
    }

    public function down(): void
    {
        Schema::table('job_opening_applications', function (Blueprint $table) {
            if (Schema::hasColumn('job_opening_applications', 'cover_letter')) {
                $table->dropColumn('cover_letter');
            }

            if (Schema::hasColumn('job_opening_applications', 'application_status')) {
                $table->dropColumn('application_status');
            }
        });
    }
};
