<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleGrantTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();

        //Seed the database with roles
        foreach (config('authorization.roles') as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // now re-register all the roles and permissions (clears cache and reloads relations)
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }

    /** @test */
    public function it_can_assign_the_role_and_confirm_the_role_is_assigned()
    {
        $user = factory(\App\User::class)->create();

        $user->assignRole('customer');
        $this->assertTrue($user->hasRole('customer'));

        $user->assignRole('seller');
        $this->assertTrue($user->hasRole('seller'));

        $user->assignRole('admin');
        $this->assertTrue($user->hasRole('admin'));

        $this->assertTrue($user->hasAllRoles(['admin', 'seller', 'customer']));
    }
}
