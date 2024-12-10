<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function notif()
    {
        $userId = Auth::id();
        $notifications = Notification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($notification) {
                $notification->time_ago = Carbon::parse($notification->created_at)->diffForHumans();
    
                if ($notification->liker) {
                    $notification->liker_username = $notification->liker->username;
                    $notification->liker_profile_picture = $notification->liker->profile_picture;
                }
    
                return $notification;
            });
    
        return response()->json($notifications);
    }

    public function markAsRead($notification_id)
    {
        $notification = Notification::findOrFail($notification_id);
    
        if ($notification->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $notification->update(['read_at' => now()]);
    
        return response()->json([
            'message' => 'Notification marked as read',
            'notification' => $notification, // Return the updated notification
        ]);
    }
}
