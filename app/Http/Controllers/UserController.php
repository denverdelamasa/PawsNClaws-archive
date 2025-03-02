<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsersList()
    {
        // Fetch users with 'last_online' field
        $users = User::select('user_id', 'name', 'email', 'profile_picture', 'role', 'status', 'is_online', 'last_online')->get();
        
        $users->each(function ($user) {
            // Check if last_online exists and format it using Carbon
            if ($user->last_online) {
                // Ensure last_online is in the past and calculate the difference from the current time
                $user->last_online = Carbon::parse($user->last_online)->diffForHumans(Carbon::now(), true); // 'true' ensures a human-readable format without "from now"
            }
        });
        
        // Return the users as a JSON response
        return response()->json($users);
    }
    
    public function updateRole(Request $request, $user_id)
    {
        // Check if the currently authenticated user is an Admin
        if (Auth::user()->role !== 'Admin') {
            return response()->json(['error' => 'Unauthorized: Only admins can update user roles'], 403);
        }

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'role' => 'required|in:User,Shelter,Vet Clinic,Moderator,Admin', // Ensures role is one of the allowed values
        ]);

        // If validation fails, return a response with the validation errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Find the user by ID
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Update the user's role
        $user->role = $request->role;
        $user->save();

        // Return a success response
        return response()->json(['message' => 'User role updated successfully', 'user' => $user]);
    }

    public function suspendUser(Request $request, $userId)
    {
        // Validate the duration input
        $request->validate([
            'duration' => 'required|integer|min:1', // Duration must be an integer (days)
        ]);

        // Find the user by ID
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        // Calculate the suspension end date
        $suspendUntil = Carbon::now()->addDays((int) $request->input('duration'));


        // Update the user's status and suspension end date
        $user->status = 'Suspended';
        $user->suspended_until = $suspendUntil;
        $user->save();

        return response()->json([
            'message' => 'User suspended successfully',
            'suspended_until' => $suspendUntil,
        ], 200);
    }

    // Reactivate a user whose suspension has expired
    public function reactivateUser($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        if ($user->status !== 'Suspended' || Carbon::now()->lessThan($user->suspend_until)) {
            return response()->json([
                'message' => 'User is not eligible for reactivation',
            ], 400);
        }

        // Update the user's status to active
        $user->status = 'Active';
        $user->suspended_until = null;
        $user->save();

        return response()->json([
            'message' => 'User reactivated successfully',
        ], 200);
    }

    // Delete User Method
    public function deleteUser($userId)
    {
        // Find the user by ID
        $user = User::find($userId);

        // Check if user exists
        if (!$user) {
            return response()->json([
                'error' => 'User not found.'
            ], 404);
        }

        // Delete the user
        try {
            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully and logged out.'
            ], 200);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error("Error deleting user: " . $e->getMessage());

            return response()->json([
                'error' => 'Error deleting user. Please try again later.'
            ], 500);
        }
    }

    public function getCurrentUserRole()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Return the role of the authenticated user
            return response()->json(['role' => $user->role], 200);
        }

        // If not authenticated, return an unauthorized response
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
