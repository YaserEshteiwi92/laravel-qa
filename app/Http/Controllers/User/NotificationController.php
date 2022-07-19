<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->unreadNotifications;

        return view('user.notifications', compact('notifications'));
    }

    public function read($id)
    {
        $notification = DatabaseNotification::find($id);

        $notification->markAsRead();

        return redirect($notification->data['url']);
    }

    public function readAll()
    {
        $notifications = DatabaseNotification::where('notifiable_id', Auth::id())->get();
        $notifications->markAsRead();

        return redirect()->route('dashboard');
    }
}
