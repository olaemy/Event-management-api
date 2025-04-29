<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EventResource::collection(Event::with('user', 'attendees')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $user = Auth::user();

        // Create the event
        $event = Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'user_id' => $user->id,
        ]);

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Event $event)
    // {
    //     dd($event);
    //     // return new EventResource($event);
    // }


    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        $event->load('user', 'attendees');

        return new EventResource($event);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'sometimes|date',
            'end_time' => 'sometimes|date|after:start_time',
        ]);

        $user = Auth::user();

        if ($event->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        // Now Update the event
        $event->update([
            'name' => $validated['name'] ?? $event->name,
            'description' => $validated['description'] ?? $event->description,
            'start_time' => $validated['start_time'] ?? $event->start_time,
            'end_time' => $validated['end_time'] ?? $event->end_time,

        ]);

        return new EventResource($event);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $user = Auth::user();

        if ($event->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}
