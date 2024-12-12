<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Event;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class CommentsController extends Controller
{
    public function getCommentsByPost($postId)
    {
        // Eager load comments with user relationship
        $comments = Comment::with('user')
            ->where('post_comment_id', $postId)
            ->latest() // Fetch latest comments first
            ->get();
    
        // Format comments for API response
        $formattedComments = $comments->map(function ($comment) {
            return [
                'comment_id' => $comment->comment_id,
                'user' => [
                    'user_id' => $comment->user->user_id,
                    'name' => $comment->user->name,
                    'profile_picture' => $comment->user->profile_picture,
                ],
                'comment' => $comment->comment,
                'created_at' => $comment->created_at->diffForHumans(),
            ];
        });
    
        return response()->json($formattedComments);
    }

    public function postComment(Request $request) {
        $userId = Auth::id();

        $request->validate([
            'post_comment_id' => 'required|exists:posts,post_id',
            'comment' => 'required|string|max:1000',
        ]);
    
        $comment = Comment::create([
            'post_comment_id' => $request->post_comment_id,
            'user_id' => $userId,
            'comment' => $request->comment,
        ]);
    
        $comment->load('user');
    
        // Get the post owner
        $postOwner = Post::find($request->post_comment_id)->user_id;
    
        // Check if the commenter is not the post owner
        if (Auth::id() !== $postOwner) {
            // Create a notification for the post owner
            Notification::create([
                'user_id' => $postOwner,
                'type' => 'commented on your post',
                'comment_by_user_id' => $userId,
                'post_id' => $request->post_comment_id,
                'read_at' => null,
            ]);
        }
    
        return response()->json($comment, 201);
    }

    public function updateComment(Request $request, $commentId)
    {
        // Validate the input
        $request->validate([
            'comment' => 'required|string|max:500', // Adjust max length as needed
        ]);

        // Find the comment
        $comment = Comment::find($commentId);

        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found.',
            ], 404);
        }

        // Check if the authenticated user is the owner of the comment
        if (auth()->id() !== $comment->user_id) {
            return response()->json([
                'message' => 'Unauthorized to edit this comment.',
            ], 403);
        }

        // Update the comment
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json([
            'message' => 'Comment updated successfully.',
            'comment' => $comment,
        ], 200);
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        // Optional: Check if the authenticated user owns the post
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
