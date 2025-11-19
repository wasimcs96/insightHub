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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'employee_code')) {
                $table->string('employee_code')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'job_position')) {
                $table->string('job_position')->nullable()->after('employee_code');
            }
            if (!Schema::hasColumn('users', 'department')) {
                $table->string('department')->nullable()->after('job_position');
            }
            if (!Schema::hasColumn('users', 'onboarding_email_status')) {
                $table->enum('onboarding_email_status', ['Sent', 'Pending'])->default('Pending')->after('department');
            }
            if (!Schema::hasColumn('users', 'profile_picture')) {
                $table->string('profile_picture')->nullable()->after('onboarding_email_status');
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('profile_picture');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'employee_code',
                'job_position',
                'department',
                'onboarding_email_status',
                'profile_picture',
                'is_active'
            ]);
        });
    }
};
