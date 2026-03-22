<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
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
    public function view(User $user, Project $project): bool
    {
        // Admin dapat melihat semua project
        if ($user->role === 'admin') {
            return true;
        }

        // PM & Member hanya bisa lihat project yang mereka bagian dari
        return $project->members()->where('user_id', $user->id)->exists() ||
               $project->created_by === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya PM & Admin yang bisa membuat project
        return in_array($user->role, ['admin', 'pm']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        // Admin bisa update semua project
        if ($user->role === 'admin') {
            return true;
        }

        // PM hanya bisa update project yang dia buat
        if ($user->role === 'pm') {
            return $project->created_by === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        // Admin bisa delete semua project
        if ($user->role === 'admin') {
            return true;
        }

        // PM hanya bisa delete project yang dia buat
        if ($user->role === 'pm') {
            return $project->created_by === $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        return $user->role === 'admin';
    }
}
