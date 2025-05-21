@extends('layout')
@section('title', 'Create Event - Evently')

@section('content')
<div class="create-event-page">
    <div class="create-event-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="create-event-wrapper">
                        <div class="create-event-header text-center mb-4">
                            <h2 class="section-title">Create New Event</h2>
                            <p class="text-muted">Fill in the details to create your event</p>
                        </div>

                        <div class="create-event-form">
                            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group mb-4">
                                    <label for="title" class="form-label">Event Title</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        <input type="text" name="title" id="title" 
                                               class="form-control @error('title') is-invalid @enderror" 
                                               value="{{ old('title') }}" 
                                               placeholder="Enter event title" required>
                                    </div>
                                    @error('title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="description" class="form-label">Event Description</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                                        <textarea name="description" id="description" 
                                                  class="form-control @error('description') is-invalid @enderror" 
                                                  rows="5" placeholder="Describe your event">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="start_date" class="form-label">Start Date & Time</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                <input type="datetime-local" name="start_date" id="start_date" 
                                                       class="form-control @error('start_date') is-invalid @enderror" 
                                                       value="{{ old('start_date') }}" required>
                                            </div>
                                            @error('start_date')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="end_date" class="form-label">End Date & Time</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                <input type="datetime-local" name="end_date" id="end_date" 
                                                       class="form-control @error('end_date') is-invalid @enderror" 
                                                       value="{{ old('end_date') }}">
                                            </div>
                                            @error('end_date')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="location" class="form-label">Event Location</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        <input type="text" name="location" id="location" 
                                               class="form-control @error('location') is-invalid @enderror" 
                                               value="{{ old('location') }}" 
                                               placeholder="Enter event location" required>
                                    </div>
                                    @error('location')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="image" class="form-label">Event Image</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        <input type="file" name="image" id="image" 
                                               class="form-control @error('image') is-invalid @enderror" 
                                               accept="image/*">
                                    </div>
                                    <small class="text-muted">Upload an image to represent your event (optional)</small>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="is_published" id="is_published" 
                                               class="form-check-input @error('is_published') is-invalid @enderror"
                                               value="1" {{ old('is_published') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_published">
                                            Publish event immediately
                                        </label>
                                    </div>
                                    @error('is_published')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="ticket-types-section mb-4">
                                    <h4 class="mb-3">Ticket Types</h4>
                                    <div id="ticket-types-container">
                                        <div class="ticket-type-item border rounded p-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Ticket Name</label>
                                                        <input type="text" name="ticket_types[0][name]" 
                                                               class="form-control" placeholder="e.g. Regular Ticket" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Price ($)</label>
                                                        <input type="number" name="ticket_types[0][price]" 
                                                               class="form-control" step="0.01" min="0" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Capacity (optional)</label>
                                                        <input type="number" name="ticket_types[0][capacity]" 
                                                               class="form-control" min="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea name="ticket_types[0][description]" 
                                                                  class="form-control" rows="2"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="add-ticket-type" class="btn btn-outline-primary">
                                        <i class="fas fa-plus"></i> Add Another Ticket Type
                                    </button>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Create Event
                                    </button>
                                    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .create-event-page {
        padding: 3rem 0;
        background: linear-gradient(135deg, rgba(233, 30, 99, 0.05) 0%, rgba(233, 30, 99, 0.1) 100%);
    }

    .create-event-wrapper {
        background: #fff;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-label {
        font-weight: 500;
        color: #555;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .input-group {
        border-radius: 8px;
        overflow: hidden;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        color: #E91E63;
        border-right: none;
    }

    .form-control {
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        height: auto;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: #E91E63;
        box-shadow: none;
    }

    textarea.form-control {
        min-height: 60px;
    }

    .form-check-input:checked {
        background-color: #E91E63;
        border-color: #E91E63;
    }

    .ticket-type-item {
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    .ticket-type-item:hover {
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    #add-ticket-type {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
let ticketTypeCount = 1;

document.getElementById('add-ticket-type').addEventListener('click', function() {
    const container = document.getElementById('ticket-types-container');
    const template = `
        <div class="ticket-type-item border rounded p-3 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label">Ticket Name</label>
                        <input type="text" name="ticket_types[${ticketTypeCount}][name]" 
                               class="form-control" placeholder="e.g. Regular Ticket" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label">Price ($)</label>
                        <input type="number" name="ticket_types[${ticketTypeCount}][price]" 
                               class="form-control" step="0.01" min="0" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label">Capacity (optional)</label>
                        <input type="number" name="ticket_types[${ticketTypeCount}][capacity]" 
                               class="form-control" min="1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="ticket_types[${ticketTypeCount}][description]" 
                                  class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-danger btn-sm remove-ticket-type">
                <i class="fas fa-trash"></i> Remove
            </button>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', template);
    ticketTypeCount++;

    // Add remove button functionality
    const removeButtons = document.querySelectorAll('.remove-ticket-type');
    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.ticket-type-item').remove();
        });
    });
});
</script>
@endpush
@endsection 