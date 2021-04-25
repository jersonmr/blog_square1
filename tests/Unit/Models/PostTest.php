<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_belongs_to_an_user()
    {
        $post = Post::factory()
            ->for(User::factory())
            ->create();

        $this->assertInstanceOf(User::class, $post->user);
    }
}
