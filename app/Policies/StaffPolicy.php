<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StaffPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to view staffs.');
    }

    /**
     * Determine whether the user can view the m.odel.
     */
    public function view(User $user, Staff $staff): bool
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to view this staff.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to create staffs.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Staff $staff): Response
    {
        return $user->role === 'admin' || $user->role === 'manager' || $user->staff_id === $staff->id
            ? Response::allow()
            : Response::deny('You are not authorized to update this staff.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Staff $staff): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to delete this staff.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Staff $staff): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to restore this staff.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Staff $staff): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to permanently delete this staff.');
    }
}
