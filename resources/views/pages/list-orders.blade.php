@extends('layouts.app')

@section('header')
    @include('layouts.header')

     <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center pb-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">My Bookings</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">My Bookings </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<div class="container my-4">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
 @endif
<!--@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif -->

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif


</body>

    <div class="card">
        <div class="card-header">
            <h2>My Bookings</h2>
        </div>
        <div class="card-body">

            {{-- ✅ Scrollable + Small Table --}}
            <div style="max-height: 300px; overflow-y: auto; font-size: 14px;">
                <table class="table table-sm table-striped text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>User Name</th>
                            <th>Event Name</th>
                            <th>Date</th>

                            <th>Price</th>
                            <th>Booked On</th>
                            <th>Book Status</th> {{-- ✅ New Column --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->user->name ?? 'Guest User' }}</td>
                                <td>{{ $order->room->roomtype->name ?? 'N/A' }}</td>
                                <td>{{ $order->check_in }}</td>

                                <td>${{ $order->room->price ?? '0' }}</td>
                                <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                   <span class="badge {{ $order->status == 'approved' ? 'bg-success' : ($order->status=='waiting' ? 'bg-secondary' : 'bg-warning') }}">
        {{ ucfirst($order->status) }}
    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-primary fw-bold">
                                    You don't have any orders yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div></div></div>

@php
    use App\Models\Order as OrderModel;

    // collect event ids the current user has booked (from $orders passed by controller)
    $userEventIds = $orders->pluck('room.roomtype.id')->filter()->unique()->values();

    if ($userEventIds->isEmpty()) {
        $waitingOrders = collect();
    } else {
        $waitingOrders = OrderModel::with(['user','room.roomtype'])
            ->where('status', 'waiting')
            ->whereHas('room.roomtype', function($q) use ($userEventIds) {
                $q->whereIn('id', $userEventIds->toArray());
            })
            ->get()
            ->groupBy(function($order){
                return $order->room->roomtype->name ?? 'N/A';
            });
    }
@endphp



        <div class="container my-4">
<div class="card shadow-sm mt-4">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0" style="color:white"> Waiting List (Events You Booked)</h4>
        <span class="badge bg-light text-dark">Total: {{ $waitingOrders->flatten()->count() }}</span>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
            <table class="table table-striped table-hover align-middle mb-0 text-center">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th>Sr.No</th>
                        <th>User</th>
                        <th>Event</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Booked On</th>
                        <th>Status</th>
                        <th>Leave Waiting</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($waitingOrders as $eventName => $eventOrders)
                        <tr class="table-primary">
                            <td colspan="7" class="fw-bold text-start">
                                {{ $eventName }} ({{ $eventOrders->count() }} waiting)
                            </td>
                        </tr>

                       @foreach($eventOrders as $i => $order)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $order->user->name ?? 'Guest User' }}</td>
        <td>{{ $eventName }}</td>
        <td>{{ \Carbon\Carbon::parse($order->check_in)->format('d M Y') }}</td>
        <td>${{ number_format($order->room->price ?? 0, 2) }}</td>
        <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
        <td>
            <span class="badge bg-secondary px-3 py-2 text-capitalize">
                {{ $order->status }}
            </span>
        </td>
        <td>
            @if($order->user_id === auth()->id())
                <form action="{{ route('orders.leaveWaiting', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to leave waiting list?');">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        Leave
                    </button>
                </form>
            @else
                <span class="text-muted">—</span>
            @endif
        </td>
    </tr>
@endforeach                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                    <strong>No waiting orders found for your booked events</strong>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('footer')
    @include('layouts.footer')
@endsection
