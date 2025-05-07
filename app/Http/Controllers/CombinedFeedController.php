<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\Post;
use App\Models\Event;
use App\Models\Bookmark;
use App\Models\Announcement;
use App\Models\DoneAdoptionForm;
use Illuminate\Support\Facades\Auth;

class CombinedFeedController extends Controller
{
    public function combinedFeed()
    {
        $userId = Auth::id(); // Get the current user's ID
    
        // Get page parameters from the request, default to 1 if not provided
        $announcementPage = request()->query('announcement_page', 1);
        $postPage = request()->query('post_page', 1);
        $eventPage = request()->query('event_page', 1);
    
        // Fetch announcements with pagination
        $announcements = Announcement::with('shelter')
            ->withCount('comments')
            ->orderBy('created_at', 'desc')
            ->paginate(3, ['*'], 'announcement_page', $announcementPage);
    
        // Fetch posts with pagination
        $posts = Post::with('user')
            ->withCount('comments')
            ->orderBy('created_at', 'desc')
            ->paginate(3, ['*'], 'post_page', $postPage);
    
        // Fetch events with pagination
        $events = Event::with('shelter')
            ->withCount('comments')
            ->orderBy('created_at', 'desc')
            ->paginate(3, ['*'], 'event_page', $eventPage);
    
        // Format announcements
        $formattedAnnouncements = $announcements->map(function ($announcement) use ($userId) {
            $likesCount = Like::where('announcement_id', $announcement->announcement_id)->count();
            $isLiked = Like::where('announcement_id', $announcement->announcement_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            return [
                'announcement_id' => $announcement->announcement_id,
                'shelter_id' => $announcement->shelter_id,
                'name' => $announcement->shelter ? $announcement->shelter->name : 'Unknown Shelter',
                'username' => $announcement->shelter ? $announcement->shelter->username : 'Unknown Shelter',
                'profile_picture' => $announcement->shelter && $announcement->shelter->profile_picture ? $announcement->shelter->profile_picture : 'default-profile.jpg',
                'thumbnail' => $announcement->thumbnail ? $announcement->thumbnail : null,
                'title' => $announcement->title,
                'description' => $announcement->description,
                'created_at' => $announcement->created_at->diffForHumans(),
                'updated_at' => $announcement->updated_at->diffForHumans(),
                'likes_count' => $likesCount,
                'is_liked' => $isLiked,
                'comments_count' => $announcement->comments_count,
                'is_adoptable' => $announcement->is_adoptable,
            ];
        });
    
        // Format posts
        $formattedPosts = $posts->map(function ($post) use ($userId) {
            $postLikesCount = Like::where('post_id', $post->post_id)->count();
            $announcementLikesCount = Like::where('announcement_id', $post->post_id)->count();
            $isLikedPost = Like::where('post_id', $post->post_id)
                            ->where('user_id', $userId)
                            ->exists();
            $isLikedAnnouncement = Like::where('announcement_id', $post->post_id)
                            ->where('user_id', $userId)
                            ->exists();
            $isDoneSendingAdoptionForm = DoneAdoptionForm::where('done_post_id', $post->post_id)
                            ->where('done_user_id', $userId)
                            ->exists();
    
            return [
                'post_id' => $post->post_id,
                'user_id' => $post->user_id,
                'name' => $post->user ? $post->user->name : 'Unknown User',
                'username' => $post->user ? $post->user->username : 'Unknown User',
                'profile_picture' => $post->user && $post->user->profile_picture ? $post->user->profile_picture : 'default-profile.jpg',
                'image_path' => $post->image_path ? json_decode($post->image_path, true) : [],
                'caption' => $post->caption,
                'created_at' => $post->created_at->diffForHumans(),
                'updated_at' => $post->updated_at->diffForHumans(),
                'likes_count' => $postLikesCount + $announcementLikesCount,
                'is_liked' => $isLikedPost || $isLikedAnnouncement,
                'comments_count' => $post->comments_count,
                'is_adoptable' => $post->is_adoptable,
                'done_sending_adoption_form' => $isDoneSendingAdoptionForm,
            ];
        });
    
        // Format events
        $formattedEvents = $events->map(function ($event) use ($userId) {
            $likesCount = Like::where('event_id', $event->event_id)->count();
            $isLiked = Like::where('event_id', $event->event_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            return [
                'event_id' => $event->event_id,
                'shelter_id' => $event->shelter_id,
                'name' => $event->shelter ? $event->shelter->name : 'Unknown Shelter',
                'username' => $event->shelter ? $event->shelter->username : 'Unknown Shelter',
                'profile_picture' => $event->shelter && $event->shelter->profile_picture ? $event->shelter->profile_picture : 'default-profile.jpg',
                'event_thumbnail' => $event->event_thumbnail ? json_decode($event->event_thumbnail, true) : [],
                'event_title' => $event->event_title,
                'event_description' => $event->event_description,
                'event_start_date' => Carbon::parse($event->event_start_date)->format('F j, Y'),
                'event_end_date' => Carbon::parse($event->event_end_date)->format('F j, Y'),
                'created_at' => $event->created_at->diffForHumans(),
                'updated_at' => $event->updated_at->diffForHumans(),
                'likes_count' => $likesCount,
                'is_liked' => $isLiked,
                'comments_count' => $event->comments_count,
                'is_adoptable' => $event->is_adoptable,
            ];
        });
    
        // Return the combined response as JSON
        return response()->json([
            'announcements' => $formattedAnnouncements,
            'announcements_pagination' => [
                'current_page' => $announcements->currentPage(),
                'per_page' => $announcements->perPage(),
                'total' => $announcements->total(),
                'last_page' => $announcements->lastPage(),
                'next_page_url' => $announcements->nextPageUrl(),
                'prev_page_url' => $announcements->previousPageUrl(),
            ],
            'posts' => $formattedPosts,
            'posts_pagination' => [
                'current_page' => $posts->currentPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
                'last_page' => $posts->lastPage(),
                'next_page_url' => $posts->nextPageUrl(),
                'prev_page_url' => $posts->previousPageUrl(),
            ],
            'events' => $formattedEvents,
            'events_pagination' => [
                'current_page' => $events->currentPage(),
                'per_page' => $events->perPage(),
                'total' => $events->total(),
                'last_page' => $events->lastPage(),
                'next_page_url' => $events->nextPageUrl(),
                'prev_page_url' => $events->previousPageUrl(),
            ],
        ], 200);
    }

    public function combinedFeedShelters()
    {
        $userId = Auth::id(); // Get the current user's ID
    
        // Get page parameter from the request, default to 1
        $page = request()->query('page', 1);
        $perPage = 9; // Total items per page (e.g., 3 announcements + 3 posts + 3 events)
    
        // Fetch announcements, filtered by Shelter role
        $announcements = Announcement::with('shelter')
            ->whereHas('shelter', function ($query) {
                $query->where('role', 'Shelter');
            })
            ->withCount('comments')
            ->get()
            ->map(function ($announcement) use ($userId) {
                $likesCount = Like::where('announcement_id', $announcement->announcement_id)->count();
                $isLiked = Like::where('announcement_id', $announcement->announcement_id)
                    ->where('user_id', $userId)
                    ->exists();
                $isBookmarked = Bookmark::where('announcement_id', $announcement->announcement_id)
                    ->where('user_id', $userId)
                    ->exists();
    
                return [
                    'type' => 'announcement',
                    'created_at' => $announcement->created_at,
                    'data' => [
                        'announcement_id' => $announcement->announcement_id,
                        'shelter_id' => $announcement->shelter_id,
                        'name' => $announcement->shelter ? $announcement->shelter->name : 'Unknown Shelter',
                        'username' => $announcement->shelter ? $announcement->shelter->username : 'Unknown Shelter',
                        'profile_picture' => $announcement->shelter && $announcement->shelter->profile_picture ? $announcement->shelter->profile_picture : 'default-profile.jpg',
                        'thumbnail' => $announcement->thumbnail ? $announcement->thumbnail : null,
                        'title' => $announcement->title,
                        'description' => $announcement->description,
                        'created_at' => $announcement->created_at->diffForHumans(),
                        'updated_at' => $announcement->updated_at->diffForHumans(),
                        'likes_count' => $likesCount,
                        'is_liked' => $isLiked,
                        'comments_count' => $announcement->comments_count,
                        'is_adoptable' => $announcement->is_adoptable ?? false,
                        'is_bookmarked' => $isBookmarked,
                    ],
                ];
            });
    
        // Fetch posts, filtered by Shelter role
        $posts = Post::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'Shelter');
            })
            ->withCount('comments')
            ->get()
            ->map(function ($post) use ($userId) {
                $postLikesCount = Like::where('post_id', $post->post_id)->count();
                // Remove incorrect announcement_id check (bug fix)
                $isLiked = Like::where('post_id', $post->post_id)
                    ->where('user_id', $userId)
                    ->exists();
                $isDoneSendingAdoptionForm = DoneAdoptionForm::where('done_post_id', $post->post_id)
                    ->where('done_user_id', $userId)
                    ->exists();
                $isBookmarked = Bookmark::where('post_id', $post->post_id)
                    ->where('user_id', $userId)
                    ->exists();
    
                return [
                    'type' => 'post',
                    'created_at' => $post->created_at,
                    'data' => [
                        'post_id' => $post->post_id,
                        'user_id' => $post->user_id,
                        'name' => $post->user ? $post->user->name : 'Unknown User',
                        'username' => $post->user ? $post->user->username : 'Unknown User',
                        'profile_picture' => $post->user && $post->user->profile_picture ? $post->user->profile_picture : 'default-profile.jpg',
                        'image_path' => $post->image_path ?? [],
                        'caption' => $post->caption,
                        'created_at' => $post->created_at->diffForHumans(),
                        'updated_at' => $post->updated_at->diffForHumans(),
                        'likes_count' => $postLikesCount,
                        'is_liked' => $isLiked,
                        'comments_count' => $post->comments_count,
                        'is_adoptable' => $post->is_adoptable ?? false,
                        'done_sending_adoption_form' => $isDoneSendingAdoptionForm,
                        'is_bookmarked' => $isBookmarked,
                    ],
                ];
            });
    
