<?php
namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\DoneAdoptionForm;
use Illuminate\Support\Facades\Auth;
use App\Models\{Bookmark, Post, Event, Announcement, Notification};

class BookmarkController extends Controller
{
    public function toggleBookmark($itemId, $type)
    {
        $userId = Auth::id();

        $ownerId = null;

        if ($type === 'post') {
            $item = Post::find($itemId);
            $ownerId = $item?->user_id;
        } elseif ($type === 'announcement') {
            $item = Announcement::find($itemId);
            $ownerId = $item?->shelter_id;
        } elseif ($type === 'event') {
            $item = Event::find($itemId);
            $ownerId = $item?->shelter_id;
        } else {
            return response()->json(['error' => 'Invalid type specified'], 400);
        }

        if (!$item) {
            return response()->json(['error' => ucfirst($type).' not found'], 404);
        }

        $bookmarkQuery = Bookmark::where('user_id', $userId);

        if ($type === 'post') {
            $bookmarkQuery->where('post_id', $itemId);
        } elseif ($type === 'announcement') {
            $bookmarkQuery->where('announcement_id', $itemId);
        } elseif ($type === 'event') {
            $bookmarkQuery->where('event_id', $itemId);
        }

        $bookmark = $bookmarkQuery->first();

        if ($bookmark) {
            // Remove bookmark
            $bookmark->delete();
            return response()->noContent();
        } else {
            // Add bookmark
            $bookmarkData = ['user_id' => $userId];

            if ($type === 'post') {
                $bookmarkData['post_id'] = $itemId;
            } elseif ($type === 'announcement') {
                $bookmarkData['announcement_id'] = $itemId;
            } elseif ($type === 'event') {
                $bookmarkData['event_id'] = $itemId;
            }

            Bookmark::create($bookmarkData);

            // Optional notification logic
            if ($userId !== $ownerId) {
                $message = match ($type) {
                    'post' => 'bookmarked your post',
                    'announcement' => 'bookmarked your announcement',
                    'event' => 'bookmarked your event',
                    default => null,
                };
            }

            return response()->noContent();
        }
    }

    public function userPostBookmarks()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
    
        // Fetch only the posts bookmarked by the authenticated user, paginated by 3 posts per page
        $posts = Post::with('user') // Eager load the user relationship
            ->withCount('comments') // Count the number of comments using the defined relationship
            ->whereIn('post_id', function ($query) use ($userId) {
                $query->select('post_id')
                      ->from('bookmarks')
                      ->where('user_id', $userId); // Filter by bookmarks for the authenticated user
            })
            ->orderBy('created_at', 'desc') // Order posts by latest
            ->paginate(3); // Paginate the results, 3 posts per page
    
