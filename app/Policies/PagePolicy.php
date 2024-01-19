<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PagePolicy
{
    public function update(User $user, Page $page): bool
    {
        return $page->user->is($user);
    }

    public function delete(User $user, Page $page): bool
    {
        return $this->update($user, $page);
    }
}
