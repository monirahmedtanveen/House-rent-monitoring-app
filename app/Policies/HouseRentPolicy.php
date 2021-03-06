<?php

namespace App\Policies;

use App\Models\HouseRent;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HouseRentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\HouseRent  $houseRent
     * @return mixed
     */
    public function view(User $user, HouseRent $houseRent)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->user_type === 'Admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\HouseRent  $houseRent
     * @return mixed
     */
    public function update(User $user, HouseRent $houseRent)
    {
        return $user->user_type === 'Admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\HouseRent  $houseRent
     * @return mixed
     */
    public function delete(User $user, HouseRent $houseRent)
    {
        return $user->user_type === 'Admin';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\HouseRent  $houseRent
     * @return mixed
     */
    public function restore(User $user, HouseRent $houseRent)
    {
        return $user->user_type === 'Admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\HouseRent  $houseRent
     * @return mixed
     */
    public function forceDelete(User $user, HouseRent $houseRent)
    {
        return $user->user_type === 'Admin';
    }
}
