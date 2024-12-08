<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoneAdoptionForm;
use App\Models\AdoptionApplication;

class AdoptionFormController extends Controller
{
    public function submitAdoption(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
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
        ]);

        // Handle the file upload
        if ($request->hasFile('gov_id')) {
            $path = $request->file('gov_id')->store('uploads', 'public');
            $validated['gov_id'] = $path;
        }

        // Save to the database
        AdoptionApplication::create($validated);

        DoneAdoptionForm::create([
            'done_user_id' => $validated['user_id'],
            'done_post_id' => $validated['post_id'],
            'status' => 'Done', // Default status
        ]);

        return response()->json(['message' => 'Application submitted successfully!'], 201);
    }
}
