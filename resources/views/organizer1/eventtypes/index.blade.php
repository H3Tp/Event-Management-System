@extends('layouts.app1')

@section('content')
    @include('components.show-success')
    <div class="card">
        <div class="card-header">
            <h3>All Event Types
                <a href="{{ route('organizer1.eventtypes.create') }}" class="btn btn-success rounded-circle">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($types as $type)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $type->name }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form method="post"
                                      action="{{ route('organizer1.eventtypes.destroy', ['eventtype' => $type->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                                <a class="btn btn-warning"
                                   href="{{ route('organizer1.eventtypes.edit', ['eventtype' => $type->id]) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <p class="text-primary fw-bold">You haven't created any lists.</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
