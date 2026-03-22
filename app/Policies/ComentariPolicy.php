<?php

namespace App\Policies;

use App\Models\Comentari;
use App\Models\User;
use App\Role;

class ComentariPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comentari $comentari): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comentari $comentari): bool
    {
        return $comentari->autor()->first()->id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comentari $comentari): bool
    {
        if ($user->hasAnyRole([Role::ADMIN, Role::GESTOR]))
            return true;
        return $comentari->autor()->first()->id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Comentari $comentari): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Comentari $comentari): bool
    {
        return false;
    }
}
