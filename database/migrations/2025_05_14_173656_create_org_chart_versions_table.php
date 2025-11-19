<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgChartVersionsTable extends Migration
{
    public function up()
    {
        Schema::create('org_chart_versions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id')->index();
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->unsignedInteger('version_number')->default(1);
            $table->json('old_json');
            $table->json('new_json');
            $table->timestamp('reverted_at')->nullable();
            $table->unsignedBigInteger('reverted_by')->nullable();
            $table->timestamps();

            // FKs
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('reverted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('org_chart_versions');
    }
}
