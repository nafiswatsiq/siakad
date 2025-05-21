<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserMatkul;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserMatkulPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserMatkul $userMatkul): bool
    {
        return $user->can('view_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserMatkul $userMatkul): bool
    {
        return $user->can('update_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserMatkul $userMatkul): bool
    {
        return $user->can('delete_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, UserMatkul $userMatkul): bool
    {
        return $user->can('force_delete_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, UserMatkul $userMatkul): bool
    {
        return $user->can('restore_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, UserMatkul $userMatkul): bool
    {
        return $user->can('replicate_kartu::hasil::studi');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_kartu::hasil::studi');
    }
}
