@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="h2 mb-0">Event Organizers</h1>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($organizers as $organizer)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            @if($organizer->logo)
                                <img src="{{ asset($organizer->logo) }}" alt="{{ $organizer->name }}" 
                                    class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" 
                                    style="width: 60px; height: 60px;">
                                    {{ strtoupper(substr($organizer->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <h5 class="card-title mb-1">{{ $organizer->name }}</h5>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $organizer->events_count ?? $organizer->events()->count() }} Events
                                </p>
                            </div>
                        </div>

                        @if($organizer->description)
                            <p class="card-text text-muted mb-3">{{ Str::limit($organizer->description, 100) }}</p>
                        @endif

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('organizer.profile', $organizer) }}" class="btn btn-outline-primary btn-sm">
                                View Profile
                            </a>
                            @if($organizer->events()->where('start_date', '>=', now())->exists())
                                <span class="badge bg-success">Active Events</span>
                            @endif
                        </div>
                    </div>

                    @if($organizer->events()->where('start_date', '>=', now())->exists())
                        <div class="card-footer bg-light">
                            <p class="text-muted small mb-0">Upcoming Events:</p>
                            <ul class="list-unstyled mb-0">
                                @foreach($organizer->events()->where('start_date', '>=', now())->take(2)->get() as $event)
                                    <li class="small text-truncate">
                                        <i class="fas fa-dot-circle me-1 text-primary"></i>
                                        {{ $event->title }} - {{ $event->start_date->format('M d, Y') }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h3>No Organizers Found</h3>
                    <p class="text-muted">There are no event organizers registered yet.</p>
                    @auth
                        @if(!auth()->user()->isOrganizer())
                            <a href="{{ route('organizer.register') }}" class="btn btn-primary">
                                Become an Organizer
                            </a>
                        @endif
                    @else
                        <a href="{{ route('organizer.register') }}" class="btn btn-primary">
                            Register as Organizer
                        </a>
                    @endauth
                </div>
            </div>
        @endforelse
    </div>

    @if($organizers->hasPages())
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $organizers->links() }}
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
        border: none;
        border-radius: 10px;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-footer {
        border-top: 1px solid rgba(0,0,0,.05);
        background-color: #f8f9fa;
        border-bottom-left-radius: 10px !important;
        border-bottom-right-radius: 10px !important;
    }
</style>
@endpush 