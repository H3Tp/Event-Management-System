@extends('layouts.app1')

@section('content')
<div class="container mt-3">

    {{-- ✅ Notification Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill"></i> <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-x-circle-fill"></i> <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📅 Upcoming Bookings</h4>
            <span class="badge bg-light text-dark">Total: {{ $orders->count() }}</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                <table class="table table-striped table-hover align-middle mb-0 text-center">
                    <thead class="table-dark sticky-top">
                        <tr>
                            <th>User</th>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Booked On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->user->name ?? 'Guest User' }}</td>
                                <td>{{ $order->room->roomtype->name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->check_in)->format('d M Y') }}</td>
                                <td>${{ number_format($order->room->price ?? 0, 2) }}</td>
                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>

                                {{-- ✅ Status Display --}}
                                <td>
                                    @php
                                        $statusClass = [
                                            'approved' => 'success',
                                            'pending' => 'warning text-dark',
                                            'waiting' => 'secondary',
                                            'rejected' => 'danger',
                                            'cancelled' => 'danger'
                                        ][$order->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }} px-3 py-2 text-capitalize">
                                        {{ $order->status ?? 'N/A' }}
                                    </span>
                                </td>

                                {{-- ✅ Action Dropdown --}}
                                <td>
                                    <form action="{{ route('organizer1.orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group input-group-sm">
                                            <select name="status" class="form-select">


                                              
                                                <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>

                                            </select>
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                        <strong>No bookings found</strong>
                                        <p class="mb-0">All clear, no upcoming events yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
