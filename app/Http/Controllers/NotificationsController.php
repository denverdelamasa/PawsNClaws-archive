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
        // Get the authenticated user's ID
        $userId = Auth::id();
    
        // Retrieve notifications for the authenticated user
        $notifications = Notification::where('user_id', $userId)
                                     ->orderBy('created_at', 'desc') // Optional: to order by creation date
                                     ->get();
    
        // Format the notifications
        $notifications = $notifications->map(function ($notification) {
            // Get the user who liked the post (assuming a relationship between notifications and likes)
            $like = Like::where('posts_id', $notification->post_id)->first();
            if ($like) {
                $notification->liked_by = $like->user->username; // Assuming 'user' relationship in Like model
            }
    
            // Format the time as 'x minutes ago', 'x hours ago', etc.
            $notification->time_ago = Carbon::parse($notification->created_at)->diffForHumans();
    
            return $notification;
        });
    
        // Return the notifications as JSON
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
