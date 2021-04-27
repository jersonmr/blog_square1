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

    /** @test */
    public function authenticated_users_can_create_posts()
    {
        $user = User::factory()->create();

        $post = [
            'title' => 'Example post',
            'description' => 'This is an example post',
        ];

        $this->actingAs($user)
            ->post(route('posts.store'), $post)
            ->assertStatus(302)
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('posts', [
            'title' => 'Example post',
            'description' => 'This is an example post'
        ]);
    }

    /** @test */
    public function the_post_title_is_required()
    {
        $user = User::factory()->create();

        $post = [
            'title' => '',
            'description' => 'This is an example post'
        ];

        $this->actingAs($user)
            ->post(route('posts.store'), $post)
            ->assertSessionHasErrors(['title' => __('validation.required', ['attribute' => 'title'])]);

        $this->assertDatabaseMissing('posts', [
            'description' => 'This is an example post'
        ]);
    }

    /** @test */
    public function the_post_description_is_required()
    {
        $user = User::factory()->create();

        $post = [
            'title' => 'Example post',
            'description' => ''
        ];

        $this->actingAs($user)
            ->post(route('posts.store'), $post)->ray()
            ->assertSessionHasErrors(['description' => __('validation.required', ['attribute' => 'description'])]);

        $this->assertDatabaseMissing('posts', [
            'title' => 'Example post',
        ]);
    }
}
