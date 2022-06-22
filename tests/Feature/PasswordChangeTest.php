<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\BaseTestWithAuthorization;

class PasswordChangeTest extends BaseTestWithAuthorization
{
    use RefreshDatabase;

    // A user having no password
    // Validate new passwords
    // updated successfully 

    // A user having password
    // Validate old and new passwords
    // Check the password match
    // updated successfully 

    /** @test */
    public function it_does_not_ask_for_old_password_for_oauth_users_with_no_password_set()
    {
        $user = factory(\App\User::class)->create([
            'password' => ''
        ]); 
        $this->actingAs($user);

        $response = $this->patch('/change-password', [
            'password' => 'newpass',
            'password_confirmation' => 'newpass'
        ]);

        $response->assertSessionHasNoErrors();
    }


    /** @test */
    public function oauth_users_with_no_password_set_new_password()
    {
        $user = factory(\App\User::class)->create([
            'password' => ''
        ]);
        $this->actingAs($user);

        $response = $this->patch('/change-password', [
            'password' => 'newpass',
            'password_confirmation' => 'newpass'
        ]);

        $this->assertTrue(Hash::check('newpass', $user->password));
        $response->assertRedirect();
    }

    /** @test */
    public function old_password_must_match_while_changing_password()
    {
        $user = factory(\App\User::class)->create([
            'password' => bcrypt('oldpass')
        ]);
        $this->actingAs($user);

        $response = $this->patch('/change-password', [
            'old_password' => 'wrongpassword',
            'password' => 'newpass',
            'password_confirmation' => 'newpass'
        ]);

        $response->assertSessionHasErrors(['old_password']);
    }

    /** @test */
    public function user_with_password_can_change_password()
    {
        $user = factory(\App\User::class)->create([
            'password' => Hash::make('oldpass')
        ]);
        $this->actingAs($user);

        $response = $this->patch('/change-password', [
            'old_password' => 'oldpass',
            'password' => 'newpass',
            'password_confirmation' => 'newpass'
        ]);

        $this->assertTrue(Hash::check('newpass', $user->password));
        $response->assertRedirect();
    }
}
