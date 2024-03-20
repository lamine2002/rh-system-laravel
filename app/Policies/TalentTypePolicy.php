<?php

namespace App\Policies;

use App\Models\TalentType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TalentTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to view talent types.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TalentType $talentType): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to view this talent type.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to create talent types.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TalentType $talentType): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to update this talent type.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TalentType $talentType): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to delete this talent type.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TalentType $talentType): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to restore this talent type.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TalentType $talentType): Response
    {
        return $user->role === 'admin' || $user->role === 'manager'
            ? Response::allow()
            : Response::deny('You are not authorized to permanently delete this talent type.');
    }
}
