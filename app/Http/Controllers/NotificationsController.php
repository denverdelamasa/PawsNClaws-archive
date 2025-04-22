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
        
        // Fetch notifications for the user, ordered by latest, and paginate the results
        $notifications = Notification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(3);
    
        // Map through notifications and format the response
        $formattedNotifications = $notifications->map(function ($notification) {
            $notificationData = [
                'notification_id' => $notification->notification_id,
                'user_id' => $notification->user_id,
                'type' => $notification->type,
                'time_ago' => Carbon::parse($notification->created_at)->diffForHumans(),
                'read_at' => $notification->read_at,
            ];
    
            // Determine the redirect URL based on the notification type
            if ($notification->type === 'submitted an adoption application') {
                $notificationData['redirect_url'] = '/profile';
            } elseif ($notification->post_id) {
                $notificationData['redirect_url'] = "/posts/{$notification->post_id}";
            } elseif ($notification->announcement_id) {
                $notificationData['redirect_url'] = "/announcements/{$notification->announcement_id}";
            } elseif ($notification->event_id) {
                $notificationData['redirect_url'] = "/events/{$notification->event_id}";
            }
    
            // If the notification has a liker, get their info
            if ($notification->liker) {
                $notificationData['liker_name'] = $notification->liker->name;
                $notificationData['liker_profile_picture'] = $notification->liker->profile_picture;
            }
            // If the notification has a commenter, get their info
            elseif ($notification->commenter) {
                $notificationData['commenter_name'] = $notification->commenter->name;
                $notificationData['commenter_profile_picture'] = $notification->commenter->profile_picture;
            }
            // If there's a receiver (notif_from_receiver), fetch their info
            elseif ($notification->notif_from_receiver) {
                $receiver = $notification->receiver;
                $notificationData['receiver_name'] = $receiver ? $receiver->name : null;
                $notificationData['receiver_profile_picture'] = $receiver ? $receiver->profile_picture : null;
            }
    
            return $notificationData;
        });
    
        // Return JSON response with paginated metadata
        return response()->json([
            'notifications' => $formattedNotifications,
            'pagination' => [
                'current_page' => $notifications->currentPage(),
                'per_page' => $notifications->perPage(),
                'total' => $notifications->total(),
                'last_page' => $notifications->lastPage(),
                'next_page_url' => $notifications->nextPageUrl(),
                'prev_page_url' => $notifications->previousPageUrl(),
            ]
        ], 200);
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
            'notification' => $notification,
        ]);
    }
}