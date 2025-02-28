<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications; // Fetch user notifications

        return view('notification.index' ,  compact('notifications'));
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead(); // Fixed method call
        return response()->json(['message' => 'Notifications marked as read']);
    }
}