        // Fetch events, filtered by Shelter role
        $events = Event::with('shelter')
            ->whereHas('shelter', function ($query) {
                $query->where('role', 'Shelter');
            })
            ->withCount('comments')
            ->get()
            ->map(function ($event) use ($userId) {
                $likesCount = Like::where('event_id', $event->event_id)->count();
                $isLiked = Like::where('event_id', $event->event_id)
                    ->where('user_id', $userId)
                    ->exists();
                $isBookmarked = Bookmark::where('event_id', $event->event_id)
                    ->where('user_id', $userId)
                    ->exists();
    
                return [
                    'type' => 'event',
                    'created_at' => $event->created_at,
                    'data' => [
                        'event_id' => $event->event_id,
                        'shelter_id' => $event->shelter_id,
                        'name' => $event->shelter ? $event->shelter->name : 'Unknown Shelter',
                        'username' => $event->shelter ? $event->shelter->username : 'Unknown Shelter',
                        'profile_picture' => $event->shelter && $event->shelter->profile_picture ? $event->shelter->profile_picture : 'default-profile.jpg',
                        'event_thumbnail' => $event->event_thumbnail ?? [],
                        'event_title' => $event->event_title,
                        'event_description' => $event->event_description,
                        'event_start_date' => Carbon::parse($event->event_start_date)->format('F j, Y'),
                        'event_end_date' => Carbon::parse($event->event_end_date)->format('F j, Y'),
                        'created_at' => $event->created_at->diffForHumans(),
                        'updated_at' => $event->updated_at->diffForHumans(),
                        'likes_count' => $likesCount,
                        'is_liked' => $isLiked,
                        'comments_count' => $event->comments_count,
                        'is_adoptable' => $event->is_adoptable ?? false,
                        'is_bookmarked' => $isBookmarked,
                    ],
                ];
            });
    
        // Combine all items and sort by created_at
        $combined = $announcements->concat($posts)->concat($events)
            ->sortByDesc('created_at');
    
        // Paginate the combined collection
        $total = $combined->count();
        $paginatedItems = $combined->slice(($page - 1) * $perPage, $perPage)->values();
        $lastPage = ceil($total / $perPage);
    
        // Generate pagination URLs
        $nextPageUrl = $page < $lastPage ? request()->fullUrlWithQuery(['page' => $page + 1]) : null;
        $prevPageUrl = $page > 1 ? request()->fullUrlWithQuery(['page' => $page - 1]) : null;
    
        // Return the combined response as JSON
        return response()->json([
            'feed' => $paginatedItems,
            'pagination' => [
                'current_page' => (int) $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => $lastPage,
                'next_page_url' => $nextPageUrl,
                'prev_page_url' => $prevPageUrl,
            ],
        ], 200);
    }
}
