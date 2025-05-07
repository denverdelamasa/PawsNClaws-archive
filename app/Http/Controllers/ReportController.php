<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Report;
use App\Models\Comment;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\Event;

class ReportController extends Controller
{
    public function reportsList()
    {
        $reports = Report::with(['user', 'post', 'comment'])
            ->orderBy('created_at', 'desc')
            ->get();
    
        $reports->each(function ($report) {
            // Add user and post/comment related details
            $report->reporter_name = $report->user->name ?? 'Unknown Reporter';
            $report->reporter_profile = $report->user->profile_picture ?? null;
            $report->report_comment = $report->comment->comment ?? 'No comment available';
            $report->report_comment_author = $report->comment->user->name ?? 'Unknown Author';
            $report->report_comment_author_profile = $report->comment->user->profile_picture ?? null;
            $report->report_comment_created_at = Carbon::parse($report->comment->created_at ?? null)->diffForHumans();
            $report->report_post_author = $report->post->user->name ?? 'Unknown Author';
            $report->report_post_author_profile = $report->post->user->profile_picture ?? null;
            $report->report_post_image = $report->post && $report->post->image_path ? $report->post->image_path : [];
            $report->report_post_caption = $report->post->caption ?? 'No content available';
            $report->report_post_created_at = Carbon::parse($report->post->created_at ?? null)->diffForHumans();
    
            // Count how many times this post has been reported
            $report->report_post_count = Report::where('report_post_id', $report->post->post_id ?? null)->count();
    
            // Count how many times this comment has been reported
            $report->report_comment_count = Report::where('report_comment_id', $report->comment->comment_id ?? null)->count();
        });
    
        return response()->json($reports);
    }
    

    public function submitReport(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'reason' => 'required|string',
            'type' => 'required|in:post,comment,announcement,event',
            'report_post_id' => 'nullable|exists:posts,post_id',
            'report_announcement_id' => 'nullable|exists:announcements,announcement_id',
            'report_event_id' => 'nullabnle|exists:events,event_id',
            'report_comment_id' => 'nullable|exists:comments,comment_id',
            'details' => 'nullable|string',
        ]);

        // Create the report
        $report = Report::create([
            'reporter_id' => $request->user_id,
            'reason' => $request->reason,
            'type' => $request->type,
            'report_post_id' => $request->type === 'post' ? $request->post_id : null,
            'report_comment_id' => $request->type === 'comment' ? $request->comment_id : null,
            'report_announcement_id' => $request->type === 'announcement' ? $request->announcement_id: null,
            'report_event_id' => $request->type === 'event' ? $request->event_id: null,
            'details' => $request->details,
        ]);

        // Return success or redirect
        return response()->json(['message' => 'Report submitted successfully.'], 200);
    }
    public function searchReports(Request $request)
    {
        $query = Report::query();

        if ($request->has('reason')) {
            $query->where('reason', 'like', '%' . $request->reason . '%');
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $reports = $query->with(['user', 'post', 'comment'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($reports);
    }

    public function takeDownContent(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:reports,report_id',
            'type' => 'required|in:post,comment,announcement,event',
        ]);

        $report = Report::findOrFail($request->report_id);

        switch ($request->type) {
            case 'post':
                $content = Post::findOrFail($report->report_post_id);
                break;
            case 'comment':
                $content = Comment::findOrFail($report->report_comment_id);
                break;
            case 'announcement':
                $content = Announcement::findOrFail($report->report_announcement_id);
                break;
            case 'event':
                $content = Event::findOrFail($report->report_event_id);
                break;
            default:
                return response()->json(['message' => 'Invalid content type.'], 400);
        }

        $content->delete();

        return response()->json(['message' => 'Content taken down successfully.'], 200);
    }
}
