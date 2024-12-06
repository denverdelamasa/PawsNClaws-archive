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
        $user = Auth::user();  // Get the authenticated user

        if (!$user || !$user->profile_picture) {
            // Return a default picture or a placeholder if no profile picture is set
            return response()->json([
                'profile_picture' => 'https://via.placeholder.com/150',  // You can customize this placeholder URL
            ]);
        }

        return response()->json([
            'profile_picture' => asset('storage/' . $user->profile_picture),  // Assuming the profile picture is stored in storage
        ]);
    }
}
