<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $stats = [
                'total_users' => \App\Models\User::count(),
                'total_projects' => \App\Models\Project::count(),
                'total_tasks' => \App\Models\Task::count(),
                'pending_users' => \App\Models\User::where('role', 'default')->count(),
            ];
        } elseif ($user->isPM()) {
            $stats = [
                'my_projects' => \App\Models\Project::where('created_by', $user->id)->count(),
                'total_tasks' => \App\Models\Task::whereIn('project_id',
                    \App\Models\Project::where('created_by', $user->id)->pluck('id'))->count(),
                'completed_tasks' => \App\Models\Task::whereIn('project_id',
                    \App\Models\Project::where('created_by', $user->id)->pluck('id'))
                    ->where('status', 'completed')->count(),
            ];
        } else {
            $stats = [
                'my_tasks' => \App\Models\Task::where('assigned_to', $user->id)->count(),
                'completed_tasks' => \App\Models\Task::where('assigned_to', $user->id)
                    ->where('status', 'completed')->count(),
                'in_progress_tasks' => \App\Models\Task::where('assigned_to', $user->id)
                    ->where('status', 'in_progress')->count(),
            ];
        }

        return view('dashboard', compact('stats'));
    }
}
