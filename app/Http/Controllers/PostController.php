<?php

namespace App\Http\Controllers;

use App\Models\DoneAdoptionForm;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Models\Announcement;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function postList()
    {
        $userId = auth()->id(); // Get the current user's ID
    
        // Fetch posts with their associated user data and comment count
        $posts = Post::with('user') // Eager load the user relationship
            ->withCount('comments') // Eager load and count the number of comments using the defined relationship
            ->orderBy('created_at', 'desc') // Order by the latest posts
            ->get();
    
        // Map through the posts and format the response
        $formattedPosts = $posts->map(function ($post) use ($userId) {
            // Count the number of likes for each post
            $likesCount = Like::where('posts_id', $post->post_id)->count();
    
            // Check if the current user has liked the post
            $isLiked = Like::where('posts_id', $post->post_id)
                            ->where('user_id', $userId)
                            ->exists();

            $isDoneSendingAdoptionForm = DoneAdoptionForm::where('done_post_id', $post->post_id)
                            ->where('done_user_id', $userId)
                            ->exists();
    
            return [
                'post_id' => $post->post_id,
                'user_id' => $post->user_id,
                'name' => $post->user ? $post->user->name : 'Unknown User',
                'username' => $post->user ? $post->user->username : 'Unknown User', // Fetch username from the related user
                'profile_picture' => $post->user && $post->user->profile_picture ? $post->user->profile_picture : 'default-profile.jpg', // Use default if no profile picture
                'image_path' => $post->image_path ? $post->image_path : null, // Ensure image path exists
                'caption' => $post->caption,
                'created_at' => $post->created_at->diffForHumans(), // Format the created_at timestamp
                'updated_at' => $post->updated_at->diffForHumans(), // Format the updated_at timestamp
                'likes_count' => $likesCount,
                'is_liked' => $isLiked, // Add the `is_liked` state for the current user
                'comments_count' => $post->comments_count, // Include the count of comments from the `withCount` query
                'is_adoptable' => $post->is_adoptable, // Include the adoptable status
                'done_sending_adoption_form' => $isDoneSendingAdoptionForm
            ];
        });
    
        // Return the formatted response as JSON
        return response()->json($formattedPosts, 200);
    }
    

    public function createPost(Request $request)
    {
        $request->validate([
            'caption' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_adoptable' => 'nullable|boolean',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image_path') && $request->file('image_path')->isValid()) {
            $imagePath = $request->file('image_path')->store('images/posts', 'public');
        }
    
        $post = new Post();
        $post->caption = $request->input('caption');
        if ($imagePath) {
            $post->image_path = $imagePath;
        }
        $post->user_id = Auth::id();
        $post->is_adoptable = $request->input('is_adoptable', false); // Default to false
        $post->post_path = Str::random(15); // Generate post_path
        $post->save();
    
        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post
        ], 201);
    }

    public function createAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);
    
        $thumbnail = null;
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $thumbnail = $request->file('thumbnail')->store('images/posts', 'public');
        }
    
        $announcement = new Announcement();
        $announcement->title = $request->input('title');
        $announcement->description = $request->input('description');
        if ($thumbnail) {
            $announcement->thumbnail = $thumbnail;
        }
        $announcement->shelter_id = Auth::id();
        $announcement->save();
    
        return response()->json([
            'message' => 'Post created successfully!',
            'announcement' => $announcement
        ], 201);
    }
    
    
    public function updatePost(Request $request, $postId)
    {
        // Find the post by ID
        $post = Post::findOrFail($postId);
    
        // Validate the incoming data (no image validation)
        $validated = $request->validate([
            'caption' => 'required|string',
        ]);
    
        // Update the caption
        $post->caption = $validated['caption'];
    
        // Save the post with the updated caption
        $post->save();
    
        // Return a response (success or error)
        return response()->json([
            'message' => 'Post updated successfully!',
            'post' => $post
        ], 200);
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        // Optional: Check if the authenticated user owns the post
        if ($post->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
    
    public function likePost($postId)
    {
        $userId = auth()->id(); // Get the current user's ID
        
        // Find the post owner
        $postOwner = Post::find($postId)->user_id;
        
        // Check if the user already liked this post
        $like = Like::where('posts_id', $postId)
                    ->where('user_id', $userId)
                    ->first();
    
        if ($like) {
            // Remove like (unlike the post)
            $like->delete(); // Ensure you're deleting the correct record
            return response()->noContent(); // Return 204 No Content
        } else {
            // Add like
            Like::create([
                'posts_id' => $postId,
                'user_id' => $userId,
            ]);
    
            // Check if the current user is not the post owner
            if ($userId !== $postOwner) {
                // Get the username of the user who liked the post
                $likingUser = Auth::id();
    
                // Create a notification for the post owner
                Notification::create([
                    'user_id' => $postOwner, // The user who owns the post
                    'type' => 'liked your post', // Notification type, you can customize this
                    'liked_by_user_id' => $likingUser, // Add the username of the user who liked the post
                    'post_id' => $postId,
                    'read_at' => null, // Default is unread
                ]);
            }
    
            return response()->noContent(); // Return 204 No Content
        }
    }    
    
    public function getLikesCount($postId)
    {
        $likesCount = Like::where('posts_id', $postId)->count();
        return response()->json(['likesCount' => $likesCount]);
    }

    public function getUserProfile()
    {
        $user = Auth::user(); // Get the currently authenticated user

        return response()->json([
            'profile_picture' => $user->profile_picture, // Assuming `profile_picture` is a field in the users table
            'username' => $user->name, // Username or any identifier
            'role' => $user->role
        ]);
    }
    
}
