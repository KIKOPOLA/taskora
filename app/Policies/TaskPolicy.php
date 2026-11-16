<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'pm', 'member']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        // Admin dapat melihat semua task
        if ($user->role === 'admin') {
            return true;
        }

        // PM yang membuat project bisa melihat semua task di project tersebut
        if ($user->role === 'pm' && $task->project->created_by === $user->id) {
            return true;
        }

        // Check if user is member of the project
        $isProjectMember = $task->project->members()->where('user_id', $user->id)->exists();
        $isProjectCreator = $task->project->created_by === $user->id;

        return $isProjectMember || $isProjectCreator;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya PM & Admin yang bisa membuat task
        return in_array($user->role, ['admin', 'pm']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        // Admin bisa update semua task
        if ($user->role === 'admin') {
            return true;
        }

        // PM bisa update task di project yang dia buat
        if ($user->role === 'pm') {
            return $task->project->created_by === $user->id;
        }

        // Member bisa update task jika dia yang di-assign
        if ($user->role === 'member') {
            return $task->assigned_to === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        // Admin bisa delete semua task
        if ($user->role === 'admin') {
            return true;
        }

        // PM hanya bisa delete task di project yang dia buat
        if ($user->role === 'pm') {
            return $task->project->created_by === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        return $user->role === 'admin';
    }
}
