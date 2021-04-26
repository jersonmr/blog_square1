<?php

namespace Tests\Feature\Posts;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListsPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_see_the_list_of_posts()
    {
        $posts = Post::factory()
            ->count(2)
            ->create();

        $this->get(route('home'))
            ->assertStatus(200)
            ->assertSee($posts[0]->title)
            ->assertSee($posts[1]->title);
    }

    /** @test */
    public function it_can_see_the_posts_description()
    {
        $posts = Post::factory()
            ->count(2)
            ->create();

        $this->get(route('home'))
            ->assertStatus(200)
            ->assertSee($posts[0]->description)
            ->assertSee($posts[1]->description);
    }

    /** @test */
    public function it_can_see_the_posts_publication_date()
    {
        $posts = Post::factory()
            ->count(2)
            ->create();

        $this->get(route('home'))
            ->assertStatus(200)
            ->assertSee($posts[0]->publication_date->format('Y-m-d'))
            ->assertSee($posts[1]->publication_date->format('Y-m-d'));
    }
}
