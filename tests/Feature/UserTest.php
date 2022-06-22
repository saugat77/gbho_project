<?php

namespace Tests\Feature;

use App\User;
use Biscolab\ReCaptcha\Facades\ReCaptcha;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\BaseTestWithAuthorization;

class UserTest extends BaseTestWithAuthorization
{
    use RefreshDatabase;

    public function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();
    }

    private function userData()
    {
        return [
            'name' => 'test user',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
    }

    /** @test */
    public function newly_registered_user_have_a_default_role_of_customer()
    {
        // Validate ReCaptcha
        ReCaptcha::shouldReceive('validate')
            ->once()
            ->andReturnTrue();

        $this->post('/register', $this->userData());

        $this->assertDatabaseHas('users', ['email' => 'test@test.com']);
        $user = User::whereEmail('test@test.com')->first();
        $this->assertFalse($user->hasRole('admin'));
        $this->assertFalse($user->hasRole('seller'));
        $this->assertTrue($user->hasRole('customer'));
    }

    /** @test */
    public function user_can_login()
    {
        $user = factory(\App\User::class)->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->assertAuthenticated();
    }

    /** @test */
    public function admin_is_redirected_to_backend_dashboard()
    {
        $user = factory(\App\User::class)->create();
        $user->assignRole(['admin']);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect(\App\Providers\RouteServiceProvider::BACKEND_DASHBOARD);
    }

    /** @test */
    public function seller_is_redirected_to_backend_dashboard()
    {
        $user = factory(\App\User::class)->create();
        $user->assignRole(['seller']);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect(\App\Providers\RouteServiceProvider::BACKEND_DASHBOARD);
    }

    /** @test */
    public function customer_is_redirected_to_home()
    {
        $user = factory(\App\User::class)->create();
        $user->assignRole(['customer']);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect(\App\Providers\RouteServiceProvider::HOME);
    }
}
