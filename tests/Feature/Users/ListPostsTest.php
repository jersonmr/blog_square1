<?php

namespace Tests\Feature\Users;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_users_can_see_their_posts()
    {
        $user = User::factory()->create();

        Post::factory()
            ->count(2)
            ->state(new Sequence(
                ['title' => 'Post 1'],
                ['title' => 'Post 2'],
            ))
            ->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertSee('Post 1')
            ->assertSee('Post 2');
    }

    /** @test */
    public function authenticated_users_can_not_see_the_posts_from_the_other_users()
    {
        $user = User::factory()->create();

        Post::factory()
            ->count(2)
            ->state(new Sequence(
                ['title' => 'Post 1'],
                ['title' => 'Post 2'],
            ))
            ->create(['user_id' => $user->id]);

        Post::factory()
            ->for(User::factory())
            ->create(['title' => 'Post 3']);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertSee('Post 1')
            ->assertSee('Post 2')
            ->assertDontSee('Post 3');
    }
}
