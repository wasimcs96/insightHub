<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('technical_question_user_responses', function (Blueprint $table) {
            if (!Schema::hasColumn('technical_question_user_responses', 'is_correct')) {
                $table->integer('is_correct')->nullable()->after('option_selected');
            }
        });
    }

    public function down(): void
    {
        Schema::table('technical_question_user_responses', function (Blueprint $table) {
            if (Schema::hasColumn('technical_question_user_responses', 'is_correct')) {
                $table->dropColumn('is_correct');
            }
        });
    }
};
