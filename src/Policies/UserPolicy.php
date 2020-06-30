<?php

namespace Quyenvkbn\System\Policies;

use Quyenvkbn\System\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \Quyenvkbn\System\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->can('user-list')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Quyenvkbn\System\Models\User  $user
     * @param  \Quyenvkbn\System\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if ($user->can('user-list')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Quyenvkbn\System\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('user-create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Quyenvkbn\System\Models\User  $user
     * @param  \Quyenvkbn\System\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {

        if ($user->can('user-all')) {
            return true;
        }
        if ($user->can('user-edit')) {
            return $user->id == $model->id;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Quyenvkbn\System\Models\User  $user
     * @param  \Quyenvkbn\System\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        if ($user->can('user-all')) {
            return true;
        }
        if ($user->can('user-delete')) {
            return $user->id == $model->id;
        }

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Quyenvkbn\System\Models\User  $user
     * @param  \Quyenvkbn\System\Models\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Quyenvkbn\System\Models\User  $user
     * @param  \Quyenvkbn\System\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
