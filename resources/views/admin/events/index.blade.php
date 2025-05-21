@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Events Management</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Event
        </a>
    </div>

    <!-- Events Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
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
                                    <div>
                                        <h6 class="mb-0">{{ $event->title }}</h6>
                                        <small class="text-muted">{{ Str::limit($event->description, 50) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="mb-1">{{ $event->start_date->format('M d, Y') }}</div>
                                    <small class="text-muted">{{ $event->start_date->format('h:i A') }}</small>
                                </div>
                            </td>
                            <td>{{ $event->location ?? 'N/A' }}</td>
                            <td>
                                @if($event->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-warning">Draft</span>
                                @endif
                            </td>
                            <td>{{ $event->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.events.edit', $event) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('events.show', $event) }}" 
                                       class="btn btn-sm btn-outline-info"
                                       title="View"
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(!$event->is_published)
                                        <form action="{{ route('admin.events.publish', $event) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-success"
                                                    title="Publish">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.events.deactivate', $event) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-warning"
                                                    title="Unpublish">
                                                <i class="fas fa-pause"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.events.destroy', $event) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this event?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-calendar-times text-muted mb-2" style="font-size: 2rem;"></i>
                                <p class="text-muted mb-0">No events found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($events->hasPages())
                <div class="mt-4">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        background-color: #f8f9fa;
        border-top: none;
    }
    
    .btn-group .btn {
        padding: .25rem .5rem;
    }
    
    .btn-group .btn + .btn {
        margin-left: 2px;
    }
    
    .badge {
        padding: .5em .8em;
    }
</style>
@endpush