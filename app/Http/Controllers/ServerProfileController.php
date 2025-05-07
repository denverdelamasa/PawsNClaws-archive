<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ServerProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.adminEdit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
    
        // Validation rules for fields
        $rules = [];

        // Validate if base64 image is sent
        if ($request->filled('cropped_image')) {
            $rules['cropped_image'] = 'string';
        }

        if ($request->has('name') && $request->name !== $user->name) {
            $rules['name'] = 'required|string|max:255';
        }

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

        // Handle cropped image (base64)
        if ($request->filled('cropped_image')) {
            $data = $request->input('cropped_image');

            // Remove the base64 header
            $image = preg_replace('#^data:image/\w+;base64,#i', '', $data);
            $image = str_replace(' ', '+', $image);

            // Generate unique file name
            $fileName = 'profile_' . time() . '.png';
            $filePath = 'images/profile_pictures/' . $fileName;

            // Delete old image if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Save the image
            Storage::disk('public')->put($filePath, base64_decode($image));
            $user->profile_picture = $filePath;
        }
        // Handle regular file upload
        elseif ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            // Delete old profile picture if it exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store the new one
            $path = $request->file('profile_picture')->store('images/profile_pictures', 'public');
            $user->profile_picture = $path;
        }
    
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
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
