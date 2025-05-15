@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        @if(auth()->user()->logo)
                            <img src="{{ asset(auth()->user()->logo) }}" alt="Logo" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                            <small class="text-muted">Organizer</small>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action active">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('events.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus me-2"></i> Create Event
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-calendar me-2"></i> My Events
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-ticket-alt me-2"></i> Bookings
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-cog me-2"></i> Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title">Total Events</h6>
                            <h2 class="card-text mb-0">
                                {{ auth()->user()->events()->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title">Active Events</h6>
                            <h2 class="card-text mb-0">
                                {{ auth()->user()->events()->where('is_active', true)->count() }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title">Total Bookings</h6>
                            <h2 class="card-text mb-0">0</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Recent Events</h5>
                </div>
                <div class="card-body">
                    @if(auth()->user()->events()->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Event</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Bookings</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(auth()->user()->events()->latest()->take(5)->get() as $event)
                                        <tr>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ $event->start_date->format('M d, Y') }}</td>
                                            <td>
                                                @if($event->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>0</td>
                                            <td>
                                                <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-primary">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <img src="{{ asset('images/no-events.svg') }}" alt="No events" class="mb-3" style="max-width: 200px;">
                            <h5>No Events Yet</h5>
                            <p class="text-muted">Start by creating your first event!</p>
                            <a href="{{ route('events.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i> Create Event
                            </a>
                        </div>
                    @endif
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
    .list-group-item {
        border: none;
        padding: 0.75rem 1rem;
    }
    .list-group-item.active {
        background-color: #f8f9fa;
        color: #0d6efd;
        font-weight: 500;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush 