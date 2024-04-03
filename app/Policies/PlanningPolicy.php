<?php

namespace App\Policies;

use App\Models\Planning;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlanningPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Planning $planning): bool
    {
        return $user->role === 'admin' || $user->role === 'manager' || $user->staff_id === $planning->staff_id || $user->staff_id === $planning->team->leader_id || $user->staff_id === $planning->team->supervisor_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // voir si l'utilisateur est un leader ou un superviseur
        return $user->role === 'admin' || $user->role === 'manager' || $user->team->leader_id === $user->staff_id || $user->team->supervisor_id === $user->staff_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Planning $planning): bool
    {
        return $user->role === 'admin' || $user->role === 'manager' || $user->staff_id === $planning->staff_id || $user->staff_id === $planning->team->leader_id || $user->staff_id === $planning->team->supervisor_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Planning $planning): bool
    {
        return ($user->role === 'admin' || $user->role === 'manager' || $user->staff_id === $planning->staff_id || $user->staff_id === $planning->team->leader_id || $user->staff_id === $planning->team->supervisor_id) && $planning->status === 'En attente';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Planning $planning): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Planning $planning): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }
}
