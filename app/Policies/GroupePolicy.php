<?php

namespace App\Policies;

use App\Groupe;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class GroupePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any groupes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->etat != 'en attente';
    }

    /**
     * Determine whether the user can view the groupe.
     *
     * @param  \App\User  $user
     * @param  \App\Groupe  $groupe
     * @return mixed
     */
    public function view(User $user, Groupe $groupe)
    {
        //
    }

    /**
     * Determine whether the user can create groupes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->etat != 'en attente';
    }

    /**
     * Determine whether the user can update the groupe.
     *
     * @param  \App\User  $user
     * @param  \App\Groupe  $groupe
     * @return mixed
     */
    public function update(User $user, Groupe $groupe)
    {
        return $user->id == $groupe->admin_id;
    }

    /**
     * Determine whether the user can delete the groupe.
     *
     * @param  \App\User  $user
     * @param  \App\Groupe  $groupe
     * @return mixed
     */
    public function delete(User $user, Groupe $groupe)
    {
        return $groupe->id != 1 && ($user->id == $groupe->admin_id || $user->etat == 'admin');
    }

    /**
     * Determine whether the user can delete the groupe.
     *
     * @param  \App\User  $user
     * @param  \App\Groupe  $groupe
     * @return mixed
     */
    public function join(User $user, Groupe $groupe)
    {
        return $user->etat != 'en attente';
    }

    /**
     * Determine whether the user can delete the groupe.
     *
     * @param  \App\User  $user
     * @param  \App\Groupe  $groupe
     * @return mixed
     */
    public function leave(User $user, Groupe $groupe)
    {
        return $user->id == Auth::id() || $user->id == $groupe->admin_id || $user->etat != 'admin';
    }

    /**
     * Determine whether the user can restore the groupe.
     *
     * @param  \App\User  $user
     * @param  \App\Groupe  $groupe
     * @return mixed
     */
    public function restore(User $user, Groupe $groupe)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the groupe.
     *
     * @param  \App\User  $user
     * @param  \App\Groupe  $groupe
     * @return mixed
     */
    public function forceDelete(User $user, Groupe $groupe)
    {
        //
    }
}
