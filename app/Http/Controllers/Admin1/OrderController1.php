<?php

namespace App\Http\Controllers\Admin1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController1 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ✅ Only show orders for events created by the logged-in organiser
        $orders = Order::with(['room.roomtype', 'user'])
            ->whereHas('room', function ($query) {
                $query->where('organiser', Auth::user()->name);   // filter by organiser name
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('organizer1.orders.index', compact('orders'));
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

        return redirect()->route('organizer1.orders.index')
            ->with('success', 'Order has been created successfully!');
    }

    /**
     * Update the status of the order.
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
     * Waiting orders only for logged-in organiser.
     */
    public function waitingOrders()
    {
        $orders = Order::with(['user', 'room.roomtype'])
            ->where('status', 'waiting')
            ->whereHas('room', function ($query) {
                $query->where('organiser', Auth::user()->name);
            })
            ->latest()
            ->get();

        return view('organizer1.orders.waiting', compact('orders'));
    }
}
