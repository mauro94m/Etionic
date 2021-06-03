<?php

namespace App\Policies;

use App\Models\Favorito;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritoPolicies
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Favorito  $favorito
     * @return mixed
     */
    public function view(User $user, Favorito $favorito)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->rol == 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Favorito  $favorito
     * @return mixed
     */
    public function update(User $user, Favorito $favorito)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Favorito  $favorito
     * @return mixed
     */
    public function delete(User $user, Favorito $favorito)
    {
        return $user->id == $favorito->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Favorito  $favorito
     * @return mixed
     */
    public function restore(User $user, Favorito $favorito)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Favorito  $favorito
     * @return mixed
     */
    public function forceDelete(User $user, Favorito $favorito)
    {
        //
    }
}
