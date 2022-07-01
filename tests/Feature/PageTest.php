<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\BaseTestWithAuthorization;

class PageTest extends BaseTestWithAuthorization
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();

        $user = \App\User::create([
            'name' => 'test user',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $user->syncRoles('admin');

        $this->actingAs($user);
    }

    /** @test */
    public function it_can_create_a_new_page()
    {
        $response = $this->get(route('pages.create-or-edit'));
        $response->assertSuccessful();
    }
}
