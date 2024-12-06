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
        // Debugging: Log the ID
        \Log::info('Notification ID:', ['id' => $notification_id]);

        // Fetch the notification
        $notification = Notification::findOrFail($notification_id);

        // Ensure the notification belongs to the authenticated user
        if ($notification->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Mark as read by setting the 'read_at' field to the current timestamp
        $notification->update(['read_at' => now()]);

        return response()->json([
            'message' => 'Notification marked as read',
            'notification' => $notification,
        ]);
    }

    
}
