@extends('layouts.app')

@section('header')
    @include('layouts.header')
    <!-- Carousel -->
    @include('sections.carousel')
@endsection
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@section('content')

    <!-- Service -->
    @include('sections.service')
    <!-- Room -->
    @include('sections.room-container-brief')
    <!-- Testimonial -->
    <!-- @include('sections.testimonial') -->
    <!-- Team -->
    <!-- @include('sections.team') -->
    <!-- Newsletter -->
    <!-- @include('sections.newsletter') -->
@endsection

@section('footer')
    @include('layouts.footer')
@endsection
