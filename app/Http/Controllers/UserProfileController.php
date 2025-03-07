<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Carbon\Carbon;
use App\Models\Like;
use App\Models\Post;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\DoneAdoptionForm;
use App\Models\AdoptionApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function getUserProfile()
    {
        $user = auth()->user();  // Or fetch a specific user based on ID
        return response()->json([
            'name' => $user->name,
            'username' => $user->username,
            'profile_picture' => $user->profile_picture,
            'role' => $user->role,
            'bio' => $user->bio,  // Make sure this field exists in the database or is properly fetched
        ]);
    }
    public function getAdoptionList()
    {
        $receiverId = Auth::id();
    
        $adoptionApplications = AdoptionApplication::where('receiver_id', $receiverId)
            ->with([
                'post',
                'receiver' => function ($query) {
                    $query->select('user_id', 'name', 'username', 'profile_picture');
                },
                'sender' => function ($query) {
                    $query->select('user_id', 'name', 'username', 'profile_picture');
                }
            ])
            ->select('application_id', 'receiver_id','sender_id', 'post_id', 'adopter_name', 'contact_info', 'adopt_type', 'employment_status', 'socmed', 'location', 
            'experience', 'current_pets','reason', 'status', 'adoption_id', 'gov_id')
            ->latest()
            ->get();
    
        $adoptionApplications->each(function ($application) {
            $application->adopter_account = $application->sender->name ?? 'Unknown Adopter';
            $application->adopter_profile = $application->sender->profile_picture ?? null;
            $application->adoption_code = $application->adoption_id;
        });
    
        return response()->json($adoptionApplications);
    }

    public function updateUser(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'nullable|string|max:255', // 'name' is nullable
            'bio' => 'nullable|string|max:1000', // 'bio' is nullable and not unique
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Allow image upload
        ]);
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Update the user's name if it exists in the request
        if (array_key_exists('name', $validated) && $validated['name'] !== null) {
            $user->name = $validated['name'];
        }
    
        // Update the user's bio if it exists in the request
        if (array_key_exists('bio', $validated) && $validated['bio'] !== null) {
            $user->bio = $validated['bio'];
        }
    
        // Update the user's profile picture if it exists in the request
        if ($request->hasFile('profile_picture')) {
            // Check if the file is valid
            if ($request->file('profile_picture')->isValid()) {
                // Delete the old profile picture if it exists
                if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
    
                // Store the new profile picture and update profile picture path
                $imagePath = $request->file('profile_picture')->store('images/profile_pictures', 'public');
                $user->profile_picture = $imagePath;
            }
        }
    
        // Save the user with the updated fields (if provided)
        $user->save();
    
        // Return a success response with the updated user data
        return response()->json([
            'message' => 'Profile updated successfully',
            'name' => $user->name,
            'bio' => $user->bio,
            'profile_picture' => $user->profile_picture ? asset('storage/' . $user->profile_picture) : null, // Return the full URL of the profile picture
        ]);
    }
    
    public function update(Request $request)
    {
        $user = auth()->user();
    
        // Validation rules for fields
        $rules = [];
    
        // Validate username if it's being changed
        if ($request->has('username') && $request->username !== $user->username) {
            $rules['username'] = 'required|string|max:255|unique:users,username,' . $user->user_id . ',user_id';
        }
    
        // Validate email if it's being changed
        if ($request->has('email') && $request->email !== $user->email) {
            $rules['email'] = 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id';
        }
    
        // Validate profile picture if it is uploaded
        if ($request->hasFile('profile_picture')) {
            $rules['profile_picture'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }
    
        // Validate the submitted data
        $validatedData = $request->validate($rules);
    
        // Fill the user's information
        $user->fill($validatedData);
    
        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Check if the file is valid
            if ($request->file('profile_picture')->isValid()) {
                // Delete the old profile picture if it exists
                if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                }
    
                // Store the new profile picture and update profile picture path
                $path = $request->file('profile_picture')->store('images/profile_pictures', 'public');
                $user->profile_picture = $path;
            } else {
            }
        }
    
        // Save the updated user information
        $user->save();
    
        // Return a response indicating the profile was updated successfully
        return redirect()->route('client.profile.edit')->with('status', 'profile-updated');
    }


    public function userPostList()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
    
        // Fetch only the posts created by the authenticated user, paginated by 10 posts per page
        $posts = Post::with('user') // Eager load the user relationship
            ->withCount('comments') // Count the number of comments using the defined relationship
            ->where('user_id', $userId) // Filter posts by the authenticated user
            ->orderBy('created_at', 'desc') // Order posts by latest
            ->paginate(3); // Paginate the results, 10 posts per page
    
        // Format the response for each post
        $formattedPosts = $posts->map(function ($post) use ($userId) {
            // Count the number of likes for each post
            $likesCount = Like::where('post_id', $post->post_id)->count();
    
            // Check if the current user has liked the post
            $isLiked = Like::where('post_id', $post->post_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            // Check if the user has completed the adoption form for this post
            $isDoneSendingAdoptionForm = DoneAdoptionForm::where('done_post_id', $post->post_id)
                                ->where('done_user_id', $userId)
                                ->exists();
    
            return [
                'post_id' => $post->post_id,
                'user_id' => $post->user_id,
                'name' => $post->user ? $post->user->name : 'Unknown User',
                'username' => $post->user ? $post->user->username : 'Unknown User', // Fetch username from the related user
                'profile_picture' => $post->user && $post->user->profile_picture ? $post->user->profile_picture : 'default-profile.jpg', // Use default if no profile picture
                'image_path' => $post->image_path ? json_decode($post->image_path, true) : [],
                'caption' => $post->caption,
                'created_at' => $post->created_at->diffForHumans(), // Format the created_at timestamp
                'updated_at' => $post->updated_at->diffForHumans(), // Format the updated_at timestamp
                'likes_count' => $likesCount,
                'is_liked' => $isLiked, // Add the `is_liked` state for the current user
                'comments_count' => $post->comments_count, // Include the count of comments from the `withCount` query
                'is_adoptable' => $post->is_adoptable, // Include the adoptable status
                'done_sending_adoption_form' => $isDoneSendingAdoptionForm // Add adoption form status
            ];
        });
    
        // Return the formatted response as JSON with pagination metadata
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

    public function userAnnouncementList()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
    
        // Fetch only the posts created by the authenticated user, paginated by 10 posts per page
        $announcements = Announcement::with('shelter') // Eager load the user relationship
            ->withCount('comments') // Count the number of comments using the defined relationship
            ->where('shelter_id', $userId) // Filter posts by the authenticated user
            ->orderBy('created_at', 'desc') // Order posts by latest
            ->paginate(3); // Paginate the results, 10 posts per page
    
        // Format the response for each post
        $formattedAnnouncement = $announcements->map(function ($announcement) use ($userId) {
            // Count the number of likes for each post
            $likesCount = Like::where('announcement_id', $announcement->announcement_id)->count();
    
            // Check if the current user has liked the post
            $isLiked = Like::where('announcement_id', $announcement->announcement_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            // Check if the user has completed the adoption form for this post
            $isDoneSendingAdoptionForm = DoneAdoptionForm::where('done_post_id', $announcement->announcement_id)
                                ->where('done_user_id', $userId)
                                ->exists();
    
            return [
                'announcement_id' => $announcement->announcement_id,
                'user_id' => $announcement->shelter_id,
                'name' => $announcement->shelter ? $announcement->shelter->name : 'Unknown User',
                'username' => $announcement->shelter ? $announcement->shelter->username : 'Unknown User', // Fetch username from the related user
                'profile_picture' => $announcement->shelter && $announcement->shelter->profile_picture ? $announcement->shelter->profile_picture : 'default-profile.jpg', // Use default if no profile picture
                'thumbnail' => $announcement->thumbnail ? json_decode($announcement->thumbnail, true) : [],
                'title' => $announcement->title,
                'description' => $announcement->description,
                'created_at' => $announcement->created_at->diffForHumans(), // Format the created_at timestamp
                'updated_at' => $announcement->updated_at->diffForHumans(), // Format the updated_at timestamp
                'likes_count' => $likesCount,
                'is_liked' => $isLiked, // Add the `is_liked` state for the current user
                'comments_count' => $announcement->comments_count, // Include the count of comments from the `withCount` query
                'is_adoptable' => $announcement->is_adoptable, // Include the adoptable status
                'done_sending_adoption_form' => $isDoneSendingAdoptionForm // Add adoption form status
            ];
        });
    
        // Return the formatted response as JSON with pagination metadata
        return response()->json([
            'announcement' => $formattedAnnouncement,
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

    public function acceptApplication($id)
    {
        // Find the adoption application by its ID
        $application = AdoptionApplication::findOrFail($id);
    
        // Update the status to "Ongoing"
        $application->status = 'Ongoing';
    
        // Save the application
        $application->save();
    
        // Create and send notification to the user who submitted the application
        $notification = new Notification([
            'user_id' => $application->sender_id,  // The user who submitted the application
            'type' => 'confirmed your adoption request form',  // Type of notification (e.g., 'info', 'warning')
            'post_id' => null, // Optional, set this if the notification is related to a post
            'liked_by_user_id' => null,  // Optional, if this is a like-related notification
            'comment_by_user_id' => null,  // Optional, if this is comment-related
            'notif_from_receiver' => Auth::id()
        ]);
    
        // Save the notification to the database
        $notification->save();
    
        // Optionally, you can return a response
        return response()->json([
            'message' => 'Adoption application status updated to Ongoing.',
            'application' => $application
        ]);
    }

    public function rejectApplication($id)
    {
        // Find the adoption application by its ID
        $application = AdoptionApplication::findOrFail($id);

        $application->status = 'Reject';
        // Save the application
        $application->save();

        $notification = new Notification([
            'user_id' => $application->sender_id,  // The user who submitted the application
            'type' => 'rejected your adoption request form',  // Type of notification (e.g., 'info', 'warning')
            'post_id' => null, // Optional, set this if the notification is related to a post
            'liked_by_user_id' => null,  // Optional, if this is a like-related notification
            'comment_by_user_id' => null,  // Optional, if this is comment-related
            'notif_from_receiver' => Auth::id()
        ]);

        $notification->save();

        // Optionally, you can return a response
        return response()->json([
            'message' => 'Adoption application status updated to Ongoing.',
            'application' => $application
        ]);
    }

    public function completeAdoption($id)
    {
        // Find the adoption application by its ID
        $application = AdoptionApplication::findOrFail($id);
    
        // Update the status to "Complete"
        $application->status = 'Complete';
    
        // Save the application
        $application->save();
    
        // Update the related post's `is_adoptable` field to 2
        $post = Post::find($application->post_id);
        if ($post) {
            $post->is_adoptable = 2; // Set is_adoptable to 2
            $post->save();
        }
    
        // Create and send notification to the user who submitted the application
        $notification = new Notification([
            'user_id' => $application->sender_id,  // The user who submitted the application
            'type' => 'your adoption process is completed',  // Type of notification
            'post_id' => null, // Optional, set this if the notification is related to a post
            'liked_by_user_id' => null,  // Optional, if this is a like-related notification
            'comment_by_user_id' => null,  // Optional, if this is comment-related
            'notif_from_receiver' => Auth::id()  // The user who completed the adoption (current authenticated user)
        ]);
    
        // Save the notification to the database
        $notification->save();
    
        // Return a JSON response
        return response()->json([
            'message' => 'Adoption application status updated to Complete and post marked as adopted.',
            'application' => $application,
            'post' => $post
        ]);
    }

    public function failAdoption($id)
    {
        // Find the adoption application by its ID
        $application = AdoptionApplication::findOrFail($id);

        $application->status = 'Failed';
        // Save the application
        $application->save();

        $notification = new Notification([
            'user_id' => $application->sender_id,  // The user who submitted the application
            'type' => 'your adoption process is failed',  // Type of notification (e.g., 'info', 'warning')
            'post_id' => null, // Optional, set this if the notification is related to a post
            'liked_by_user_id' => null,  // Optional, if this is a like-related notification
            'comment_by_user_id' => null,  // Optional, if this is comment-related
            'notif_from_receiver' => Auth::id()
        ]);

        $notification->save();

        // Optionally, you can return a response
        return response()->json([
            'message' => 'Adoption application status updated to Failed.',
            'application' => $application
        ]);
    }
}
