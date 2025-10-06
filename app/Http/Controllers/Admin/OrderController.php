<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ✅ Show only orders for the events created by the logged-in organiser/admin
        $orders = Order::with(['room.roomtype', 'user'])
            ->whereHas('room', function ($query) {
                $query->where('organiser', Auth::user()->name); // filter by organiser
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('organizer.orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id'    => 'required|exists:events,id',
            'user_id'    => 'required|exists:users,id',
            'check_in'   => 'required|date',
            'check_out'  => 'nullable|date|after_or_equal:check_in',
        ]);

        Order::create([
            'room_id'   => $request->room_id,
            'user_id'   => $request->user_id,
            'check_in'  => $request->check_in,
            'check_out' => $request->check_out,
            'status'    => 'pending', // default
        ]);

        return redirect()->route('organizer.orders.index')
            ->with('success', 'Order has been created successfully!');
    }

    /**
     * Update the status of the order (approve / reject / pending).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,waiting,approved,rejected,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }

    /**
     * Show only waiting orders for logged-in organiser/admin
     */
    public function waitingOrders()
    {
        $orders = Order::with(['user', 'room.roomtype'])
            ->where('status', 'waiting')
            ->whereHas('room', function ($query) {
                $query->where('organiser', Auth::user()->name); // filter by organiser
            })
            ->latest()
            ->get();

        return view('organizer.orders.waiting', compact('orders'));
    }
}
