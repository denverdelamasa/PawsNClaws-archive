<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Like;

class PostController extends Controller
{
    public function postList()
    {
        // Fetch posts with their associated user data
        $posts = Post::with('user') // Eager load the user relationship
            ->orderBy('created_at', 'desc') // Order by the latest posts
            ->get();

        // Map through the posts and format the response
        $formattedPosts = $posts->map(function ($post) {
            $likesCount = Like::where('posts_id', $post->post_id)->count();
            return [
                'post_id' => $post->post_id,
                'user_id' => $post->user_id,
                'username' => $post->user ? $post->user->username : 'Unknown User', // Fetch username from the related user
                'profile_picture' => $post->user && $post->user->profile_picture ? $post->user->profile_picture : 'default-profile.jpg', // Use default if no profile picture
                'image_path' => $post->image_path ? $post->image_path : null, // Ensure image path exists
                'caption' => $post->caption,
                'created_at' => $post->created_at->format('Y-m-d H:i:s'), // Format the created_at timestamp
                'updated_at' => $post->updated_at->format('Y-m-d H:i:s'), // Format the updated_at timestamp
                'likes_count' => $likesCount,
            ];
        });

        // Return the formatted response as JSON
        return response()->json($formattedPosts, 200);
    }
    
    public function getProfilePicture()
    {
        $user = Auth::user();  // Get the authenticated user

        if (!$user || !$user->profile_picture) {
            // Return a default picture or a placeholder if no profile picture is set
            return response()->json([
                'profile_picture' => 'https://via.placeholder.com/150',  // You can customize this placeholder URL
            ]);
        }

        return response()->json([
            'profile_picture' => asset('storage/' . $user->profile_picture),  // Assuming the profile picture is stored in storage
        ]);
    }
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'caption' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image input
        ]);
    
        // Handle the image upload if a file is provided
        $imagePath = null;
        if ($request->hasFile('image_path') && $request->file('image_path')->isValid()) {
            $imagePath = $request->file('image_path')->store('images/posts', 'public'); // Store image in public/storage/images/posts
        }
    
        // Create a new post and save the caption, image path, and user_id
        $post = new Post();
        $post->caption = $request->input('caption');
        if ($imagePath) {
            $post->image_path = $imagePath; // Store the image path in the post
        }
        $post->user_id = Auth::id(); // Associate the authenticated user with the post
        $post->save();
    
        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post
        ], 201);
    }    

    public function likePost($postId)
    {
        $userId = auth()->id(); // Get the current user's ID
        
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
        ]);
    }
    
}
