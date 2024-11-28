<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\UserLevel;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function updateLevel(User $loggedInUser, User $model)
    {
        //return false;
        //return UserLevel::Administrator == $loggedInUser->level;
        if (UserLevel::Administrator == $loggedInUser->level) {
            // When deleting an admin, check if there will be admins left
            if (UserLevel::Administrator == $model->level) {
                return User::getNumberOfAdmins() > 1;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     * 
     * @param \App\Models\User $loggedInUser the user that's trying to delete $model
     * @param \App\Models\User $model the user that's being deleted by $loggedInUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $loggedInUser, User $model)
    {
        if (UserLevel::Administrator == $loggedInUser->level) {
            if ($loggedInUser->is($model)) {
                return User::getNumberOfAdmins() > 1;
            } else {
                return true;
            }
        } else {
            return $loggedInUser->is($model);
        }
    }
}
