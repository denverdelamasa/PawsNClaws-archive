<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\Bookmark;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\DoneAdoptionForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function getNotifications(Request $request)
    {
        $user = Auth::user();
        $notifications = Notification::where('receiver_id', $user->user_id)
            ->with(['post', 'event', 'announcement', 'liker', 'commenter'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $formattedNotifications = $notifications->map(function ($notification) {
            $data = [
                'notification_id' => $notification->notification_id,
                'type' => $notification->type,
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at->toIso8601String(),
                'time_ago' => $notification->created_at->diffForHumans(),
            ];

            // Set redirect_url based on notification type
            if ($notification->post_id) {
                $data['redirect_url'] = "/content/detail/{$notification->notification_id}";
                $data['liker_name'] = $notification->liker ? $notification->liker->name : null;
                $data['liker_profile_picture'] = $notification->liker ? $notification->liker->profile_picture : null;
                $data['commenter_name'] = $notification->commenter ? $notification->commenter->name : null;
                $data['commenter_profile_picture'] = $notification->commenter ? $notification->commenter->profile_picture : null;
            } elseif ($notification->event_id) {
                $data['redirect_url'] = "/content/detail/{$notification->notification_id}";
                $data['receiver_name'] = $notification->receiver ? $notification->receiver->name : null;
                $data['receiver_profile_picture'] = $notification->receiver ? $notification->receiver->profile_picture : null;
            } elseif ($notification->announcement_id) {
                $data['redirect_url'] = "/content/detail/{$notification->notification_id}";
                $data['receiver_name'] = $notification->receiver ? $notification->receiver->name : null;
                $data['receiver_profile_picture'] = $notification->receiver ? $notification->receiver->profile_picture : null;
            } elseif ($notification->type === 'submitted an adoption application') {
                $data['redirect_url'] = '/profile?openAdoptionModal=true';
                $data['receiver_name'] = $notification->receiver ? $notification->receiver->name : null;
                $data['receiver_profile_picture'] = $notification->receiver ? $notification->receiver->profile_picture : null;
            }

            return $data;
        });

        return response()->json([
            'notifications' => $formattedNotifications,
            'pagination' => [
                'next_page_url' => $notifications->nextPageUrl(),
                'current_page' => $notifications->currentPage(),
                'last_page' => $notifications->lastPage(),
            ],
        ]);
    }

    public function getNotificationContent($notificationId)
    {
        $notification = Notification::with(['post', 'event', 'announcement', 'liker', 'commenter', 'receiver'])
            ->findOrFail($notificationId);

        $content = null;
        if ($notification->post_id) {
            $content = $notification->post ? [
                'type' => 'post',
                'id' => $notification->post->post_id,
                'caption' => $notification->post->caption,
                'image_path' => $notification->post->image_path,
                'is_adoptable' => $notification->post->is_adoptable,
                'done_sending_adoption_form' => $notification->post->done_sending_adoption_form,
                'user_id' => $notification->post->user_id,
                'profile_picture' => $notification->post->user->profile_picture,
                'name' => $notification->post->user->name,
                'username' => $notification->post->user->username,
                'created_at' => $notification->post->created_at->toIso8601String(),
                'updated_at' => $notification->post->updated_at->toIso8601String(),
                'is_liked' => $notification->post->is_liked,
                'likes_count' => $notification->post->likes_count,
                'comments_count' => $notification->post->comments_count,
                'comments' => $notification->post->comments->map(function ($comment) {
                    return [
                        'comment_id' => $comment->comment_id,
                        'user_id' => $comment->user_id,
                        'comment' => $comment->comment,
                        'likes_count' => $comment->likes_count,
                        'is_liked' => $comment->is_liked,
                    ];
                }),
            ] : null;
        } elseif ($notification->event_id) {
            $content = $notification->event ? [
                'type' => 'event',
                'id' => $notification->event->event_id,
                'event_title' => $notification->event->event_title,
                'event_description' => $notification->event->event_description,
                'event_thumbnail' => $notification->event->event_thumbnail,
                'event_location' => $notification->event->event_location,
                'event_start_date' => $notification->event->event_start_date,
                'event_end_date' => $notification->event->event_end_date,
                'shelter_id' => $notification->event->shelter_id,
                'profile_picture' => $notification->event->shelter->profile_picture,
                'name' => $notification->event->shelter->name,
                'username' => $notification->event->shelter->username,
                'created_at' => $notification->event->created_at->toIso8601String(),
                'updated_at' => $notification->event->updated_at->toIso8601String(),
                'is_liked' => $notification->event->is_liked,
                'likes_count' => $notification->event->likes_count,
                'comments_count' => $notification->event->comments_count,
                'comments' => $notification->event->comments->map(function ($comment) {
                    return [
                        'comment_id' => $comment->comment_id,
                        'user_id' => $comment->user_id,
                        'comment' => $comment->comment,
                        'likes_count' => $comment->likes_count,
                        'is_liked' => $comment->is_liked,
                    ];
                }),
            ] : null;
        } elseif ($notification->announcement_id) {
            $content = $notification->announcement ? [
                'type' => 'announcement',
                'id' => $notification->announcement->announcement_id,
                'title' => $notification->announcement->title,
                'description' => $notification->announcement->description,
                'thumbnail' => $notification->announcement->thumbnail,
                'shelter_id' => $notification->announcement->shelter_id,
                'profile_picture' => $notification->announcement->shelter->profile_picture,
                'name' => $notification->announcement->shelter->name,
                'username' => $notification->announcement->shelter->username,
                'created_at' => $notification->announcement->created_at->toIso8601String(),
                'updated_at' => $notification->announcement->updated_at->toIso8601String(),
                'is_liked' => $notification->announcement->is_liked,
                'likes_count' => $notification->announcement->likes_count,
                'comments_count' => $notification->announcement->comments_count,
                'comments' => $notification->announcement->comments->map(function ($comment) {
                    return [
                        'comment_id' => $comment->comment_id,
                        'user_id' => $comment->user_id,
                        'comment' => $comment->comment,
                        'likes_count' => $comment->likes_count,
                        'is_liked' => $comment->is_liked,
                    ];
                }),
            ] : null;
        }

        return response()->json([
            'notification_id' => $notification->notification_id,
            'type' => $notification->type,
            'read_at' => $notification->read_at,
            'liker_name' => $notification->liker ? $notification->liker->name : null,
            'commenter_name' => $notification->commenter ? $notification->commenter->name : null,
            'receiver_name' => $notification->receiver ? $notification->receiver->name : null,
            'created_at' => $notification->created_at->toIso8601String(),
            'content' => $content,
        ]);
    }
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