@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Bookings Management</h1>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.bookings.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="event" class="form-label">Event</label>
                    <select name="event" id="event" class="form-select">
                        <option value="">All Events</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ request('event') == $event->id ? 'selected' : '' }}>
                                {{ $event->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="payment" class="form-label">Payment Status</label>
                    <select name="payment" id="payment" class="form-select">
                        <option value="">All</option>
                        <option value="paid" {{ request('payment') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('payment') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="date" class="form-label">Date Range</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBookings }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalRevenue, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Pending Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingBookings }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Today's Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $todayBookings }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Event</th>
                            <th>Customer</th>
                            <th>Ticket Type</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>#{{ $booking->id }}</td>
                            <td>{{ $booking->event->title }}</td>
                            <td>
                                {{ $booking->user->name }}<br>
                                <small class="text-muted">{{ $booking->user->email }}</small>
                            </td>
                            <td>{{ $booking->ticketType->name }}</td>
                            <td>{{ $booking->quantity }}</td>
                            <td>${{ number_format($booking->total_price, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $booking->is_paid ? 'success' : 'warning' }}">
                                    {{ $booking->is_paid ? 'Paid' : 'Pending' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewBookingModal{{ $booking->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('admin.bookings.confirm', $booking) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if(!$booking->is_paid)
                                        <form action="{{ route('admin.bookings.mark-paid', $booking) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-dollar-sign"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.bookings.receipt', $booking) }}" 
                                       class="btn btn-sm btn-outline-secondary"
                                       target="_blank">
                                        <i class="fas fa-file-invoice"></i>
                                    </a>
                                </div>

                                <!-- Booking Details Modal -->
                                <div class="modal fade" id="viewBookingModal{{ $booking->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Booking Details #{{ $booking->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Event Details</h6>
                                                        <p><strong>Event:</strong> {{ $booking->event->title }}</p>
                                                        <p><strong>Date:</strong> {{ $booking->event->start_date->format('F d, Y') }}</p>
                                                        <p><strong>Time:</strong> {{ $booking->event->start_date->format('h:i A') }}</p>
                                                        <p><strong>Location:</strong> {{ $booking->event->location }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Customer Details</h6>
                                                        <p><strong>Name:</strong> {{ $booking->user->name }}</p>
                                                        <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                                                        <p><strong>Booking Date:</strong> {{ $booking->created_at->format('F d, Y h:i A') }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Ticket Details</h6>
                                                        <p><strong>Type:</strong> {{ $booking->ticketType->name }}</p>
                                                        <p><strong>Quantity:</strong> {{ $booking->quantity }}</p>
                                                        <p><strong>Price per Ticket:</strong> ${{ number_format($booking->ticketType->price, 2) }}</p>
                                                        <p><strong>Total Amount:</strong> ${{ number_format($booking->total_price, 2) }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Special Requests</h6>
                                                        <p>{{ $booking->special_requests ?? 'None' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No bookings found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .border-left-primary {
        border-left: .25rem solid #4e73df!important;
    }
    .border-left-success {
        border-left: .25rem solid #1cc88a!important;
    }
    .border-left-info {
        border-left: .25rem solid #36b9cc!important;
    }
    .border-left-warning {
        border-left: .25rem solid #f6c23e!important;
    }
</style>
@endpush 