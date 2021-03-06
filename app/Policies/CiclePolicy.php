<?php

namespace App\Policies;

use App\User;
use App\Cicle;
use Illuminate\Auth\Access\HandlesAuthorization;

class CiclePolicy
{
    use HandlesAuthorization;


    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the cicle.
     *
     * @param  \App\Teacher $teacher
     * @param  \App\Cicle $cicle
     * @return mixed
     */
    public function view(User $user)
    {

        if ($user->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create cicles.
     *
     * @param  \App\Teacher $teacher
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the cicle.
     *
     * @param  \App\Teacher $teacher
     * @param  \App\Cicle $cicle
     * @return mixed
     */
    public function update(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the cicle.
     *
     * @param  \App\Teacher $teacher
     * @param  \App\Cicle $cicle
     * @return mixed
     */
    public function delete(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }


}
