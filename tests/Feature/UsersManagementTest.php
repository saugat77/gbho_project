<?php

namespace Tests\Feature;

use Tests\BaseTestWithAuthorization;

class UsersManagementTest extends BaseTestWithAuthorization
{
    /** @test */
    public function user_list_is_working()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($user = factory(\App\User::class)->create());
        $user->syncRoles('admin');

        $this->get(route('users.index'))->assertSuccessful();
    }

    /** @test */
    public function only_admin_can_reach_backend_users_controller()
    {
        $this->actingAs($user = factory(\App\User::class)->create());

        $user->syncRoles('customer');
        $this->get(route('users.index'))->assertForbidden();

        $user->syncRoles('seller');
        $this->get(route('users.index'))->assertForbidden();

        $user->syncRoles('admin');
        $this->get(route('users.index'))->assertSuccessful();
    }
}
