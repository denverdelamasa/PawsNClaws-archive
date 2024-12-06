<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function getProfilePicture()
    {
        // Assuming the user is authenticated
        $user = auth()->user(); // This fetches the authenticated user

        // You can change the response to include other user details as needed
        return response()->json([
            'profileImage' => $user->profile_image, // Adjust field as necessary
            'username' => $user->name, // Optionally include username or other data
            // Add any other necessary data here
        ]);
    }
}
