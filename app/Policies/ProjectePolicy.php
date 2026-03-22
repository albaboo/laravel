<?php

namespace App\Policies;

use App\Models\Projecte;
use App\Models\User;
use App\Role;

class ProjectePolicy
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
    public function view(User $user, Projecte $projecte): bool
    {
        return match ($user->rol) {
            Role::ADMIN, Role::GESTOR => true,
            Role::DEVELOPER => $projecte->usuaris()->where('user_id', $user->id)->exists(),
            Role::CLIENT => $projecte->client()->first()->user()->first()->id === $user->id,
        };
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole([Role::ADMIN, Role::GESTOR]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Projecte $projecte): bool
    {
        return $user->hasAnyRole([Role::ADMIN, Role::GESTOR]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Projecte $projecte): bool
    {
        return $user->hasAnyRole([Role::ADMIN, Role::GESTOR]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Projecte $projecte): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Projecte $projecte): bool
    {
        return false;
    }
}
