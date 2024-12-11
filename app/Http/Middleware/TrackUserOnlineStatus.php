<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TrackUserOnlineStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If the user is authenticated, update their online status
        if (Auth::check()) {
            $user = Auth::user();
            $user->is_online = 1; // Set the user as online
            $user->save();
        }

        return $next($request);
    }

    /**
     * After the request has been processed, ensure the user is offline
     * if the session ends or browser closes.
     */
    public static function updateOfflineStatus($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->is_online = 0; // Set the user as offline
            $user->save();
        }
    }
}
