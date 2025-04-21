<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\DoneAdoptionForm;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BrowseController extends Controller
{
    public function browseAccounts(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $perPage = 3; // Always show 3 results per page
    
        $query = User::query();
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%');
            });
        }
    
        $users = $query->select('user_id', 'name', 'email', 'profile_picture', 'role', 'status', 'is_online', 'last_online', 'bio')
                       ->paginate($perPage, ['*'], 'page', $page);
    
        return response()->json($users);
    }

    public function browseServices(Request $request)
    {
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $perPage = 3; // Always show 3 results per page
    
        $query = User::query()->where('role', 'Shelter');
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%');
            });
        }
    
        $users = $query->select('user_id', 'name', 'email', 'profile_picture', 'role', 'status', 'is_online', 'last_online', 'bio')
                       ->paginate($perPage, ['*'], 'page', $page);
    
        return response()->json($users);
    }

    public function browsePosts(Request $request)
    {
        $userId = Auth::id(); // Get the current user's ID
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $perPage = 3; // 3 posts per page
    
        $query = Post::with('user')
            ->withCount('comments')
            ->orderBy('created_at', 'desc');
    
        // Add search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('caption', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }
    
        $posts = $query->paginate($perPage, ['*'], 'page', $page);
    
        // Format the response
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
                'name' => $post->user?->name ?? 'Unknown User',
                'username' => $post->user?->username ?? 'Unknown User',
                'profile_picture' => $post->user?->profile_picture ?? 'default-profile.jpg',
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

    public function browseAnnouncements(Request $request)
    {
        $userId = Auth::id(); // Get the current user's ID
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $perPage = 3; // 3 posts per page
    
        $query = Announcement::with('shelter')
            ->withCount('comments')
            ->orderBy('created_at', 'desc');
    
        // Add search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('shelter', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }
    
        $announcements = $query->paginate($perPage, ['*'], 'page', $page);
    
        // Format the response
        $formattedAnnouncements = $announcements->map(function ($announcements) use ($userId) {
            $announcementLikesCount = Like::where('announcement_id', $announcements->announcement_id)->count();
    
            $isLikedAnnouncement = Like::where('announcement_id', $announcements->announcement_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            return [
                'announcement_id' => $announcements->announcement_id,
                'shelter_id' => $announcements->shelter_id,
                'name' => $announcements->shelter?->name ?? 'Unknown User',
                'username' => $announcements->shelter?->username ?? 'Unknown User',
                'profile_picture' => $announcements->shelter?->profile_picture ?? 'default-profile.jpg',
                'thumbnail' => $announcements->thumbnail ? $announcements->thumbnail : null, 
                'title' => $announcements->title,
                'description' => $announcements->description,
                'created_at' => $announcements->created_at->diffForHumans(),
                'updated_at' => $announcements->updated_at->diffForHumans(),
                'likes_count' => $announcementLikesCount,
                'is_liked' => $isLikedAnnouncement,
                'comments_count' => $announcements->comments_count,
            ];
        });
    
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

    public function browseEvents(Request $request)
    {
        $userId = Auth::id(); // Get the current user's ID
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $perPage = 3;
    
        $query = Event::with('shelter')
            ->withCount('comments')
            ->orderBy('created_at', 'desc');
    
        // Add search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('event_title', 'like', "%{$search}%")
                ->orWhere('event_description', 'like', "%{$search}%")
                  ->orWhereHas('shelter', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }
    
        $events = $query->paginate($perPage, ['*'], 'page', $page);
    
        // Format the response
        $formattedEvents = $events->map(function ($events) use ($userId) {
            $EventLikesCount = Like::where('event_id', $events->event_id)->count();
    
            $isLikedEvent = Like::where('event_id', $events->event_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            return [
                'event_id' => $events->event_id,
                'shelter_id' => $events->shelter_id,
                'name' => $events->shelter?->name ?? 'Unknown User',
                'username' => $events->shelter?->username ?? 'Unknown User',
                'profile_picture' => $events->shelter?->profile_picture ?? 'default-profile.jpg',
                'event_thumbnail' => $events->event_thumbnail ? json_decode($events->event_thumbnail, true) : [],
                'event_title' => $events->event_title,
                'event_description' => $events->event_description,
                'created_at' => $events->created_at->diffForHumans(),
                'updated_at' => $events->updated_at->diffForHumans(),
                'likes_count' => $EventLikesCount,
                'is_liked' => $isLikedEvent,
                'comments_count' => $events->comments_count,
            ];
        });
    
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

    public function viewAccount($id)
    {
        try {
            $user = User::select(
                'user_id',
                'name',
                'email',
                'profile_picture',
                'role',
                'status',
                'is_online',
                'last_online',
                'bio',
                'created_at'
            )->findOrFail($id);

            return response()->json([
                'success' => true,
                'user' => $user
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
            
        } catch (\Exception $e) {
            Log::error('Error fetching user account: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], 500);
        }
    }
    
    public function viewUserPosts($id)
    {
        try {
            // Verify the user exists
            $user = User::findOrFail($id);
            
            // Get the authenticated user's ID (if logged in)
            $authUserId = Auth::id();
            
            // Fetch posts created by the specified user, paginated by 3 posts per page
            $posts = Post::with('user') // Eager load the user relationship
                ->withCount('comments') // Count the number of comments
                ->where('user_id', $id) // Filter posts by the specified user
                ->orderBy('created_at', 'desc') // Order posts by latest
                ->paginate(3); // Paginate the results, 3 posts per page
    
            // Format the response for each post
            $formattedPosts = $posts->map(function ($post) use ($authUserId) {
                // Count the number of likes for each post
                $likesCount = Like::where('post_id', $post->post_id)->count();
    
                // Check if the authenticated user has liked the post (if logged in)
                $isLiked = $authUserId ? Like::where('post_id', $post->post_id)
                                        ->where('user_id', $authUserId)
                                        ->exists() : false;
    
                // Check if the authenticated user has completed the adoption form (if logged in)
                $isDoneSendingAdoptionForm = $authUserId ? DoneAdoptionForm::where('done_post_id', $post->post_id)
                                        ->where('done_user_id', $authUserId)
                                        ->exists() : false;
    
                return [
                    'post_id' => $post->post_id,
                    'user_id' => $post->user_id,
                    'name' => $post->user ? $post->user->name : 'Unknown User',
                    'username' => $post->user ? $post->user->username : 'Unknown User',
                    'role' => $post->user ? $post->user->role : 'Unknown Role',
                    'profile_picture' => $post->user && $post->user->profile_picture ? $post->user->profile_picture : 'default-profile.jpg',
                    'image_path' => $post->image_path ? json_decode($post->image_path, true) : [],
                    'caption' => $post->caption,
                    'created_at' => $post->created_at->diffForHumans(),
                    'updated_at' => $post->updated_at->diffForHumans(),
                    'likes_count' => $likesCount,
                    'is_liked' => $isLiked,
                    'comments_count' => $post->comments_count,
                    'is_adoptable' => $post->is_adoptable,
                    'done_sending_adoption_form' => $isDoneSendingAdoptionForm
                ];
            });
    
            // Return the formatted response as JSON with pagination metadata
            return response()->json([
                'success' => true,
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
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
    
        } catch (\Exception $e) {
            Log::error('Error fetching user posts: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], 500);
        }
    }

    public function viewUserAnnouncements($id)
    {
        try {
            // Verify the user exists
            $user = User::findOrFail($id);
            
            // Get the authenticated user's ID (if logged in)
            $authUserId = Auth::id();
            
            // Fetch announcements created by the specified user, paginated by 3 per page
            $announcements = Announcement::with('shelter') // Eager load the shelter (user) relationship
                ->withCount('comments') // Count the number of comments
                ->where('shelter_id', $id) // Filter announcements by the specified user
                ->orderBy('created_at', 'desc') // Order announcements by latest
                ->paginate(3); // Paginate the results, 3 announcements per page
    
            // Format the response for each announcement
            $formattedAnnouncements = $announcements->map(function ($announcement) use ($authUserId) {
                // Count the number of likes for each announcement
                $likesCount = Like::where('announcement_id', $announcement->announcement_id)->count();
    
                // Check if the authenticated user has liked the announcement (if logged in)
                $isLiked = $authUserId ? Like::where('announcement_id', $announcement->announcement_id)
                                        ->where('user_id', $authUserId)
                                        ->exists() : false;
    
                return [
                    'announcement_id' => $announcement->announcement_id,
                    'shelter_id' => $announcement->shelter_id,
                    'name' => $announcement->shelter ? $announcement->shelter->name : 'Unknown User',
                    'username' => $announcement->shelter ? $announcement->shelter->username : 'Unknown User',
                    'role' => $announcement->shelter ? $announcement->shelter->role : 'Unknown Role',
                    'profile_picture' => $announcement->shelter && $announcement->shelter->profile_picture ? $announcement->shelter->profile_picture : 'default-profile.jpg',
                    'thumbnail' => $announcement->thumbnail ? $announcement->thumbnail : null,
                    'title' => $announcement->title,
                    'description' => $announcement->description,
                    'created_at' => $announcement->created_at->diffForHumans(),
                    'updated_at' => $announcement->updated_at->diffForHumans(),
                    'likes_count' => $likesCount,
                    'is_liked' => $isLiked,
                    'comments_count' => $announcement->comments_count,
                ];
            });
    
            // Return the formatted response as JSON with pagination metadata
            return response()->json([
                'success' => true,
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
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
    
        } catch (\Exception $e) {
            Log::error('Error fetching user announcements: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], 500);
        }
    }

    public function viewUserEvents($id)
    {
        try {
            // Verify the user exists
            $user = User::findOrFail($id);

            // Get the authenticated user's ID (if logged in)
            $authUserId = Auth::id();

            // Fetch events created by the specified user, paginated by 3 per page
            $events = Event::with('shelter') // Eager load the shelter (user) relationship
                ->withCount('comments') // Count the number of comments
                ->where('shelter_id', $id) // Filter events by the specified user
                ->orderBy('created_at', 'desc') // Order events by latest
                ->paginate(3); // Paginate the results, 3 events per page

            // Format the response for each event
            $formattedEvents = $events->map(function ($event) use ($authUserId) {
                // Count the number of likes for each event
                $likesCount = Like::where('event_id', $event->event_id)->count();

                // Check if the authenticated user has liked the event (if logged in)
                $isLiked = $authUserId ? Like::where('event_id', $event->event_id)
                    ->where('user_id', $authUserId)
                    ->exists() : false;

                return [
                    'event_id' => $event->event_id,
                    'shelter_id' => $event->shelter_id,
                    'name' => $event->shelter ? $event->shelter->name : 'Unknown User',
                    'username' => $event->shelter ? $event->shelter->username : 'Unknown User',
                    'profile_picture' => $event->shelter && $event->shelter->profile_picture ? $event->shelter->profile_picture : 'default-profile.jpg',
                    'event_thumbnail' => $event->event_thumbnail ? $event->event_thumbnail : null,
                    'event_title' => $event->event_title,
                    'event_description' => $event->event_description,
                    'event_start_date' => $event->event_start_date,
                    'event_end_date' => $event->event_end_date,
                    'location' => $event->event_location,
                    'created_at' => $event->created_at->diffForHumans(),
                    'updated_at' => $event->updated_at->diffForHumans(),
                    'likes_count' => $likesCount,
                    'is_liked' => $isLiked,
                    'comments_count' => $event->comments_count,
                ];
            });

            // Return the formatted response as JSON with pagination metadata
            return response()->json([
                'success' => true,
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

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Error fetching user events: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], 500);
        }
    }
}
