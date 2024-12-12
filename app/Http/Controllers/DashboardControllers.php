<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardControllers extends Controller
{
    public function getCounts()
    {
        // Count total users
        $totalUsers = User::count();

        // Count total posts
        $totalPosts = Post::count();

        // Count total reports
        $totalReports = Report::count();

        // Count users who are currently online (assuming an `is_online` field exists)
        $onlineUsers = User::where('is_online', 1)->count();

        return response()->json([
            'total_users'   => $totalUsers,
            'total_posts'   => $totalPosts,
            'total_reports' => $totalReports,
            'online_users'  => $onlineUsers,
        ]);
    }
}
