<?php

namespace Tests\Feature;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhotosTest extends TestCase
{

    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = User::factory()->create([
            'balance' => 30000
        ]);
    }

    private function seedPhotos()
    {
        $users = User::factory(10)->create();
        foreach($users as $user) {
            Photo::factory(4)->create(['user_id'=> $user->id, 'artist_id' => $user->id]);
        }
    }
    public function test_user_cant_see_edit_button_on_other_users_photos()
    {
        $this->seedPhotos();
        $response = $this->actingAs($this->user)->get('/photos');
        $response->assertDontSee('EDIT');
    }

    public function test_user_cant_edit_other_users_photos()
    {
        $this->seedPhotos();
        $response = $this->actingAs($this->user)->get('photos/20/edit');
        $response->assertStatus(403);
    }

    public function test_user_can_create_new_photo()
    {
        $response = $this->actingAs($this->user)->get('photos/create');
        $response->assertStatus(200);
        $response->assertSee('Save');
    }

    public function test_user_can_see_buy_button_on_photos()
    {
        $this->seedPhotos();
        $response = $this->actingAs($this->user)->get('photos');
        $response->assertStatus(200);
        $response->assertSee('Buy');
    }

}
