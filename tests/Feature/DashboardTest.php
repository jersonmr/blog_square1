<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_users_are_redirected_to_the_login_page()
    {
        $this->get('/dashboard')
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_users_are_redirected_to_the_dashboard()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertStatus(200)
            ->assertSee('Dashboard');
    }
}
