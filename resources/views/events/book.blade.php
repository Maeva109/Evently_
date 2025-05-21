@extends('layouts.app')

@section('content')
<section class="event-booking section-padding">
    <div class="container">
        @guest
            <div class="row justify-content-center mb-5">
                <div class="col-md-8">
                    <div class="alert alert-info text-center">
                        <h4>Please Login or Register to Book Tickets</h4>
                        <p>You need to have an account to make a booking.</p>
                        <div class="mt-3">
                            <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-8">
                    <div class="booking-form card">
                        <div class="card-body">
                            <h2 class="card-title mb-4">Book Tickets for {{ $event->title }}</h2>
                            
                            <form action="{{ route('events.register', $event) }}" method="POST" id="bookingForm">
                                @csrf
                                
                                <div class="mb-4">
                                    <h5>Select Ticket Type</h5>
                                    @foreach($event->ticketTypes as $type)
                                        <div class="ticket-type-card mb-3 p-3 border rounded @if(!$type->is_available) disabled @endif">
                                            <div class="form-check">
                                                <input class="form-check-input ticket-type-radio" 
                                                       type="radio" 
                                                       name="ticket_type_id" 
                                                       id="ticket_type_{{ $type->id }}" 
                                                       value="{{ $type->id }}"
                                                       data-price="{{ $type->price }}"
                                                       @if(!$type->is_available) disabled @endif
                                                       required>
                                                <label class="form-check-label" for="ticket_type_{{ $type->id }}">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="h6 mb-0">{{ $type->name }}</span>
                                                        <span class="badge bg-primary">${{ number_format($type->price, 2) }}</span>
                                                    </div>
                                                    <p class="text-muted small mb-0">{{ $type->description }}</p>
                                                    @if(!$type->is_available)
                                                        <span class="badge bg-danger">Sold Out</span>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    @error('ticket_type_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Number of Tickets</label>
                                    <select class="form-select @error('quantity') is-invalid @enderror" 
                                            id="quantity" name="quantity" required>
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ old('quantity') == $i ? 'selected' : '' }}>
                                                {{ $i }} {{ Str::plural('ticket', $i) }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="special_requests" class="form-label">Special Requests (Optional)</label>
                                    <textarea class="form-control @error('special_requests') is-invalid @enderror" 
                                              id="special_requests" name="special_requests" rows="3">{{ old('special_requests') }}</textarea>
                                    @error('special_requests')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="total-price-section mb-4 p-3 bg-light rounded">
                                    <h5>Total Price</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Subtotal:</span>
                                        <span id="subtotal">$0.00</span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100">Proceed to Payment</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="event-summary card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Event Summary</h3>
                            <div class="event-details">
                                <p><i class="fas fa-calendar"></i> {{ $event->start_date->format('F d, Y') }}</p>
                                <p><i class="fas fa-clock"></i> {{ $event->start_date->format('h:i A') }}</p>
                                <p><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="booking-notes card">
                        <div class="card-body">
                            <h4 class="card-title">Important Notes</h4>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-info-circle"></i> Cancellation available up to 48 hours before the event</li>
                                <li><i class="fas fa-clock"></i> Please arrive 30 minutes before the event</li>
                                <li><i class="fas fa-id-card"></i> Bring a valid ID for verification</li>
                                <li><i class="fas fa-ban"></i> Tickets are non-transferable</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
    </div>
</section>
@endsection

@push('styles')
<style>
    .event-booking {
        background-color: #f8f9fa;
        padding: 60px 0;
    }
    .booking-form {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .event-summary {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .event-details p {
        margin-bottom: 0.5rem;
    }
    .event-details i {
        width: 20px;
        color: #666;
    }
    .booking-notes {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .booking-notes ul li {
        margin-bottom: 0.5rem;
    }
    .booking-notes i {
        margin-right: 8px;
        color: #666;
    }
    .ticket-type-card {
        transition: all 0.3s ease;
    }
    .ticket-type-card:hover:not(.disabled) {
        background-color: #f8f9fa;
        cursor: pointer;
    }
    .ticket-type-card.disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    .total-price-section {
        border: 1px solid #dee2e6;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookingForm');
    const quantitySelect = document.getElementById('quantity');
    const subtotalSpan = document.getElementById('subtotal');
    const ticketTypeRadios = document.querySelectorAll('.ticket-type-radio');

    function updateTotal() {
        const selectedTicketType = document.querySelector('input[name="ticket_type_id"]:checked');
        const quantity = parseInt(quantitySelect.value);

        if (selectedTicketType) {
            const price = parseFloat(selectedTicketType.dataset.price);
            const total = price * quantity;
            subtotalSpan.textContent = '$' + total.toFixed(2);
        }
    }

    ticketTypeRadios.forEach(radio => {
        radio.addEventListener('change', updateTotal);
    });

    quantitySelect.addEventListener('change', updateTotal);
});
</script>
@endpush 