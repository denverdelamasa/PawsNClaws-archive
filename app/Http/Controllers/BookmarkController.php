<?php
namespace App\Http\Controllers;

use App\Models\{Bookmark, Post, Event, Announcement, Notification};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function toggleBookmark($itemId, $type)
    {
        $userId = Auth::id();

        $ownerId = null;

        if ($type === 'post') {
            $item = Post::find($itemId);
            $ownerId = $item?->user_id;
        } elseif ($type === 'announcement') {
            $item = Announcement::find($itemId);
            $ownerId = $item?->shelter_id;
        } elseif ($type === 'event') {
            $item = Event::find($itemId);
            $ownerId = $item?->shelter_id;
        } else {
            return response()->json(['error' => 'Invalid type specified'], 400);
        }

        if (!$item) {
            return response()->json(['error' => ucfirst($type).' not found'], 404);
        }

        $bookmarkQuery = Bookmark::where('user_id', $userId);

        if ($type === 'post') {
            $bookmarkQuery->where('post_id', $itemId);
        } elseif ($type === 'announcement') {
            $bookmarkQuery->where('announcement_id', $itemId);
        } elseif ($type === 'event') {
            $bookmarkQuery->where('event_id', $itemId);
        }

        $bookmark = $bookmarkQuery->first();

        if ($bookmark) {
            // Remove bookmark
            $bookmark->delete();
            return response()->noContent();
        } else {
            // Add bookmark
            $bookmarkData = ['user_id' => $userId];

            if ($type === 'post') {
                $bookmarkData['post_id'] = $itemId;
            } elseif ($type === 'announcement') {
                $bookmarkData['announcement_id'] = $itemId;
            } elseif ($type === 'event') {
                $bookmarkData['event_id'] = $itemId;
            }

            Bookmark::create($bookmarkData);

            // Optional notification logic
            if ($userId !== $ownerId) {
                $message = match ($type) {
                    'post' => 'bookmarked your post',
                    'announcement' => 'bookmarked your announcement',
                    'event' => 'bookmarked your event',
                    default => null,
                };

                Notification::create([
                    'user_id' => $ownerId,
                    'type' => $message,
                    'bookmarked_by_user_id' => $userId,
                    'read_at' => null,
                    $type.'_id' => $itemId,
                ]);
            }

            return response()->noContent();
        }
    }
}
