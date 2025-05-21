@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Organizer Header -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-2 text-center text-md-start mb-3 mb-md-0">
                    @if($organizer->logo)
                        <img src="{{ asset($organizer->logo) }}" alt="{{ $organizer->name }}" 
                            class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" 
                            style="width: 120px; height: 120px; font-size: 3rem;">
                            {{ strtoupper(substr($organizer->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="col-md-7">
                    <h1 class="h2 mb-2">{{ $organizer->name }}</h1>
                    @if($organizer->description)
                        <p class="text-muted mb-3">{{ $organizer->description }}</p>
                    @endif
                    <div class="d-flex flex-wrap gap-3">
                        @if($organizer->phone)
                            <div class="text-muted">
                                <i class="fas fa-phone me-2"></i>{{ $organizer->phone }}
                            </div>
                        @endif
                        <div class="text-muted">
                            <i class="fas fa-envelope me-2"></i>{{ $organizer->email }}
                        </div>
                        <div class="text-muted">
                            <i class="fas fa-calendar me-2"></i>Joined {{ $organizer->created_at->format('M Y') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row g-2">
                        <div class="col-6 col-md-12">
                            <div class="card bg-light">
                                <div class="card-body text-center py-3">
                                    <h3 class="mb-1">{{ $organizer->events()->count() }}</h3>
                                    <p class="text-muted small mb-0">Total Events</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-12">
                            <div class="card bg-light">
                                <div class="card-body text-center py-3">
                                    <h3 class="mb-1">{{ $organizer->events()->where('start_date', '>=', now())->count() }}</h3>
                                    <p class="text-muted small mb-0">Upcoming Events</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Events Section -->
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#upcoming" data-bs-toggle="tab">Upcoming Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#past" data-bs-toggle="tab">Past Events</a>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Upcoming Events -->
                <div class="tab-pane fade show active" id="upcoming">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @forelse($organizer->events()->where('start_date', '>=', now())->latest('start_date')->get() as $event)
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    @if($event->image)
                                        <img src="{{ asset($event->image) }}" class="card-img-top" alt="{{ $event->title }}"
                                            style="height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $event->title }}</h5>
                                        <p class="text-muted mb-3">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            {{ $event->start_date->format('M d, Y - h:i A') }}
                                        </p>
                                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                                        <a href="{{ route('events.show', $event) }}" class="btn btn-outline-primary btn-sm">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="fas fa-calendar fa-3x text-muted mb-3"></i>
                                    <h3>No Upcoming Events</h3>
                                    <p class="text-muted">Stay tuned for future events from this organizer.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Past Events -->
                <div class="tab-pane fade" id="past">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @forelse($organizer->events()->where('start_date', '<', now())->latest('start_date')->get() as $event)
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    @if($event->image)
                                        <img src="{{ asset($event->image) }}" class="card-img-top" alt="{{ $event->title }}"
                                            style="height: 200px; object-fit: cover;">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $event->title }}</h5>
                                        <p class="text-muted mb-3">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            {{ $event->start_date->format('M d, Y - h:i A') }}
                                        </p>
                                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                                        <a href="{{ route('events.show', $event) }}" class="btn btn-outline-secondary btn-sm">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                    <h3>No Past Events</h3>
                                    <p class="text-muted">This organizer hasn't hosted any events yet.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 10px;
    }
    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
    }
    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        padding: 1rem 1.5rem;
        font-weight: 500;
        position: relative;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        background: none;
        border: none;
    }
    .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #0d6efd;
    }
    .tab-content {
        padding-top: 1.5rem;
    }
</style>
@endpush 