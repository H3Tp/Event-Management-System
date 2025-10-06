<?php

namespace App\Http\Controllers\Admin1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index()
    {
        $totalRooms = Event::count();
        $reservedRoom = Order::count();
        return view('organizer1.events.index', compact('totalRooms', 'reservedRoom'));
    }

    public function reports()
    {
        return view('organizer1.reports');
    }


}