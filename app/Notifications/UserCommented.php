<?php

namespace App\Notifications;

use App\Models\Snap;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class UserCommented extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private Snap $snap,
        private User $commentor,
    )
    {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'icon' => 'images/commented.svg',
            'url' => URL::route('notif.snap', ['snap' => $this->snap, 'notification_id' => $this->id]),
            'message' => $this->commentor->fullname . ' commented on your snap post',
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'commented';
    }
}
