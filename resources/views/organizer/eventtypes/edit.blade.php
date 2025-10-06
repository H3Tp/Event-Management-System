@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit Event Types</h3>
        </div>
        <div class="card-body">
            <form class="row g-3" method="post" action="{{ route('organizer.eventtypes.update', ['eventtype' => $type->id]) }}">
                @csrf
                @method('put')
                <div class="col-auto">
                    <label class="form-label">Event Type Name</label>
                    <input type="text" name="name" value="{{ old('name', $type->name) }}"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update Event Type</button>
                </div>
            </form>
        </div>
    </div>
@endsection
