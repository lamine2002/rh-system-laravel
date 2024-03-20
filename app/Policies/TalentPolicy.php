<?php

namespace App\Policies;

use App\Models\Talent;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TalentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to view talents.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Talent $talent): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to view this talent.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to create talents.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Talent $talent): Response
    {
        return $user->role === 'admin' || $user->role === 'manager' || $user->talent_id === $talent->id
            ? Response::allow()
            : Response::deny('You are not authorized to update this talent.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Talent $talent): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to delete this talent.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Talent $talent): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to restore this talent.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Talent $talent): bool
    {
        return false;
    }
}
