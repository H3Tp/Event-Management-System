

<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-center text-primary text-uppercase">Our Events</h6>
            <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Events</span></h1>
        </div>
        <div class="row g-4">
            @foreach($rooms as $room)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->iteration/10 }}s">
                    <div class="room-item shadow rounded overflow-hidden">
                        <div class="position-relative image-container">
                            <img src="{{ asset($room->image) }}" alt="">
                            <small class="position-absolute start-0 top-0 bg-primary text-white rounded py-1 px-3 ms-4">
                                ${{ $room->price }}
                            </small>
                        </div>
                        <div class="p-4 mt-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">{{ $room->roomtype->name }}</h5>
                                <div class="ps-2">
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <small class="border-end me-3 pe-3">
                                    <i class="fa fa-bar-chart"></i>
                                    Capacity : {{ $room->no_beds }}
                                </small>
                                <small class="border-end me-3 pe-3">
                                    <i class="fa fa-map-marker"></i> Location: {{ $room->total_room }}
                                </small>
                            </div>
                            <p class="text-body mb-3">{{ $room->desc }}</p>
                             <p class="text-body mb-3">Organiser Name : {{ $room->organiser }}</p>
                            <div class="d-flex">
                                @auth
                                    <form method="post" action="{{ route('orders.store') }}">
                                        @csrf
                                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                                        <button type="submit" class="btn btn-sm btn-success rounded py-2 px-4">
                                            Book Event
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary rounded py-2 px-4">
                                        Login to Book Event
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- ✅ Pagination Info + Links -->
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
