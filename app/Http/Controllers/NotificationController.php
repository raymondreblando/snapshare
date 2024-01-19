<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function __invoke(DatabaseNotification $notification): RedirectResponse
    {
        $notification->markAsRead();
        return redirect($notification->data['url']);
    }
}
