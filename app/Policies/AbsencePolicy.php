<?php

namespace App\Policies;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AbsencePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->role('admin') || $user->role('manager')
            ? Response::allow()
            : Response::deny('You are not authorized to view absences.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Absence $absence): Response
    {
        return ($user->role === 'admin' || $user->role === 'manager')
            ? Response::allow()
            : (($user->staff_id === $absence->staff_id)
                ? Response::allow()
                : Response::deny('You are not authorized to view this absence.'));
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
    public function update(User $user, Absence $absence): bool
    {
        return ($user->role === 'admin' || $user->role === 'manager' || ($user->staff_id === $absence->staff_id && $absence->status === 'En attente'));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Absence $absence): bool
    {
        return $absence->status === 'En attente' && ($user->role === 'admin' || $user->role === 'manager' || $user->staff_id === $absence->staff_id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Absence $absence): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Absence $absence): bool
    {
        return $user->role === 'admin' || $user->role === 'manager';
    }
}
