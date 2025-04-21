<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Bookmark;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function announcementList()
    {
        $userId = Auth::id(); // Get the current user's ID
    
        // Fetch announcements with their associated user data, comment count, and likes count
        $announcements = Announcement::with('shelter') // Eager load the shelter relationship
            ->withCount('comments') // Eager load and count the number of comments using the defined relationship
            ->orderBy('created_at', 'desc') // Order by the latest announcements
            ->paginate(3);
    
        // Map through the announcements and format the response
        $formattedAnnouncements = $announcements->map(function ($announcement) use ($userId) {
            // Count the number of likes for each announcement
            $likesCount = Like::where('announcement_id', $announcement->announcement_id)->count();
    
            // Check if the current user has liked the announcement
            $isLiked = Like::where('announcement_id', $announcement->announcement_id)
                            ->where('user_id', $userId)
                            ->exists();

            $isBookmarked = Bookmark::where('announcement_id', $announcement->announcement_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            // Return the formatted announcement data
            return [
                'announcement_id' => $announcement->announcement_id,
                'shelter_id' => $announcement->shelter_id,
                'name' => $announcement->shelter ? $announcement->shelter->name : 'Unknown Shelter',
                'username' => $announcement->shelter ? $announcement->shelter->username : 'Unknown Shelter', // Fetch username from the related shelter
                'profile_picture' => $announcement->shelter && $announcement->shelter->profile_picture ? $announcement->shelter->profile_picture : 'default-profile.jpg', // Use default if no profile picture
                'thumbnail' => $announcement->thumbnail ? $announcement->thumbnail : null, // Ensure image path exists
                'title' => $announcement->title,
                'description' => $announcement->description,
                'created_at' => $announcement->created_at->diffForHumans(), // Format the created_at timestamp
                'updated_at' => $announcement->updated_at->diffForHumans(), // Format the updated_at timestamp
                'likes_count' => $likesCount, // Include likes count for the announcement
                'is_liked' => $isLiked, // Include the `is_liked` state for the current user
                'comments_count' => $announcement->comments_count, // Include the count of comments from the `withCount` query
                'is_adoptable' => $announcement->is_adoptable, // Include the adoptable status
                'is_bookmarked' => $isBookmarked
            ];
        });
    
        // Return the formatted response as JSON
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
        ],200);
    }

    public function announcementWelcome()
    {
        $userId = Auth::id(); // Get the current user's ID
    
        // Fetch the latest announcement with its associated shelter data and comment count
        $announcement = Announcement::with('shelter')
            ->withCount('comments')
            ->latest('created_at')
            ->first(); // Get only the latest announcement
    
        if (!$announcement) {
            return response()->json(['message' => 'No announcements available'], 404);
        }
    
        // Count the number of likes for the announcement
        $likesCount = Like::where('announcement_id', $announcement->announcement_id)->count();
    
        // Check if the current user has liked the announcement
        $isLiked = Like::where('announcement_id', $announcement->announcement_id)
                        ->where('user_id', $userId)
                        ->exists();
    
        // Format the response
        $formattedAnnouncement = [
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
    
        // Return the formatted response as JSON
        return response()->json($formattedAnnouncement, 200);
    }

    public function createAnnouncement(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
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

    public function updateAnnouncement(Request $request, $announcementId)
    {
        // Find the post by ID
        $announcement = Announcement::findOrFail($announcementId);
    
        // Validate the incoming data (no image validation)
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);
    
        // Update the caption
        $announcement->title = $validated['title'];
        $announcement->description = $validated['description'];
    
        // Save the post with the updated caption
        $announcement->save();
    
        // Return a response (success or error)
        return response()->json([
            'message' => 'Post updated successfully!',
            'announcement' => $announcement
        ], 200);
    }

    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::findOrFail($id);

        // Optional: Check if the authenticated user owns the post
        if ($announcement->shelter_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $announcement->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
