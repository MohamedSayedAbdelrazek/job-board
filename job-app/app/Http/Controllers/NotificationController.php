<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification; 


class NotificationController extends Controller
{
    //
        public function markAsRead(DatabaseNotification $notification)
    {
        if ($notification->notifiable_id !== auth()->user()->id) {
            abort(403);
        }

        $notification->markAsRead();
        return back();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
         return back();
    }

    public function index()
    {
        return view('notifications.index', [
            'notifications' => auth()->user()->notifications()->paginate(15)
        ]);
    }
}
