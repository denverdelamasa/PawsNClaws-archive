<?php

namespace App\Http\Controllers;

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

        // Return the notifications (You can return them as JSON if you're using Vue or an API)
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
