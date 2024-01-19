<?php

namespace App\Policies;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FollowerPolicy
{
    public function delete(User $user, Follower $follower): bool
    {
        return $user->user_id === $follower->request_user_id;
    }
}
