<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BrowseController extends Controller
{
    public function browseAccounts()
    {
        $users = User::select('user_id', 'name', 'email', 'profile_picture', 'role', 'status', 'is_online', 'last_online', 'bio')->get();
        
        // Return the users as a JSON response
        return response()->json($users);
    }
}
