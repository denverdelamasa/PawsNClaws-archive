<?php

namespace App\Http\Controllers;

use App\Models\VerifyApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VerifyApplicationController extends Controller
{
    public function applyForVerification(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'documents' => 'required|array|min:1',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:2048', // 2MB max per file
            'role' => 'required|string|in:Shelter,Vet', // Restrict to specific roles
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Store uploaded documents
        $documentPaths = [];
        foreach ($request->file('documents') as $file) {
            $path = $file->store('documents', 'public');
            $documentPaths[] = $path;
        }

        // Create verification application
        $application = VerifyApplication::create([
            'user_id' => Auth::id(),
            'documents' => json_encode($documentPaths), // Store paths as JSON
            'role' => $request->role,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Verification application submitted successfully.',
            'application' => $application,
        ], 201);
    }
}