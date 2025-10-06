
@extends('layouts.app')

@section('content')
    @include('components.show-success')

    <div class="card">
        <div class="card-header">
            <h3>All Event
                <a href="{{ route('organizer.events.create') }}" class="btn btn-success rounded-circle">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </h3>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Given Slot</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Date Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            {{-- Correct numbering with pagination --}}
                            <th scope="row">{{ $rooms->firstItem() + $loop->index }}</th>
                            <td>{{ $room->roomtype->name }}</td>
                            <td>{{ $room->total_room }}</td>
                            <td>{{ $room->no_beds }}</td>
                            <td>{{ $room->orders->count() }}</td>
                            <td>{{ $room->price }}</td>
                            <td><img src="{{ asset($room->image) }}" width="50" height="40"></td>
                            <td>{{ $room->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                @if($room->status)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-danger">Disabled</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    {{-- ✅ Delete button only if no booking --}}
                                    @if($room->orders()->count() == 0)
                                        <form method="post" action="{{ route('organizer.events.destroy', $room->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary" disabled title="Event already booked by users">
                                            <i class="fa-solid fa-lock"></i>
                                        </button>
                                    @endif

                                    <a class="btn btn-warning"
                                        href="{{ route('organizer.events.edit', $room->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-primary fw-bold">
                                You haven't created any Events.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- ✅ Pagination Info + Links --}}
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    Showing {{ $rooms->firstItem() }} to {{ $rooms->lastItem() }} of {{ $rooms->total() }} entries
                </div>
                <div>
                    {{ $rooms->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
