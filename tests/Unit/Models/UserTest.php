<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_user_has_many_posts()
    {
        $user = User::factory()
            ->has(Post::factory())
            ->create();

        $this->assertInstanceOf(Post::class, $user->posts->first());
    }
}