        // Format the response for each post
        $formattedPosts = $posts->map(function ($post) use ($userId) {
            // Count the number of likes for each post
            $likesCount = Like::where('post_id', $post->post_id)->count();
    
            // Check if the current user has liked the post
            $isLiked = Like::where('post_id', $post->post_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            // Check if the user has completed the adoption form for this post
            $isDoneSendingAdoptionForm = DoneAdoptionForm::where('done_post_id', $post->post_id)
                                ->where('done_user_id', $userId)
                                ->exists();
                                
            $isBookmarked = Bookmark::where('post_id', $post->post_id)
                                ->where('user_id', $userId)
                                ->exists();
    
            return [
                'post_id' => $post->post_id,
                'user_id' => $post->user_id,
                'name' => $post->user ? $post->user->name : 'Unknown User',
                'username' => $post->user ? $post->user->username : 'Unknown User', // Fetch username from the related user
                'profile_picture' => $post->user && $post->user->profile_picture ? $post->user->profile_picture : 'default-profile.jpg', // Use default if no profile picture
                'image_path' => $post->image_path ? json_decode($post->image_path, true) : [],
                'caption' => $post->caption,
                'created_at' => $post->created_at->diffForHumans(), // Format the created_at timestamp
                'updated_at' => $post->updated_at->diffForHumans(), // Format the updated_at timestamp
                'likes_count' => $likesCount,
                'is_liked' => $isLiked, // Add the `is_liked` state for the current user
                'comments_count' => $post->comments_count, // Include the count of comments from the `withCount` query
                'is_adoptable' => $post->is_adoptable, // Include the adoptable status
                'done_sending_adoption_form' => $isDoneSendingAdoptionForm, // Add adoption form status
                'is_bookmarked' => $isBookmarked
            ];
        });
    
        // Return the formatted response as JSON with pagination metadata
        return response()->json([
            'posts' => $formattedPosts,
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
                'last_page' => $posts->lastPage(),
                'next_page_url' => $posts->nextPageUrl(),
                'prev_page_url' => $posts->previousPageUrl(),
            ]
        ], 200);
    }

    public function userAnnouncementBookmarks()
    {
        $userId = Auth::id(); // Get the current user's ID
    
        // Fetch only the announcements bookmarked by the authenticated user
        $announcements = Announcement::with('shelter') // Eager load the shelter relationship
            ->withCount('comments') // Count comments
            ->whereIn('announcement_id', function ($query) use ($userId) {
                $query->select('announcement_id')
                      ->from('bookmarks')
                      ->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc') // Latest first
            ->paginate(3);
    
        // Format the announcement data
        $formattedAnnouncements = $announcements->map(function ($announcement) use ($userId) {
            // Count likes
            $likesCount = Like::where('announcement_id', $announcement->announcement_id)->count();
    
            // Check if user liked it
            $isLiked = Like::where('announcement_id', $announcement->announcement_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            // Check if user bookmarked it
            $isBookmarked = Bookmark::where('announcement_id', $announcement->announcement_id)
                                    ->where('user_id', $userId)
                                    ->exists();
    
            return [
                'announcement_id' => $announcement->announcement_id,
                'shelter_id' => $announcement->shelter_id,
                'name' => $announcement->shelter ? $announcement->shelter->name : 'Unknown Shelter',
                'username' => $announcement->shelter ? $announcement->shelter->username : 'Unknown Shelter',
                'profile_picture' => $announcement->shelter && $announcement->shelter->profile_picture
                                    ? $announcement->shelter->profile_picture
                                    : 'default-profile.jpg',
                'thumbnail' => $announcement->thumbnail ?: null,
                'title' => $announcement->title,
                'description' => $announcement->description,
                'created_at' => $announcement->created_at->diffForHumans(),
                'updated_at' => $announcement->updated_at->diffForHumans(),
                'likes_count' => $likesCount,
                'is_liked' => $isLiked,
                'comments_count' => $announcement->comments_count,
                'is_adoptable' => $announcement->is_adoptable,
                'is_bookmarked' => $isBookmarked
            ];
        });
    
        // Return formatted response
        return response()->json([
            'announcements' => $formattedAnnouncements,
            'pagination' => [
                'current_page' => $announcements->currentPage(),
                'per_page' => $announcements->perPage(),
                'total' => $announcements->total(),
                'last_page' => $announcements->lastPage(),
                'next_page_url' => $announcements->nextPageUrl(),
                'prev_page_url' => $announcements->previousPageUrl(),
            ]
        ], 200);
    }

    public function userEventBookmarks()
    {
        $userId = Auth::id(); // Get the current user's ID
    
        // Fetch only the events bookmarked by the authenticated user
        $events = Event::with('shelter') // Eager load the shelter relationship
            ->withCount('comments') // Count the number of comments
            ->whereIn('event_id', function ($query) use ($userId) {
                $query->select('event_id')
                      ->from('bookmarks')
                      ->where('user_id', $userId); // Only bookmarked events by the user
            })
            ->orderBy('created_at', 'desc') // Order by latest
            ->paginate(3);
    
        // Format the response
        $formattedEvents = $events->map(function ($event) use ($userId) {
            // Count likes
            $likesCount = Like::where('event_id', $event->event_id)->count();
    
            // Check if liked by user
            $isLiked = Like::where('event_id', $event->event_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            // Check if bookmarked by user
            $isBookmarked = Bookmark::where('event_id', $event->event_id)
                                    ->where('user_id', $userId)
                                    ->exists();
    
            return [
                'event_id' => $event->event_id,
                'shelter_id' => $event->shelter_id,
                'name' => $event->shelter ? $event->shelter->name : 'Unknown Shelter',
                'username' => $event->shelter ? $event->shelter->username : 'Unknown Shelter',
                'profile_picture' => $event->shelter && $event->shelter->profile_picture
                                    ? $event->shelter->profile_picture
                                    : 'default-profile.jpg',
                'event_thumbnail' => $event->event_thumbnail ? json_decode($event->event_thumbnail, true) : [],
                'event_title' => $event->event_title,
                'event_description' => $event->event_description,
                'event_start_date' => \Carbon\Carbon::parse($event->event_start_date)->format('F j, Y'),
                'event_end_date' => \Carbon\Carbon::parse($event->event_end_date)->format('F j, Y'),
                'created_at' => $event->created_at->diffForHumans(),
                'updated_at' => $event->updated_at->diffForHumans(),
                'likes_count' => $likesCount,
                'is_liked' => $isLiked,
                'comments_count' => $event->comments_count,
                'is_adoptable' => $event->is_adoptable,
                'is_bookmarked' => $isBookmarked
            ];
        });
    
        // Return JSON response with pagination metadata
        return response()->json([
            'events' => $formattedEvents,
            'pagination' => [
                'current_page' => $events->currentPage(),
                'per_page' => $events->perPage(),
                'total' => $events->total(),
                'last_page' => $events->lastPage(),
                'next_page_url' => $events->nextPageUrl(),
                'prev_page_url' => $events->previousPageUrl(),
            ]
        ], 200);
    }
    
}
