<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Perwalian;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerwalianPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_perwalian');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Perwalian $perwalian): bool
    {
        return $user->can('view_perwalian');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_perwalian');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Perwalian $perwalian): bool
    {
        return $user->can('update_perwalian');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Perwalian $perwalian): bool
    {
        return $user->can('delete_perwalian');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_perwalian');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Perwalian $perwalian): bool
    {
        return $user->can('force_delete_perwalian');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_perwalian');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Perwalian $perwalian): bool
    {
        return $user->can('restore_perwalian');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_perwalian');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Perwalian $perwalian): bool
    {
        return $user->can('replicate_perwalian');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_perwalian');
    }
}
