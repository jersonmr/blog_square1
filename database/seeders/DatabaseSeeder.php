<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->create([
                'is_admin' => true,
                'name' => 'admin',
                'email' => 'admin@mail.test'
            ]);

        User::factory()
            ->has(Post::factory()->count(20))
            ->create(['name' => 'John Doe', 'email' => 'johndoe@mail.test']);
    }
}
