<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
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
            ->select('application_id', 'receiver_id','sender_id', 'post_id', 'adopter_name', 'reason', 'status', 'adoption_id')
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
            'name' => 'nullable|string|max:255', // 'name' is now nullable
        ]);
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Update the user's name if it exists in the request
        $validated['name'];
    
        // Save the user with the updated name and possibly the profile picture
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
    
}
