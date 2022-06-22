<?php

namespace Tests\Feature;

use Tests\BaseTestWithAuthorization;

class CategoryTest extends BaseTestWithAuthorization
{
    protected $baseUrl = '/backend/categories';

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
    public function category_index_page_is_working()
    {
        $response = $this->get($this->baseUrl);
        $response->assertStatus(200)
        ->assertSee('Categories');
    }

    /** @test */
    public function category_slug_is_automatically_generated_and_default_status_is_active()
    {
        $this->withoutExceptionHandling();
        $response = $this->post($this->baseUrl, [
            'name' => 'test category',
        ]);
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('categories', ['name' => 'test category', 'slug' => 'test-category', 'active' => true]);
    }

    /** @test */
    public function category_update_is_working()
    {
        $this->withoutExceptionHandling();

        factory(\App\Category::class)->create(['slug' => 'test']);

        $this->assertDatabaseHas('categories', ['slug' => 'test']);

        $this->get($this->baseUrl . '/test/edit')->assertSuccessful();

        $this->put($this->baseUrl . '/test', ['name' => 'new cat', 'slug' => 'new-slug'])
            ->assertSessionHas('success');
        $this->assertDatabaseHas('categories', ['name' => 'new cat', 'slug' => 'new-slug']);
    }
}
