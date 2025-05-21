@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Create New Event</h1>
        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to Events
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h5 class="card-title mb-3">Basic Information</h5>
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title') }}"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="5" 
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Date and Time -->
                        <div class="mb-4">
                            <h5 class="card-title mb-3">Date and Time</h5>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date & Time <span class="text-danger">*</span></label>
                                        <input type="datetime-local" 
                                               class="form-control @error('start_date') is-invalid @enderror" 
                                               id="start_date" 
                                               name="start_date" 
                                               value="{{ old('start_date') }}"
                                               required>
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date & Time <span class="text-danger">*</span></label>
                                        <input type="datetime-local" 
                                               class="form-control @error('end_date') is-invalid @enderror" 
                                               id="end_date" 
                                               name="end_date" 
                                               value="{{ old('end_date') }}"
                                               required>
                                        @error('end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4">
                        <!-- Location -->
                        <div class="mb-4">
                            <h5 class="card-title mb-3">Location</h5>
                            
                            <div class="mb-3">
                                <label for="location" class="form-label">Event Location <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('location') is-invalid @enderror" 
                                       id="location" 
                                       name="location" 
                                       value="{{ old('location') }}"
                                       required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <h5 class="card-title mb-3">Event Image</h5>
                            
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Image</label>
                                <input type="file" 
                                       class="form-control @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image"
                                       accept="image/*"
                                       onchange="previewImage(this)">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Recommended size: 1200x600 pixels</div>
                            </div>

                            <div class="image-preview mt-3 text-center d-none">
                                <img id="preview" src="#" alt="Preview" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ticket Types Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Ticket Types</h5>
                                <div id="ticket-types-container">
                                    <div class="ticket-type-item border rounded p-3 mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Ticket Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="ticket_types[0][name]" 
                                                           class="form-control" placeholder="e.g. Regular Ticket" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Price ($) <span class="text-danger">*</span></label>
                                                    <input type="number" name="ticket_types[0][price]" 
                                                           class="form-control" step="0.01" min="0" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Capacity (optional)</label>
                                                    <input type="number" name="ticket_types[0][capacity]" 
                                                           class="form-control" min="1">
                                                    <small class="form-text text-muted">Leave empty for unlimited capacity</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
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
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-light">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-title {
        color: #333;
        font-weight: 600;
    }

    .form-label {
        font-weight: 500;
    }

    .image-preview img {
        max-height: 300px;
        object-fit: cover;
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
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewContainer = document.querySelector('.image-preview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('d-none');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        previewContainer.classList.add('d-none');
    }
}

let ticketTypeCount = 1;

document.getElementById('add-ticket-type').addEventListener('click', function() {
    const container = document.getElementById('ticket-types-container');
    const template = `
        <div class="ticket-type-item border rounded p-3 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Ticket Name <span class="text-danger">*</span></label>
                        <input type="text" name="ticket_types[${ticketTypeCount}][name]" 
                               class="form-control" placeholder="e.g. Regular Ticket" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Price ($) <span class="text-danger">*</span></label>
                        <input type="number" name="ticket_types[${ticketTypeCount}][price]" 
                               class="form-control" step="0.01" min="0" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Capacity (optional)</label>
                        <input type="number" name="ticket_types[${ticketTypeCount}][capacity]" 
                               class="form-control" min="1">
                        <small class="form-text text-muted">Leave empty for unlimited capacity</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
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