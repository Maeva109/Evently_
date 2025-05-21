@extends('layouts.app')

@section('content')
<div class="booking-page">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Booking Details</h3>
                        <div class="booking-info mt-4">
                            <div class="event-details">
                                <h4>{{ $booking->event->title }}</h4>
                                <div class="meta-info">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        {{ $booking->event->start_date->format('l, F d, Y') }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        {{ $booking->event->start_date->format('H:i') }}
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $booking->event->location }}
                                    </div>
                                </div>
                            </div>

                            <div class="ticket-list mt-4">
                                <h5>Tickets</h5>
                                @foreach($booking->tickets as $ticket)
                                    <div class="ticket-item">
                                        <div class="ticket-info">
                                            <span class="ticket-name">{{ $ticket->ticketType->name }}</span>
                                            <span class="ticket-quantity">x {{ $ticket->quantity }}</span>
                                        </div>
                                        <div class="ticket-price">
                                            {{ $ticket->formatted_subtotal }}
                                        </div>
                                    </div>
                                @endforeach
                                <div class="total-amount">
                                    <span>Total</span>
                                    <span class="amount">{{ $booking->formatted_total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Important Information</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-info-circle text-primary"></i> Please arrive at least 30 minutes before the event starts.</li>
                            <li><i class="fas fa-ticket-alt text-primary"></i> Your e-tickets will be sent to your email after payment.</li>
                            <li><i class="fas fa-exchange-alt text-primary"></i> Tickets are non-refundable but can be transferred.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card payment-card">
                    <div class="card-body">
                        <h4 class="card-title">Payment</h4>
                        <div class="payment-status mb-4">
                            <span class="status-label">Status:</span>
                            <span class="status-badge {{ $booking->payment_status === 'paid' ? 'paid' : 'pending' }}">
                                {{ ucfirst($booking->payment_status) }}
                            </span>
                        </div>

                        @if($booking->payment_status !== 'paid')
                            <div class="payment-methods">
                                <h5>Select Payment Method</h5>
                                <div class="payment-method-list">
                                    <div class="payment-method-item">
                                        <input type="radio" name="payment_method" id="orange_money" value="orange_money">
                                        <label for="orange_money">
                                            <img src="{{ asset('images/orange-money.png') }}" alt="Orange Money">
                                            Orange Money
                                        </label>
                                    </div>
                                    <div class="payment-method-item">
                                        <input type="radio" name="payment_method" id="mtn_momo" value="mtn_momo">
                                        <label for="mtn_momo">
                                            <img src="{{ asset('images/mtn-momo.png') }}" alt="MTN Mobile Money">
                                            MTN Mobile Money
                                        </label>
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-block mt-4">
                                    Pay {{ $booking->formatted_total }}
                                </button>
                            </div>
                        @else
                            <div class="payment-complete">
                                <i class="fas fa-check-circle text-success"></i>
                                <p>Payment Complete</p>
                                <a href="#" class="btn btn-outline-primary btn-block">Download Tickets</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.booking-page {
    background-color: #f8f9fa;
}

.card {
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border: none;
}

.card-title {
    color: #2d3748;
    font-weight: 600;
}

.meta-info {
    margin: 1rem 0;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #4a5568;
    margin-bottom: 0.5rem;
}

.meta-item i {
    color: #2c5282;
}

.ticket-list {
    border-top: 1px solid #e2e8f0;
    padding-top: 1rem;
}

.ticket-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.ticket-info {
    display: flex;
    gap: 1rem;
}

.ticket-name {
    font-weight: 500;
    color: #2d3748;
}

.ticket-quantity {
    color: #718096;
}

.ticket-price {
    font-weight: 600;
    color: #2c5282;
}

.total-amount {
    display: flex;
    justify-content: space-between;
    padding: 1rem 0;
    margin-top: 1rem;
    border-top: 2px solid #e2e8f0;
    font-weight: 600;
    font-size: 1.1rem;
    color: #2d3748;
}

.payment-card {
    position: sticky;
    top: 2rem;
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.9rem;
}

.status-badge.pending {
    background-color: #fed7d7;
    color: #c53030;
}

.status-badge.paid {
    background-color: #c6f6d5;
    color: #2f855a;
}

.payment-method-list {
    margin: 1rem 0;
}

.payment-method-item {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 0.5rem;
    cursor: pointer;
    transition: all 0.2s;
}

.payment-method-item:hover {
    border-color: #2c5282;
}

.payment-method-item label {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin: 0;
    cursor: pointer;
}

.payment-method-item img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

.payment-complete {
    text-align: center;
    padding: 2rem 0;
}

.payment-complete i {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.btn-primary {
    background-color: #2c5282;
    border-color: #2c5282;
    padding: 0.75rem;
    font-weight: 600;
}

.btn-primary:hover {
    background-color: #1a365d;
    border-color: #1a365d;
}

@media (max-width: 991.98px) {
    .payment-card {
        position: static;
        margin-top: 2rem;
    }
}
</style>
@endpush
@endsection 