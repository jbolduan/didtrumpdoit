<?php

namespace App\Policies;

use App\Models\User;
use App\Enums\UserLevel;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        return (($user->level == UserLevel::Administrator) || ($user->level == UserLevel::Moderator));
    }

    public function view(User $user)
    {
        return (($user->level == UserLevel::Administrator) || ($user->level == UserLevel::Moderator));
    }

    public function create(User $user)
    {
        return (($user->level == UserLevel::Administrator) || ($user->level == UserLevel::Moderator));
    }

    public function update(User $user)
    {
        return (($user->level == UserLevel::Administrator) || ($user->level == UserLevel::Moderator));
    }

    public function delete(User $user)
    {
        return (($user->level == UserLevel::Administrator) || ($user->level == UserLevel::Moderator));
    }
}
