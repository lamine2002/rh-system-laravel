<?php

namespace App\Policies;

use App\Models\MailAlert;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MailAlertPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role('admin') || $user->role('manager');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MailAlert $mailAlert): bool
    {
        return $user->role('admin') || $user->role('manager') || $user->staff_id === $mailAlert->staff_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'manager' || $user->role === 'staff';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MailAlert $mailAlert): bool
    {
        return $user->staff_id === $mailAlert->staff_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MailAlert $mailAlert): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MailAlert $mailAlert): bool
    {
        return $user->role('admin') || $user->role('manager');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MailAlert $mailAlert): bool
    {
        return false;
    }
}
