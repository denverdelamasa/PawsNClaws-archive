<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\VerifyApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VerifyApplicationController extends Controller
{
    /**
     * Submit a verification application.
     */
    public function applyForVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'documents' => 'required|array|min:1',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:2048',
            'role' => 'required|string|in:shelter,vet',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $documentPaths = [];
        foreach ($request->file('documents') as $file) {
            $path = $file->store('verification_documents', 'public');
            $documentPaths[] = $path;
        }

        $application = VerifyApplication::create([
            'user_id' => Auth::id(),
            'documents' => json_encode($documentPaths),
            'role' => $request->role,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Verification application submitted successfully.',
            'application' => $application,
        ], 201);
    }

    /**
     * Fetch all verification applications (for admins).
     */
    public function getAllApplications(Request $request)
    {
        // Check if user is admin (assumes 'role' column in users table)
        if (Auth::user()->role !== 'Admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.',
            ], 403);
        }

        $query = VerifyApplication::with('user:id,name,email,profile_picture')
            ->orderBy('created_at', 'desc');

        // Optional filters
        if ($request->has('role')) {
            $query->where('role', $request->input('role'));
        }
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $applications = $query->paginate(10);

        // Transform documents to include full URLs
        $applications->getCollection()->transform(function ($application) {
            $application->documents = json_decode($application->documents, true);
            $application->documents = array_map(function ($path) {
                return Storage::url($path);
            }, $application->documents);
            return $application;
        });

        return response()->json([
            'success' => true,
            'applications' => $applications->items(),
            'pagination' => [
                'current_page' => $applications->currentPage(),
                'last_page' => $applications->lastPage(),
                'total' => $applications->total(),
            ],
        ], 200);
    }

    /**
     * Fetch the authenticated user's verification applications.
     */
    public function getApplicationsByUserId(Request $request, $userId = null)
    {
        // If no userId is provided, use the authenticated user's ID
        $targetUserId = $userId ?? Auth::id();

        // Restrict non-admin users to only their own applications
        if (Auth::user()->role !== 'Admin' && $targetUserId != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access. You can only view your own applications.',
            ], 403);
        }

        $perPage = $request->input('per_page', 10);
        $applications = VerifyApplication::where('user_id', $targetUserId)
            ->with('user:user_id,name,email,profile_picture')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        if ($applications->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No verification applications found for this user.',
            ], 404);
        }

        $applications->getCollection()->transform(function ($application) {
            $application->documents = json_decode($application->documents, true);
            $application->documents = array_map(function ($path) {
                return Storage::url($path);
            }, $application->documents);
            return $application;
        });

        return response()->json([
            'success' => true,
            'applications' => $applications->items(),
            'pagination' => [
                'current_page' => $applications->currentPage(),
                'last_page' => $applications->lastPage(),
                'total' => $applications->total(),
                'per_page' => $applications->perPage(),
            ],
        ], 200);
    }

    public function acceptApplication(Request $request, $verifyId)
    {
        // Check if the user is an admin
        if (Auth::user()->role !== 'Admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access. Only admins can accept applications.',
            ], 403);
        }

        // Find the verification application
        $application = VerifyApplication::find($verifyId);

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Verification application not found.',
            ], 404);
        }

        // Check if the application is still pending
        if ($application->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Application is not pending and cannot be accepted.',
            ], 400);
        }

        try {
            // Update application status to approved
            $application->status = 'approved';
            $application->save();

            // Update the user's role based on the application
            $user = User::find($application->user_id);
            if ($user) {
                $newRole = $application->role === 'shelter' ? 'Shelter' : 'Vet Clinic';
                $user->role = $newRole;
                $user->save();
            } else {
                Log::warning("User not found for application ID: {$verifyId}");
            }

            // Create notification for the user
            Notification::create([
                'user_id' => $application->user_id,
                'type' => 'verification approved',
                'notif_from_receiver' => Auth::id(),
                'read_at' => null,
                'post_id' => null,
                'event_id' => null,
                'announcement_id' => null,
                'liked_by_user_id' => null,
                'comment_by_user_id' => null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Verification application approved successfully.',
                'application' => [
                    'verify_id' => $application->verify_id,
                    'user_id' => $application->user_id,
                    'role' => $application->role,
                    'status' => $application->status,
                    'updated_at' => $application->updated_at,
                ],
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error accepting verification application ID {$verifyId}: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to accept verification application.',
            ], 500);
        }
    }

    /**
     * Reject a verification application.
     *
     * @param Request $request
     * @param int $verifyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function rejectApplication(Request $request, $verifyId)
    {
        // Check if the user is an admin
        if (Auth::user()->role !== 'Admin') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access. Only admins can reject applications.',
            ], 403);
        }

        // Find the verification application
        $application = VerifyApplication::find($verifyId);

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Verification application not found.',
            ], 404);
        }

        // Check if the application is still pending
        if ($application->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Application is not pending and cannot be rejected.',
            ], 400);
        }

        // Optional: Validate rejection reason if provided
        $validator = Validator::make($request->all(), [
            'reason' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Update application status to rejected
            $application->status = 'rejected';
            if ($request->has('reason')) {
                $application->rejection_reason = $request->input('reason');
            }
            $application->save();

            // Create notification for the user
            Notification::create([
                'user_id' => $application->user_id,
                'type' => 'verification rejected',
                'notif_from_receiver' => Auth::id(),
                'read_at' => null,
                'post_id' => null,
                'event_id' => null,
                'announcement_id' => null,
                'liked_by_user_id' => null,
                'comment_by_user_id' => null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Verification application rejected successfully.',
                'application' => [
                    'verify_id' => $application->verify_id,
                    'user_id' => $application->user_id,
                    'role' => $application->role,
                    'status' => $application->status,
                    'rejection_reason' => $application->rejection_reason,
                    'updated_at' => $application->updated_at,
                ],
            ], 200);
        } catch (\Exception $e) {
            Log::error("Error rejecting verification application ID {$verifyId}: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject verification application.',
            ], 500);
        }
    }
}