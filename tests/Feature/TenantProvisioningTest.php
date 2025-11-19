<?php

namespace Tests\Feature;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantProvisioningTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test data
        $this->createTestData();
    }

    protected function createTestData()
    {
        // Create a plan
        $plan = Plan::create([
            'title' => 'Basic Plan',
            'slug' => 'basic-plan',
        ]);

        // Create modules
        $module1 = Module::create([
            'name' => 'User Management',
            'slug' => 'user-management',
        ]);

        $module2 = Module::create([
            'name' => 'Reports',
            'slug' => 'reports',
        ]);

        // Associate modules with plan
        $plan->modules()->attach([$module1->id, $module2->id]);

        // Create system roles
        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'guard_name' => 'web',
            'description' => 'System Administrator',
            'is_system_role' => 1,
            'is_default' => 1,
            'level' => 1,
            'tenant_id' => null,
        ]);

        Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'guard_name' => 'web',
            'description' => 'Regular User',
            'is_system_role' => 1,
            'is_default' => 0,
            'level' => 2,
            'tenant_id' => null,
        ]);

        // Create system permissions
        Permission::create([
            'module_id' => $module1->id,
            'name' => 'view-users',
            'display_name' => 'View Users',
            'guard_name' => 'web',
            'section' => 'users',
            'permission_type' => 'read',
            'is_system_permission' => 1,
        ]);

        Permission::create([
            'module_id' => $module1->id,
            'name' => 'create-users',
            'display_name' => 'Create Users',
            'guard_name' => 'web',
            'section' => 'users',
            'permission_type' => 'create',
            'is_system_permission' => 1,
        ]);

        Permission::create([
            'module_id' => $module2->id,
            'name' => 'view-reports',
            'display_name' => 'View Reports',
            'guard_name' => 'web',
            'section' => 'reports',
            'permission_type' => 'read',
            'is_system_permission' => 1,
        ]);
    }

    /** @test */
    public function it_can_provision_a_new_tenant_successfully()
    {
        $plan = Plan::first();
        
        $response = $this->postJson('/admin/tenant-provisioning', [
            'tenant' => [
                'name' => 'Test Company',
                'email' => 'info@testcompany.com',
                'domain' => 'testcompany',
                'country' => 'Malaysia',
                'address' => '123 Test Street',
                'industry' => 'Technology',
                'status' => 'active',
                'contact_person_name' => 'John Doe',
                'is_parent_company' => true,
                'is_subsidiary_company' => false,
            ],
            'subscription_plan_id' => $plan->id,
            'admin_user' => [
                'name' => 'Admin User',
                'email' => 'admin@testcompany.com',
                'mobile_number' => '1234567890',
            ],
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
            ]);

        // Assert tenant was created
        $this->assertDatabaseHas('tenants', [
            'name' => 'Test Company',
            'email' => 'info@testcompany.com',
            'domain' => 'testcompany',
            'status' => 'active',
        ]);

        // Assert admin user was created
        $this->assertDatabaseHas('users', [
            'name' => 'Admin User',
            'email' => 'admin@testcompany.com',
            'is_admin' => 1,
        ]);

        // Assert tenant plan was assigned
        $tenant = Tenant::where('email', 'info@testcompany.com')->first();
        $this->assertDatabaseHas('tenant_plans', [
            'tenant_id' => $tenant->id,
            'plan_id' => $plan->id,
        ]);
    }

    /** @test */
    public function it_can_provision_a_subsidiary_tenant()
    {
        // Create parent tenant
        $parentTenant = Tenant::create([
            'name' => 'Parent Company',
            'email' => 'parent@example.com',
            'domain' => 'parent-company',
            'slug' => 'parent-company',
            'country' => 'Malaysia',
            'address' => 'Parent Address',
            'industry' => 'Technology',
            'status' => 'active',
            'contact_person_name' => 'Parent Contact',
        ]);

        $plan = Plan::first();

        $response = $this->postJson('/admin/tenant-provisioning', [
            'tenant' => [
                'name' => 'Subsidiary Company',
                'email' => 'subsidiary@example.com',
                'domain' => 'subsidiary-company',
                'country' => 'Malaysia',
                'address' => 'Subsidiary Address',
                'industry' => 'Technology',
                'status' => 'active',
                'contact_person_name' => 'Subsidiary Contact',
                'is_parent_company' => false,
                'is_subsidiary_company' => true,
                'parent_tenant_id' => $parentTenant->id,
            ],
            'subscription_plan_id' => $plan->id,
            'admin_user' => [
                'name' => 'Subsidiary Admin',
                'email' => 'admin@subsidiary.com',
                'mobile_number' => '0987654321',
            ],
        ]);

        $response->assertStatus(201);

        // Assert subsidiary tenant was created with parent relationship
        $this->assertDatabaseHas('tenants', [
            'name' => 'Subsidiary Company',
            'email' => 'subsidiary@example.com',
            'parent_tenant_id' => $parentTenant->id,
        ]);
    }

    /** @test */
    public function it_validates_required_tenant_fields()
    {
        $response = $this->postJson('/admin/tenant-provisioning', [
            'tenant' => [
                'name' => '', // Empty name
                'email' => 'invalid-email', // Invalid email
            ],
            'subscription_plan_id' => 999, // Non-existent plan
            'admin_user' => [
                'name' => '',
                'email' => '',
            ],
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'tenant.name',
                'tenant.email',
                'tenant.domain',
                'tenant.country',
                'tenant.address',
                'tenant.industry',
                'tenant.contact_person_name',
                'subscription_plan_id',
                'admin_user.name',
                'admin_user.email',
            ]);
    }

    /** @test */
    public function it_validates_unique_tenant_email_and_domain()
    {
        $plan = Plan::first();

        // Create first tenant
        $this->postJson('/admin/tenant-provisioning', [
            'tenant' => [
                'name' => 'First Company',
                'email' => 'duplicate@example.com',
                'domain' => 'duplicate-domain',
                'country' => 'Malaysia',
                'address' => 'Address',
                'industry' => 'Technology',
                'status' => 'active',
                'contact_person_name' => 'Contact',
            ],
            'subscription_plan_id' => $plan->id,
            'admin_user' => [
                'name' => 'Admin',
                'email' => 'admin1@example.com',
                'mobile_number' => '1234567890',
            ],
        ]);

        // Try to create second tenant with same email and domain
        $response = $this->postJson('/admin/tenant-provisioning', [
            'tenant' => [
                'name' => 'Second Company',
                'email' => 'duplicate@example.com', // Duplicate email
                'domain' => 'duplicate-domain', // Duplicate domain
                'country' => 'Malaysia',
                'address' => 'Address',
                'industry' => 'Technology',
                'status' => 'active',
                'contact_person_name' => 'Contact',
            ],
            'subscription_plan_id' => $plan->id,
            'admin_user' => [
                'name' => 'Admin',
                'email' => 'admin2@example.com',
                'mobile_number' => '1234567890',
            ],
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['tenant.email', 'tenant.domain']);
    }

    /** @test */
    public function it_validates_parent_tenant_must_be_active()
    {
        // Create inactive parent tenant
        $inactiveParent = Tenant::create([
            'name' => 'Inactive Parent',
            'email' => 'inactive@example.com',
            'domain' => 'inactive-parent',
            'slug' => 'inactive-parent',
            'country' => 'Malaysia',
            'address' => 'Address',
            'industry' => 'Technology',
            'status' => 'inactive', // Inactive status
            'contact_person_name' => 'Contact',
        ]);

        $plan = Plan::first();

        $response = $this->postJson('/admin/tenant-provisioning', [
            'tenant' => [
                'name' => 'Subsidiary Company',
                'email' => 'subsidiary@example.com',
                'domain' => 'subsidiary-company',
                'country' => 'Malaysia',
                'address' => 'Address',
                'industry' => 'Technology',
                'status' => 'active',
                'contact_person_name' => 'Contact',
                'is_parent_company' => false,
                'is_subsidiary_company' => true,
                'parent_tenant_id' => $inactiveParent->id,
            ],
            'subscription_plan_id' => $plan->id,
            'admin_user' => [
                'name' => 'Admin',
                'email' => 'admin@subsidiary.com',
                'mobile_number' => '1234567890',
            ],
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['tenant.parent_tenant_id']);
    }

    /** @test */
    public function it_creates_roles_for_new_tenant()
    {
        $plan = Plan::first();

        $response = $this->postJson('/admin/tenant-provisioning', [
            'tenant' => [
                'name' => 'Test Company',
                'email' => 'test@example.com',
                'domain' => 'test-company',
                'country' => 'Malaysia',
                'address' => 'Address',
                'industry' => 'Technology',
                'status' => 'active',
                'contact_person_name' => 'Contact',
            ],
            'subscription_plan_id' => $plan->id,
            'admin_user' => [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'mobile_number' => '1234567890',
            ],
        ]);

        $response->assertStatus(201);

        $tenant = Tenant::where('email', 'test@example.com')->first();
        
        // Assert roles were created for this tenant
        $this->assertTrue($tenant->roles()->count() > 0);
        
        // Assert system roles were copied
        $systemRolesCount = Role::where('is_system_role', 1)->where('tenant_id', null)->count();
        $tenantRolesCount = $tenant->roles()->count();
        
        $this->assertEquals($systemRolesCount, $tenantRolesCount);
    }

    /** @test */
    public function it_can_get_available_plans()
    {
        $response = $this->getJson('/admin/tenant-provisioning/plans');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'slug',
                        'modules',
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_can_get_parent_tenants()
    {
        // Create some active tenants
        Tenant::create([
            'name' => 'Active Parent 1',
            'email' => 'parent1@example.com',
            'domain' => 'parent1',
            'slug' => 'parent1',
            'country' => 'Malaysia',
            'address' => 'Address',
            'industry' => 'Technology',
            'status' => 'active',
            'contact_person_name' => 'Contact',
        ]);

        Tenant::create([
            'name' => 'Active Parent 2',
            'email' => 'parent2@example.com',
            'domain' => 'parent2',
            'slug' => 'parent2',
            'country' => 'Singapore',
            'address' => 'Address',
            'industry' => 'Finance',
            'status' => 'active',
            'contact_person_name' => 'Contact',
        ]);

        $response = $this->getJson('/admin/tenant-provisioning/parent-tenants');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'domain',
                        'country',
                        'industry',
                    ],
                ],
            ]);

        // Assert only active tenants are returned
        $data = $response->json('data');
        $this->assertGreaterThanOrEqual(2, count($data));
    }
}
