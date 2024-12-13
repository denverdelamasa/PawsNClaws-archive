<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoneAdoptionForm;
use App\Models\AdoptionApplication;
use App\Models\Notification;

class AdoptionFormController extends Controller
{
    public function submitAdoption(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,user_id',
            'post_id' => 'required|exists:posts,post_id',
            'adopter_name' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'adopt_type' => 'required|in:individual,organization,shelter',
            'employment_status' => 'required|in:student,employed,volunteer',
            'socmed' => 'nullable|url',
            'location' => 'required|string|max:255',
            'experience' => 'required|string',
            'reason' => 'required|string',
            'current_pets' => 'required|integer|min:0',
            'gov_id' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'sender_id' => 'required|exists:users,user_id',
        ]);
    
        // Handle the file upload
        if ($request->hasFile('gov_id')) {
            $path = $request->file('gov_id')->store('gov_ids', 'public');
            $validated['gov_id'] = $path;
        }
    
        $validated['status'] = 'Pending';
    
        // Save to the database
        $adoptionApplication = AdoptionApplication::create($validated);
    
        DoneAdoptionForm::create([
            'done_user_id' => $validated['sender_id'],
            'done_post_id' => $validated['post_id'],
        ]);
    
        // Create and send notification to the receiver
        $notification = new Notification([
            'user_id' => $validated['receiver_id'], // The user receiving the notification
            'type' => 'submitted an adoption application', // Type of notification
            'post_id' => $validated['post_id'], // Optional, relates to the post
            'liked_by_user_id' => null, // Optional, if this is a like-related notification
            'comment_by_user_id' => null, // Optional, if this is comment-related
            'notif_from_receiver' => $validated['sender_id'], // The sender of the application
        ]);
    
        // Save the notification
        $notification->save();
    
        return response()->json(['message' => 'Application submitted successfully!'], 201);
    }
    
}
