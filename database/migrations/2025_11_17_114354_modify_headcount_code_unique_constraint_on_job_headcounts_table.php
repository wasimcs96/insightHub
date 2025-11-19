<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyHeadcountCodeUniqueConstraintOnJobHeadcountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_headcounts', function (Blueprint $table) {
            // Drop the existing unique constraint on headcount_code
            $table->dropUnique('job_headcounts_headcount_code_unique');
            
            // Add composite unique constraint on tenant_id + headcount_code
            $table->unique(['tenant_id', 'headcount_code'], 'unique_tenant_headcount_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_headcounts', function (Blueprint $table) {
            // Drop the composite unique constraint
            $table->dropUnique('unique_tenant_headcount_code');
            
            // Restore the original unique constraint on headcount_code
            $table->unique('headcount_code', 'job_headcounts_headcount_code_unique');
        });
    }
}
