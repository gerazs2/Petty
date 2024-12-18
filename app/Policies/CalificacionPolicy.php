<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Calificacion;
use App\User;

class CalificacionPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Calificacion  $calificacion
     * @return mixed
     */
    public function view(User $user, Calificacion $calificacion)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Calificacion  $calificacion
     * @return mixed
     */
    public function update(User $user, Calificacion $calificacion)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Calificacion  $calificacion
     * @return mixed
     */
    public function delete(User $user, Calificacion $calificacion)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Calificacion  $calificacion
     * @return mixed
     */
    public function restore(User $user, Calificacion $calificacion)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Calificacion  $calificacion
     * @return mixed
     */
    public function forceDelete(User $user, Calificacion $calificacion)
    {
        //
    }
}
