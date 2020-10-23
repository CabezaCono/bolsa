<?php

namespace App\Policies;

use App\User;
use App\Teacher;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeacherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function view(User $user, Teacher $teacher)
    {
        if ($user->isAdmin()) {
            return true;
        }  elseif ($user->isTeacher() && $user->teacher->id == $teacher->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create teachers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }  else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function update(User $user, Teacher $teacher)
    {
        if ($user->isAdmin()) {
            return true;
        }  elseif ($user->isTeacher() && $user->teacher->id == $teacher->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the teacher.
     *
     * @param  \App\User  $user
     * @param  \App\Teacher  $teacher
     * @return mixed
     */
    public function delete(User $user,Teacher $teacher)
    {
        if ($user->isAdmin()) {
            return true;
        }else if($user->isTeacher() && $user->teacher->id == $teacher->id){
            return true;
        } else {
            return false;
        }
    }
}
