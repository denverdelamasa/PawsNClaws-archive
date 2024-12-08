<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function submitReport(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'reason' => 'required|string',
            'type' => 'required|in:post,comment',
            'post_id' => 'nullable|exists:posts,post_id',
            'comment_id' => 'nullable|exists:comments,comment_id',
            'details' => 'nullable|string',
        ]);

        // Create the report
        $report = Report::create([
            'user_id' => $request->user_id,
            'reason' => $request->reason,
            'type' => $request->type,
            'post_id' => $request->type === 'post' ? $request->post_id : null,
            'comment_id' => $request->type === 'comment' ? $request->comment_id : null,
            'details' => $request->details,
        ]);

        // Return success or redirect
        return response()->json(['message' => 'Report submitted successfully.'], 200);
    }
}
