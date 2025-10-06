<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller {

    /**
     * Display a listing of the resource.
     */
   public function index()
{
    // Show only events created by the logged-in organiser
    $rooms = Event::with('roomtype')
        ->where('organiser', Auth::user()->name)   // 👈 filter by organiser
        ->paginate(8);

    if (request()->is('organizer/*')) {
        return view('organizer.events.index', compact('rooms'));
    }

    return view('room-container-details', compact('rooms'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $types = EventType::all();
        return view('organizer.events.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            // 'room_type_id' => ['required',  'unique:events'],
            'total_room' => ['required', 'string'],
            'no_beds' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'desc' => ['required', 'string'],
            'image' => ['required', 'image', 'max:2048'],
        ], [
            // 'room_type_id.unique' => 'This Event Type already exists in event table. please create a new event type'
        ]);
        $imageName = time() . '.' . $request->file('image')->extension();

        // download image
        $request->file('image')->move(public_path('img'), $imageName);
        $imagePath = 'img/' . $imageName;

        Event::create([
            'room_type_id' => $request->room_type_id,
            'total_room' => $request->total_room,
            'organiser'   => Auth::user()->name,
            'no_beds' => $request->no_beds,
            'price' => $request->price,
            'desc' => $request->desc,
            'image' => $imagePath,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('organizer.events.index')
            ->with('message', 'Events has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $room) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id) {

        $room = Event::findOrFail($id);
        $this->authorize('update', $room);
        $types = EventType::all();
        return view('organizer.events.edit', compact('room', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id) {

        $request->validate([
            // 'room_type_id' => ['required', 'exists:event_types,id'],
            'total_room' => ['required', 'string'],
            'no_beds' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'desc' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $room = Event::findOrFail($id);
        $room->room_type_id = $request->room_type_id;
        $room->total_room = $request->total_room;
        $room->organiser = Auth::user()->name;
        $room->no_beds = $request->no_beds;
        $room->price = $request->price;
        $room->desc = $request->desc;
        $room->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image') && !empty($request->file('image'))) {
            $imageName = time() . '.' . $request->file('image')->extension();

            // download image
            $request->file('image')->move(public_path('img'), $imageName);
            $imagePath = 'img/' . $imageName;
            $room->image = $imagePath;
        }
        $room->save();

        return redirect()->route('organizer.events.index')
            ->with('message', 'Event has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) {
        $room = Event::findOrFail($id);
        $this->authorize('delete', $room);
        $room->delete();
        return redirect()->route('organizer.events.index')
            ->with('message', 'Event has been deleted!');
    }
}
