<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\Post;
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
        ]);
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Update the user's name only if it exists in the request
        if (array_key_exists('name', $validated) && $validated['name'] !== null) {
            $user->name = $validated['name'];
        }
    
        // Save the user with the updated name (if provided)
        $user->save();
    
        // Return a success response with the updated user data
        return response()->json([
            'message' => 'Profile updated successfully',
            'name' => $user->name,
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
        $userId = auth()->id(); // Get the authenticated user's ID
    
        // Fetch only the posts created by the authenticated user
        $posts = Post::with('user') // Eager load the user relationship
            ->withCount('comments') // Count the number of comments using the defined relationship
            ->where('user_id', $userId) // Filter posts by the authenticated user
            ->orderBy('created_at', 'desc') // Order posts by latest
            ->get();
    
        // Format the response for each post
        $formattedPosts = $posts->map(function ($post) use ($userId) {
            // Count the number of likes for each post
            $likesCount = Like::where('posts_id', $post->post_id)->count();
    
            // Check if the current user has liked the post
            $isLiked = Like::where('posts_id', $post->post_id)
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
                'image_path' => $post->image_path ? $post->image_path : null, // Ensure image path exists
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
    
        // Return the formatted response as JSON
        return response()->json($formattedPosts, 200);
    }

    public function acceptApplication($id)
    {
        // Find the adoption application by its ID
        $application = AdoptionApplication::findOrFail($id);

        // Update the status to "Ongoing"
        $application->status = 'Ongoing';

        // Save the application
        $application->save();

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

        // Save the application
        $application->save();

        // Optionally, you can return a response
        return response()->json([
            'message' => 'Adoption application status updated to Ongoing.',
            'application' => $application
        ]);
    }
}
