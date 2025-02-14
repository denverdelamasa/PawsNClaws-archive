<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\Like;

class AnnouncementController extends Controller
{
    public function announcementList()
    {
        $userId = Auth::id(); // Get the current user's ID

        // Fetch announcements with their associated user data and comment count
        $announcements = Announcement::with('shelter') // Eager load the shelter relationship
            ->withCount('comments') // Eager load and count the number of comments using the defined relationship
            ->orderBy('created_at', 'desc') // Order by the latest announcements
            ->get();

        // Map through the announcements and format the response
        $formattedAnnouncements = $announcements->map(function ($announcement) use ($userId) {
            // Count the number of likes for each announcement
            $likesCount = Like::where('announcement_id', $announcement->announcement_id)->count();

            // Check if the current user has liked the announcement
            $isLiked = Like::where('announcement_id', $announcement->announcement_id)
                            ->where('user_id', $userId)
                            ->exists();


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
                'likes_count' => $likesCount,
                'is_liked' => $isLiked, // Add the `is_liked` state for the current user
                'comments_count' => $announcement->comments_count, // Include the count of comments from the `withCount` query
                'is_adoptable' => $announcement->is_adoptable, // Include the adoptable status
            ];
        });

        // Return the formatted response as JSON
        return response()->json($formattedAnnouncements, 200);
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
}
