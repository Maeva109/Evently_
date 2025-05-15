@extends('layout')

@section('title', 'Featured Events')

@section('content')
<div class="featured-events-section">
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center mb-3">Featured Events</h1>
                <p class="text-center text-muted">Discover our most exciting upcoming events</p>
            </div>
        </div>

        <div class="row">
            @forelse ($events as $event)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card event-card h-100 shadow-sm">
                        <div class="event-image-wrapper">
                            @if($event->image)
                                <img src="{{ asset($event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                            @else
                                <img src="{{ asset('images/default-event.svg') }}" class="card-img-top" alt="Default Event Image">
                            @endif
                            <div class="event-date">
                                <span class="day">{{ $event->start_date->format('d') }}</span>
                                <span class="month">{{ $event->start_date->format('M') }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text text-muted mb-2">
                                <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                            </p>
                            <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                            
                            @if($event->ticketTypes->count() > 0)
                                <p class="card-text mb-2">
                                    <strong>From ${{ $event->ticketTypes->min('price') }}</strong>
                                </p>
                            @endif
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('events.show', $event) }}" class="btn btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4 class="alert-heading">No Featured Events</h4>
                        <p>Check back soon for upcoming featured events!</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('events.index') }}" class="btn btn-outline-primary">
                    View All Events
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .featured-events-section {
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .event-card {
        transition: transform 0.3s ease;
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    .event-card:hover {
        transform: translateY(-5px);
    }

    .event-image-wrapper {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .event-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .event-date {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(233, 30, 99, 0.9);
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        line-height: 1;
    }

    .event-date .day {
        display: block;
        font-size: 1.5em;
        font-weight: bold;
    }

    .event-date .month {
        display: block;
        font-size: 0.8em;
        text-transform: uppercase;
    }

    .card-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .card-text {
        color: #6c757d;
    }

    .btn-primary {
        background-color: #E91E63;
        border-color: #E91E63;
    }

    .btn-primary:hover {
        background-color: #C2185B;
        border-color: #C2185B;
    }

    .btn-outline-primary {
        color: #E91E63;
        border-color: #E91E63;
    }

    .btn-outline-primary:hover {
        background-color: #E91E63;
        border-color: #E91E63;
    }
</style>
@endpush
@endsection 