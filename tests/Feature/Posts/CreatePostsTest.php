<?php

namespace Tests\Feature\Posts;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_users_can_not_see_the_create_post_page()
    {
        $this->get(route('posts.create'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_users_can_not_create_posts()
    {
        $post = [
            'title' => 'Example post',
            'description' => 'This is an example post'
        ];

        $this->post(route('posts.store'), $post)
            ->assertRedirect(route('login'));

        $this->assertDatabaseMissing('posts', [
            'title' => 'Example post',
            'description' => 'This is an example post'
        ]);
    }

    /** @test */
    public function authenticated_users_can_see_the_create_post_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('posts.create'))
            ->assertStatus(200)
            ->assertViewIs('posts.create');
    }
}
