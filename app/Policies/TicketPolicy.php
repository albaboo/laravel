<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use App\Role;

class TicketPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        return match ($user->rol) {
            Role::ADMIN => true,
            Role::GESTOR => true,
            Role::DEVELOPER => $ticket->projecte()->first()->users()->where('usuari_id', $user->id)->exists(),
            Role::CLIENT => $ticket->projecte()->first()->client()->first()->user()->first()->id === $user->id,
        };
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
    public function update(User $user, Ticket $ticket): bool
    {
        return match ($user->rol) {
            Role::ADMIN => true,
            Role::GESTOR => true,
            Role::DEVELOPER => $ticket->projecte()->first()->users()->where('usuari_id', $user->id)->exists(),
            Role::CLIENT => false,
        };
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->hasAnyRole([Role::ADMIN, Role::GESTOR]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ticket $ticket): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ticket $ticket): bool
    {
        return false;
    }
}
