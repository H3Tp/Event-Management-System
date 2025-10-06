<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

    public function index(): View
    {
        $totalRooms = Event::count();
        $reservedRoom = Order::count();
        
        // Determine view based on user email or route
        $view = Auth::user()->email === 'organizer1@gmail.com' ? 'organizer1.events.index' : 'organizer.events.index';
        
        return view($view, compact('totalRooms', 'reservedRoom'));
    }

    public function reports(): View
    {
        return view('organizer1.reports');
    }
}
