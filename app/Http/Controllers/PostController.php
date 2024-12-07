<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function posts()
    {
        
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
    
}
