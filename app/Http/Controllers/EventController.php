<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function eventList()
    {
        $userId = Auth::id(); // Get the current user's ID
    
        // Fetch announcements with their associated user data, comment count, and likes count
        $events = Event::with('shelter') // Eager load the shelter relationship
            ->withCount('comments') // Eager load and count the number of comments using the defined relationship
            ->orderBy('created_at', 'desc') // Order by the latest announcements
            ->paginate(3);
    
        // Map through the announcements and format the response
        $formattedEvents = $events->map(function ($events) use ($userId) {
            // Count the number of likes for each announcement
            $likesCount = Like::where('event_id', $events->event_id)->count();
    
            // Check if the current user has liked the announcement
            $isLiked = Like::where('event_id', $events->event_id)
                            ->where('user_id', $userId)
                            ->exists();
    
            // Return the formatted announcement data
            return [
                'event_id' => $events->event_id,
                'shelter_id' => $events->shelter_id,
                'name' => $events->shelter ? $events->shelter->name : 'Unknown Shelter',
                'username' => $events->shelter ? $events->shelter->username : 'Unknown Shelter', // Fetch username from the related shelter
                'profile_picture' => $events->shelter && $events->shelter->profile_picture ? $events->shelter->profile_picture : 'default-profile.jpg', // Use default if no profile picture
                'event_thumbnail' => $events->event_thumbnail ? json_decode($events->event_thumbnail, true) : [], // Ensure event thumbnail exists
                'event_title' => $events->event_title,
                'event_description' => $events->event_description,
                'event_start_date' => Carbon::parse($events->event_start_date)->format('F j, Y'),
                'event_end_date' => Carbon::parse($events->event_end_date)->format('F j, Y'),
                'created_at' => $events->created_at->diffForHumans(), // Format the created_at timestamp
                'updated_at' => $events->updated_at->diffForHumans(), // Format the updated_at timestamp
                'likes_count' => $likesCount, // Include likes count for the announcement
                'is_liked' => $isLiked, // Include the `is_liked` state for the current user
                'comments_count' => $events->comments_count, // Include the count of comments from the `withCount` query
                'is_adoptable' => $events->is_adoptable, // Include the adoptable status
            ];
        });
        
        // Return the formatted response as JSON
        return response()->json([
            'events' => $formattedEvents,
            'pagination' => [
                'current_page' => $events->currentPage(),
                'per_page' => $events->perPage(),
                'total' => $events->total(),
                'last_page' => $events->lastPage(),
                'next_page_url' => $events->nextPageUrl(),
                'prev_page_url' => $events->previousPageUrl(),
            ]
        ],200);
    }
    public function createEvent(Request $request)
    {
        $request->validate([
            'event_title' => 'required|string',
            'event_location' => 'required|string',
            'event_thumbnail' => 'nullable|array',
            'event_thumbnail.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'event_description' => 'required|string',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date',
        ]);
    
        $event = new Event();
        $event->event_title = $request->input('event_title');
        $event->event_description = $request->input('event_description');
        $event->event_start_date = $request->input('event_start_date');
        $event->event_end_date = $request->input('event_end_date');
        $event->event_location = $request->input('event_location');
        $event->shelter_id = Auth::id();
        $event->save();
    
        // Handle multiple event thumbnails
        $thumbnails = [];
        if ($request->hasFile('event_thumbnail')) {
            foreach ($request->file('event_thumbnail') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('images/events', 'public');
                    $thumbnails[] = $path;
                }
            }
            
            // Store the array of image paths as JSON
            if (!empty($thumbnails)) {
                $event->event_thumbnail = json_encode($thumbnails);
                $event->save();
            }
        }
    
        return response()->json([
            'message' => 'Event created successfully!',
            'event' => $event
        ], 201);
    }
    public function updateEvent(Request $request, $eventId)
    {
        // Find the post by ID
        $event = Event::findOrFail($eventId);
    
        // Validate the incoming data (no image validation)
        $validated = $request->validate([
            'event_title' => 'required|string',
            'event_description' => 'required|string'
        ]);
    
        // Update the caption
        $event->event_title = $validated['event_title'];
        $event->event_description = $validated['event_description'];
    
        // Save the post with the updated caption
        $event->save();
    
        // Return a response (success or error)
        return response()->json([
            'message' => 'Post updated successfully!',
            'announcement' => $event
        ], 200);
    }
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        // Optional: Check if the authenticated user owns the post
        if ($event->shelter_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
