<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $types = EventType::all();
        return view('organizer.eventtypes.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('organizer.eventtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => ['required', 'unique:event_types,name']
        ]);

        EventType::create($validatedData);

        return redirect()->route('organizer.eventtypes.index')
            ->with('message', 'Your list has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventType $roomType) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id) {
        $type = EventType::findOrFail($id);
        $this->authorize('update', $type);

        return view('organizer.eventtypes.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id) {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:event_types,name']
        ]);

        $type = EventType::findOrFail($id);
        $type->update($validatedData);

        return redirect()->route('organizer.eventtypes.index')
            ->with('message', 'Your EventType has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) {

        $type = EventType::findOrFail($id);
        $this->authorize('delete', $type);
        $type->delete();
        return redirect()->route('organizer.eventtypes.index')
            ->with('message', 'Your EventType has been deleted!');
    }
}
