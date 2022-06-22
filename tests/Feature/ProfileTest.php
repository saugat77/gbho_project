<?php

namespace Tests\Feature;

use Tests\BaseTestWithAuthorization;

class ProfileTest extends BaseTestWithAuthorization
{
    /** @test */
    public function only_allow_authenticated_user()
    {
        $this->get('/profile')->assertRedirect('/login');

        $user = factory(\App\User::class)->create();
        $user->syncRoles('customer');
        $this->actingAs($user);

        $this->get('/profile')->assertSuccessful();
    }
}
