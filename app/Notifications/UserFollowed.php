<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class UserFollowed extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private User $follower
    )
    {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'icon' => 'images/followed.svg',
            'url' => URL::route('people.show', ['user' => $this->follower]),
            'message' => $this->follower->fullname . ' followed you',
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'followed';
    }
}
