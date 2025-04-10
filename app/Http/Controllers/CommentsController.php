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
    public function getComments($id, $type)
    {
        \Log::info("Fetching Comments for ID: $id, Type: $type");
        // Determine the type of comment to fetch
        if ($type === 'announcement') {
            $comments = Comment::with('user')
                ->where('announcement_comment_id', $id)
                ->latest()
                ->paginate(10);
                $commentsCount = Comment::where('announcement_comment_id', $id)->count();
        } elseif ($type === 'post') {
            $comments = Comment::with('user')
                ->where('post_comment_id', $id)
                ->latest()
                ->paginate(10);
                $commentsCount = Comment::where('post_comment_id', $id)->count();
        } else if ($type === 'event') {
            $comments = Comment::with('user')
                ->where('event_comment_id', $id)
                ->latest()
                ->paginate(10);
                $commentsCount = Comment::where('event_comment_id', $id)->count();
        } else {
            return response()->json(['error' => 'Invalid comment type'], 400);
        }

        \Log::info("Comments fetched: " . json_encode($comments));
    
        // Format comments for API response
        $formattedComments = $comments->map(function ($comment) {
            return [
                'comment_id' => $comment->comment_id,
                'user_id' => $comment->user_id,
                'announcement_comment_id' => $comment->announcement_comment_id,
                'post_comment_id' => $comment->post_comment_id,
                'event_comment_id' => $comment->event_comment_id,
                'user' => [
                    'user_id' => $comment->user->user_id,
                    'name' => $comment->user->name,
                    'profile_picture' => $comment->user->profile_picture,
                ],
                'comment' => $comment->comment,
                'created_at' => $comment->created_at->diffForHumans(),
            ];
        });
    
        // Include pagination info in the response
        return response()->json([
            'data' => $formattedComments,
            'current_page' => $comments->currentPage(),
            'last_page' => $comments->lastPage(),
            'per_page' => $comments->perPage(),
            'total' => $comments->total(),
            'comments_count' => $commentsCount,
        ]);
    }
    public function postComment(Request $request) {
        $userId = Auth::id();
    
        // Validate the request
        $request->validate([
            'comment' => 'required|string|max:1000',
            'post_comment_id' => 'nullable|exists:posts,post_id',
            'announcement_comment_id' => 'nullable|exists:announcements,announcement_id',
            'event_comment_id' => 'nullable|exists:events,event_id'
        ]);
    
        // Ensure only one of post_comment_id or announcement_comment_id is provided
        if ($request->has('post_comment_id') && $request->has('announcement_comment_id') && $request->has('event_comment_id')) {
            return response()->json(['error' => 'Only one of post_comment_id or announcement_comment_id can be provided.'], 400);
        }
    
        if (!$request->has('post_comment_id') && !$request->has('announcement_comment_id') && !$request->has('event_comment_id')) {
            return response()->json(['error' => 'Either post_comment_id or announcement_comment_id must be provided.'], 400);
        }
    
        // Create the comment
        $comment = Comment::create([
            'post_comment_id' => $request->post_comment_id,
            'announcement_comment_id' => $request->announcement_comment_id,
            'event_comment_id' => $request->event_comment_id,
            'user_id' => $userId,
            'comment' => $request->comment,
        ]);
    
        // Load the user relationship
        $comment->load('user');
    
        // Handle notifications
        if ($request->has('post_comment_id')) {
            // Get the post owner
            $postOwner = Post::find($request->post_comment_id)->user_id;
    
            // Check if the commenter is not the post owner
            if ($userId !== $postOwner) {
                // Create a notification for the post owner
                Notification::create([
                    'user_id' => $postOwner,
                    'type' => 'commented on your post',
                    'comment_by_user_id' => $userId,
                    'post_id' => $request->post_comment_id,
                    'read_at' => null,
                ]);
            }
        } elseif ($request->has('announcement_comment_id')) {
            // Get the announcement owner
            $announcementOwner = Announcement::find($request->announcement_comment_id)->shelter_id;
    
            // Check if the commenter is not the announcement owner
            if ($userId !== $announcementOwner) {
                // Create a notification for the announcement owner
                Notification::create([
                    'user_id' => $announcementOwner,
                    'type' => 'commented on your announcement',
                    'comment_by_user_id' => $userId,
                    'announcement_id' => $request->announcement_comment_id,
                    'read_at' => null,
                ]);
            }
        }   elseif ($request->has('event_comment_id')) {
            // Get the event owner
            $eventOwner = Event::find($request->event_comment_id)->shelter_id;
    
            // Check if the commenter is not the announcement owner
            if ($userId !== $eventOwner) {
                // Create a notification for the announcement owner
                Notification::create([
                    'user_id' => $eventOwner,
                    'type' => 'commented on your event',
                    'comment_by_user_id' => $userId,
                    'event_id' => $request->event_comment_id,
                    'read_at' => null,
                ]);
            }
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
        if (Auth::id() !== $comment->user_id) {
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
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
