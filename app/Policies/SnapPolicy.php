<?php

namespace App\Policies;

use App\Models\Snap;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SnapPolicy
{
    public function update(User $user, Snap $snap): bool
    {
        return $snap->snapable->user_id === $user->user_id || $snap->snapable->user_id === $user->user_id;
    }

    public function delete(User $user, Snap $snap): bool
    {
        return $this->update($user, $snap);
    }
}
