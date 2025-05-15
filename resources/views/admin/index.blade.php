@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Dashboard</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Event
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stats-number">{{ $totalEvents ?? 0 }}</div>
                        <div class="stats-text">Total Events</div>
                    </div>
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card" style="background: linear-gradient(45deg, #2196F3, #1976D2);">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stats-number">{{ $activeEvents ?? 0 }}</div>
                        <div class="stats-text">Active Events</div>
                    </div>
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card" style="background: linear-gradient(45deg, #4CAF50, #388E3C);">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stats-number">{{ $totalOrganizers ?? 0 }}</div>
                        <div class="stats-text">Organizers</div>
                    </div>
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card" style="background: linear-gradient(45deg, #FF9800, #F57C00);">
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="stats-number">{{ $totalBookings ?? 0 }}</div>
                        <div class="stats-text">Total Bookings</div>
                    </div>
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Events -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Events</h5>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentEvents ?? [] as $event)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($event->image)
                                                <img src="{{ asset('storage/' . $event->image) }}" 
                                                     alt="{{ $event->title }}" 
                                                     class="rounded-circle me-2"
                                                     width="40" height="40"
                                                     style="object-fit: cover;">
                                            @else
                                                <div class="rounded-circle me-2 bg-light d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-calendar"></i>
                                                </div>
                                            @endif
                                            {{ $event->title }}
                                        </div>
                                    </td>
                                    <td>{{ $event->start_date->format('M d, Y') }}</td>
                                    <td>{{ $event->location ?? 'N/A' }}</td>
                                    <td>
                                        @if($event->is_published)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.events.edit', $event) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('events.show', $event) }}" 
                                               class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(!$event->is_published)
                                                <form action="{{ route('admin.events.publish', $event) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="fas fa-calendar-times text-muted mb-2" style="font-size: 2rem;"></i>
                                        <p class="text-muted mb-0">No events found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Upcoming Events</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse($upcomingEvents ?? [] as $event)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $event->title }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt"></i> 
                                        {{ $event->start_date->format('M d, Y H:i') }}
                                    </small>
                                </div>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $event->start_date->diffForHumans() }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted mb-0">No upcoming events</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse($recentActivity ?? [] as $activity)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $activity->description }}</h6>
                                    <small>{{ $activity->created_at->diffForHumans() }}</small>
                                </div>
                                <small class="text-muted">by {{ $activity->causer->name ?? 'System' }}</small>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted mb-0">No recent activity</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 