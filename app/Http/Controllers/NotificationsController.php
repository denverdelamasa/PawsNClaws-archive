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
    public function notif() {
        $userId = Auth::id();
        $notifications = Notification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($notification) {
                $notification->time_ago = Carbon::parse($notification->created_at)->diffForHumans();
                
                // If the notification has a liker, get their info
                if ($notification->liker) {
                    $notification->liker_name = $notification->liker->name;
                    $notification->liker_profile_picture = $notification->liker->profile_picture;
                }
                // If the notification has a commenter, get their info
                elseif ($notification->commenter) {
                    $notification->commenter_name = $notification->commenter->name;
                    $notification->commenter_profile_picture = $notification->commenter->profile_picture;
                }
                // If there's a receiver (notif_from_receiver), fetch their info
                elseif ($notification->notif_from_receiver) {
                    $receiver = $notification->receiver; // This will use the `receiver` method we added in the model
                    $notification->receiver_name = $receiver ? $receiver->name : null;
                    $notification->receiver_profile_picture = $receiver ? $receiver->profile_picture : null;
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
