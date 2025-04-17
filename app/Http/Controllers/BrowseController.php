<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Like;
use App\Models\DoneAdoptionForm;

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
                  ->orWhere('email', 'like', '%'.$search.'%')
                  ->orWhere('bio', 'like', '%'.$search.'%');
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
                  ->orWhere('email', 'like', '%'.$search.'%')
                  ->orWhere('bio', 'like', '%'.$search.'%');
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
                                ->orWhere('username', 'like', "%{$search}%")
                                ->orWhere('bio', 'like', "%{$search}%");
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
}
