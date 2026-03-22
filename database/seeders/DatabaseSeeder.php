<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create demo users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@taskora.com',
            'password' => Hash::make('Admin123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        $pm = User::create([
            'name' => 'Project Manager',
            'email' => 'pm@taskora.com',
            'password' => Hash::make('Pm123'),
            'role' => 'pm',
            'is_active' => true,
        ]);

        $member = User::create([
            'name' => 'Team Member',
            'email' => 'member@taskora.com',
            'password' => Hash::make('Member123'),
            'role' => 'member',
            'is_active' => true,
        ]);

        // Create sample project
        $project = \App\Models\Project::create([
            'name' => 'Website Redesign',
            'description' => 'Redesign the company website with modern UI/UX',
            'created_by' => $pm->id,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonths(3)->toDateString(),
            'status' => 'ongoing',
        ]);

        // Add PM as creator + member, and member user
        $project->members()->attach([$pm->id, $member->id]);

        // Create sample task
        $task = \App\Models\Task::create([
            'project_id' => $project->id,
            'title' => 'Design Homepage Layout',
            'description' => 'Create a modern homepage layout with responsive design',
            'assigned_to' => $member->id,
            'status' => 'in_progress',
            'priority' => 'high',
            'due_date' => now()->addWeeks(2),
        ]);

        // Create sample task update
        $task->updates()->create([
            'updated_by' => $member->id,
            'notes' => 'Started working on homepage layout. Created initial wireframes and color schemes.',
            'status' => 'in_progress',
            'image_path' => null,
        ]);
    }
}
