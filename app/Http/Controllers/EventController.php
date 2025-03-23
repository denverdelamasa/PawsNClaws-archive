<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function createEvent(Request $request)
    {
        $request->validate([
            'event_title' => 'required|string',
            'event_location' => 'required|string',
            'event_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'event_description' => 'required|string',
            'event_date' => 'required|date'
        ]);
    
        $event_thumbnail = null;
        if ($request->hasFile('event_thumbnail') && $request->file('event_thumbnail')->isValid()) {
            $event_thumbnail = $request->file('event_thumbnail')->store('images/posts', 'public');
        }
    
        $event = new Event();
        $event->event_title = $request->input('event_title');
        $event->event_description = $request->input('event_description');
        $event->event_date = $request->input('event_date');
        $event->event_location = $request->input('event_location');
        if ($event_thumbnail) {
            $event->thumbnail = $event_thumbnail;
        }
        $event->shelter_id = Auth::id();
        $event->save();
    
        return response()->json([
            'message' => 'Post created successfully!',
            'event' => $event
        ], 201);
    }

}
