<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Event;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function getCommentsByPost($postId)
    {
        $comments = Comment::with('user')  // Eager load the user relationship
            ->where('post_comment_id', $postId)
            ->get();
    
        // Format the created_at field for each comment
        $comments->each(function ($comment) {
            $comment->created_at = $comment->created_at->diffForHumans(); // Format created_at
        });
    
        // Optionally include user_id in the response explicitly
        $formattedComments = $comments->map(function ($comment) {
            return [
                'comment_id' => $comment->id,
                'user_id' => $comment->user_id, // Include user_id
                'comment' => $comment->comment,
                'created_at' => $comment->created_at,
                'user' => $comment->user, // Include the user details
            ];
        });
    
        return response()->json($formattedComments);
    }
    
    

    public function postComment(Request $request)
    {
        $request->validate([
            'post_comment_id' => 'required|exists:posts,post_id', // Change posts_id to post_id
            'comment' => 'required|string|max:1000',             // Comment must be valid and not too long
        ]);
    
        $comment = Comment::create([
            'post_comment_id' => $request->post_comment_id,
            'user_id' => Auth::id(),  // Get the authenticated user's ID
            'comment' => $request->comment,
        ]);
    
        // Load the related user to include user data in the response
        $comment->load('user');
    
        return response()->json($comment, 201); // Return the created comment with user data
    }
}
