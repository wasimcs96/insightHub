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
        Schema::table('tenants', function (Blueprint $table) {
            // Add parent_tenant_id for subsidiary relationship
            $table->foreignId('parent_tenant_id')->nullable()->after('id')->constrained('tenants')->onDelete('restrict');
            
            // Add contact and business information fields
            $table->string('country')->nullable()->after('subdomain');
            $table->text('address')->nullable()->after('country');
            $table->string('industry')->nullable()->after('address');
            $table->string('contact_person_name')->nullable()->after('industry');
            $table->string('mobile_number')->nullable()->after('contact_person_name');
            
            // Add indexes for performance
            $table->index('parent_tenant_id');
            $table->index('country');
            $table->index('industry');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropForeign(['parent_tenant_id']);
            $table->dropIndex(['parent_tenant_id']);
            $table->dropIndex(['country']);
            $table->dropIndex(['industry']);
            $table->dropColumn([
                'parent_tenant_id',
                'country',
                'address',
                'industry',
                'contact_person_name',
                'mobile_number'
            ]);
        });
    }
};
