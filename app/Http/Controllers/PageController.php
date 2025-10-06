<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Home Page
     */
    public function index(): View
    {
        // ✅ Paginate rooms (8 per page)
        $rooms = Event::with('roomtype')
            ->where('status', 1)
            ->paginate(8);

        return view('pages.home', compact('rooms'));
    }

    /**
     * List all Rooms page
     */
    public function list_rooms(): View
    {
        $rooms = Event::with('roomtype')
            ->where('status', 1)
            ->paginate(8);

        return view('pages.list-rooms', compact('rooms'));
    }

    /**
     * Search Rooms
     */
    public function search(Request $request): View
    {
        $validatedData = $request->validate([
            'check_in' => ['required', 'date', 'after:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'no_peron' => ['required']
        ]);

        $rooms = Event::with('roomtype')
            ->where('status', 1)
            ->whereHas('orders', function (Builder $query) use ($validatedData) {
                $query->whereBetween('check_in', [$validatedData['check_in'], $validatedData['check_out']])
                    ->orWhereBetween('check_out', [$validatedData['check_in'], $validatedData['check_out']]);
            }, '<', DB::raw('events.total_room'))
            ->paginate(8); // ✅ Paginate searched results too

        $searched = true;
        $fields = $validatedData;

        return view('pages.list-rooms', compact('rooms', 'searched', 'fields'));
    }

    /**
     * Show Profile Page
     */
    public function showProfile(): View
    {
        return view('pages.profile', ['user' => Auth::user()]);
    }

    /**
     * Update Profile Data
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->save();

        return redirect()->route('profile');
    }
}
