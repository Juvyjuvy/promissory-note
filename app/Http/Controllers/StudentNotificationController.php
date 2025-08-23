<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentNotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->latest()->get();
        $unreadCount   = $user->unreadNotifications()->count();

        return view('student.notifications', compact('notifications','unreadCount'));
    }

    public function markRead($id)
    {
        $n = auth()->user()->notifications()->where('id', $id)->firstOrFail();
        if (is_null($n->read_at)) $n->markAsRead();

        return back()->with('success', 'Notification marked as read.');
    }
}
