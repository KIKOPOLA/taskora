<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardSidebarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_dashboard()
    {
        $this->actingAs(\App\Models\User::factory()->create())
            ->get('/dashboard')
            ->assertStatus(200);
    }

    /** @test */
    public function sidebar_visible_for_admin_pm_and_member()
    {
        foreach (['admin', 'pm', 'member'] as $role) {
            $user = \App\Models\User::factory()->create(['role' => $role]);

            $this->actingAs($user)
                ->get('/dashboard')
                ->assertStatus(200)
                ->assertSee('<aside id="dashboard-sidebar"', false)
                ->assertSee('fixed left-0', false)
                ->assertSee('Navigation')
                ->assertSee('Taskora Platform');
        }
    }
}
