<?php

namespace App\Policies;

use App\User;
use App\Student;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the student.
     *
     * @param  \App\User $user
     * @param  \App\Student $student
     * @return mixed
     */
    public function view(User $user, Student $student)
    {
        if ($user->isAdmin()) {
            return true;
        } elseif ($user->isTeacher()) {
            return true;
        } elseif ($user->isStudent() && $user->student->id == $student->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create students.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        } elseif ($user->isTeacher()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the student.
     *
     * @param  \App\User $user
     * @param  \App\Student $student
     * @return mixed
     */
    public function update(User $user, Student $student)
    {
        if ($user->isAdmin()) {
            return true;
        } elseif ($user->isTeacher()) {
            return true;
        } elseif ($user->isStudent() && $user->student->id == $student->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the student.
     *
     * @param  \App\User $user
     * @param  \App\Student $student
     * @return mixed
     */
    public function delete(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        } elseif ($user->isTeacher()) {
            return true;
        } else {
            return false;
        }
    }
}
