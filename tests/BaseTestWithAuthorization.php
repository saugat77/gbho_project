<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class BaseTestWithAuthorization extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    public function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();

        // Seed the database with roles
        foreach (config('authorization.roles') as $role) {
            \Spatie\Permission\Models\Role::firstOrCreate(['name' => $role]);
        }

        // now re-register all the roles and permissions (clears cache and reloads relations)
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
    }
}
