<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AdoptionApplication;

class MessagesController extends Controller
{
    public function listOngoingApplications(Request $request)
    {
        $ongoingApplications = AdoptionApplication::where('status', 'Ongoing')
            ->with([
                'sender:user_id,name,username,email,profile_picture',
                'receiver:user_id,name,username,email,profile_picture',
                'post:post_id,title'
            ])
            ->select('application_id', 'receiver_id', 'post_id', 'sender_id', 'adopter_name', 'contact_info', 'status')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $ongoingApplications,
            'message' => 'Successfully retrieved adoption applications with Ongoing status'
        ], 200);
    }
}
