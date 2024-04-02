<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to view teams.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): Response
    {
        return $user->role === 'admin' || $user->role === 'manager' || $user->staff()->team_id === $team->id
            ? Response::allow()
            : Response::deny('You are not authorized to view this team.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return ($user->role === 'admin' || $user->role === 'manager') && $team->staff()->count() === 0;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Team $team): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Team $team): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }
}
