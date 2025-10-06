<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Show current user's bookings
    public function index()
    {
        $orders = Order::with('room')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.list-orders', compact('orders'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to book.');
        }

        // First check if user has already booked this room/event
        $existing = Order::where('user_id', $user->id)
            ->where('room_id', $request->room_id)
            ->first();

        if ($existing) {
            // 🔥 Don't validate dates — just send flash error
            return redirect()->back()
                ->with('error', 'You have already booked this event.');
        }

        // ✅ Now we can store room ID in a variable
        $room_id = (int) $request->room_id;

        // Validate only if new booking
        

        // 🟢 Booking & capacity logic
        DB::transaction(function () use ($request, $user, $room_id) {

            $room = Event::where('id', $room_id)
                        ->lockForUpdate()
                        ->firstOrFail();

            $available = (int)($room->no_beds ?? 0);

            if ($available > 0) {
                // Approved booking
                $order = new Order([
                    'check_in'  =>  now(),
                    'check_out' =>  now(),
                    'room_id'   => $room->id,
                    'status'    => 'approved',
                ]);
                $order->user_id = $user->id;
                $order->save();

                // reduce capacity
                $room->no_beds = max(0, $room->no_beds - 1);
                $room->save();

                session()->flash('success', 'Booking successful — your reservation is approved.');
            } else {
                // Waiting booking
                $order = new Order([
                    'check_in'  =>  now(),
                    'check_out' =>  now(),
                    'room_id'   => $room->id,
                    'status'    => 'waiting',
                ]);
                $order->user_id = $user->id;
                $order->save();

                session()->flash('error', 'Capacity full. Your booking is on the waiting list.');
            }
        });

        return redirect()->route('orders.index');
    }
    
// at top of OrderController.php


public function myBookings()  // or use the method name you already have
{
    $user = auth()->user();
    if (! $user) {
        return redirect()->route('login'); // or handle guest appropriately
    }

    // 1) fetch all orders of the logged-in user (with relations)
    $orders = $user->orders()->with(['room.roomtype', 'user'])->latest()->get();

    // 2) get event (roomtype) ids that this user has booked
    $userEventIds = $orders->pluck('room.roomtype.id')->filter()->unique()->values();

    // 3) fetch waiting orders only for those events (any user) and group by event name
    if ($userEventIds->isEmpty()) {
        $waitingOrders = collect(); // empty collection so view can call ->count(), ->groupBy(), etc.
    } else {
        $waitingOrders = Order::with(['user', 'room.roomtype'])
            ->where('status', 'waiting')
            ->whereHas('room.roomtype', function($q) use ($userEventIds) {
                $q->whereIn('id', $userEventIds->toArray());
            })
            ->get()
            ->groupBy(function($order) {
                return $order->room->roomtype->name ?? 'N/A';
            });
    }

    // 4) return view with both variables
    return view('list-orders', compact('orders', 'waitingOrders'));
}
public function leaveWaiting(Request $request, Order $order)
{
    $user = auth()->user();

    // Make sure only the owner of the booking can leave
    if ($order->user_id !== $user->id) {
        return redirect()->back()->with('error', 'You are not allowed to modify this order.');
    }

    // Only allow if order is waiting
    if ($order->status !== 'waiting') {
        return redirect()->back()->with('error', 'This booking is not in waiting status.');
    }

    // Update status (cancelled / left)
    $order->status = 'cancelled';   // or 'left' if you prefer
    $order->save();

    return redirect()->back()->with('success', 'You have left the waiting list.');
}


}
