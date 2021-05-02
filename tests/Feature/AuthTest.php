<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = User::factory()->create();
    }

    public function test_login_redirects_successfully()
    {

        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function test_authenticated_user_can_access_photos_list()
    {
        $response = $this->actingAs($this->user)->get('/photos');

        $response->assertStatus(200);

    }

    public function test_unauthenticated_user_cannot_access_photos_list()
    {
        $response = $this->get('/photos');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}