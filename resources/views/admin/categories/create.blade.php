@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Create Category</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Back to Categories
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h5 class="card-title mb-3">Basic Information</h5>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Styling -->
                        <div class="mb-4">
                            <h5 class="card-title mb-3">Styling</h5>

                            <div class="mb-3">
                                <label for="color" class="form-label">Category Color <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="color" 
                                           class="form-control form-control-color @error('color') is-invalid @enderror" 
                                           id="color" 
                                           name="color" 
                                           value="{{ old('color', '#E91E63') }}"
                                           title="Choose category color"
                                           required>
                                    <input type="text" 
                                           class="form-control @error('color') is-invalid @enderror" 
                                           id="colorHex"
                                           value="{{ old('color', '#E91E63') }}"
                                           pattern="^#([A-Fa-f0-9]{6})$"
                                           required>
                                </div>
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="icon" class="form-label">Category Icon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i id="selectedIcon" class="fas fa-calendar"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('icon') is-invalid @enderror" 
                                           id="icon" 
                                           name="icon" 
                                           value="{{ old('icon', 'fas fa-calendar') }}"
                                           required>
                                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#iconModal">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Preview -->
                            <div class="mt-4">
                                <label class="form-label">Preview</label>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div id="previewIcon" class="me-3" 
                                                 style="width: 40px; height: 40px; border-radius: 8px; background-color: #E91E63; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-calendar text-white"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0" id="previewName">Category Name</h6>
                                                <small class="text-muted" id="previewSlug">category-name</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Icon Selection Modal -->
<div class="modal fade" id="iconModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Icon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" class="form-control" id="iconSearch" placeholder="Search icons...">
                </div>
                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-3" id="iconGrid">
                    <!-- Icons will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-control-color {
        width: 60px;
    }

    #iconGrid .icon-item {
        cursor: pointer;
        padding: 1rem;
        text-align: center;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    #iconGrid .icon-item:hover {
        background-color: rgba(233, 30, 99, 0.1);
        color: var(--primary-color);
    }

    #iconGrid .icon-item i {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    #iconGrid .icon-item .icon-name {
        font-size: 0.8rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endpush

@push('scripts')
<script>
const icons = [
    'calendar', 'music', 'film', 'theater-masks', 'graduation-cap', 'utensils',
    'football-ball', 'basketball-ball', 'running', 'heart', 'book', 'palette',
    'microphone', 'guitar', 'camera', 'video', 'gamepad', 'glass-cheers',
    'users', 'star', 'trophy', 'ticket-alt', 'map-marker-alt', 'birthday-cake'
];

// Initialize icon grid
function initializeIconGrid() {
    const grid = document.getElementById('iconGrid');
    icons.forEach(icon => {
        const div = document.createElement('div');
        div.className = 'col';
        div.innerHTML = `
            <div class="icon-item" data-icon="fas fa-${icon}">
                <i class="fas fa-${icon}"></i>
                <div class="icon-name">${icon}</div>
            </div>
        `;
        grid.appendChild(div);
    });
}

// Icon search
document.getElementById('iconSearch').addEventListener('input', function(e) {
    const search = e.target.value.toLowerCase();
    document.querySelectorAll('#iconGrid .icon-item').forEach(item => {
        const iconName = item.querySelector('.icon-name').textContent;
        item.parentElement.style.display = iconName.includes(search) ? '' : 'none';
    });
});

// Icon selection
document.getElementById('iconGrid').addEventListener('click', function(e) {
    const iconItem = e.target.closest('.icon-item');
    if (iconItem) {
        const iconClass = iconItem.dataset.icon;
        document.getElementById('icon').value = iconClass;
        document.getElementById('selectedIcon').className = iconClass;
        document.querySelector('#previewIcon i').className = `${iconClass} text-white`;
        bootstrap.Modal.getInstance(document.getElementById('iconModal')).hide();
    }
});

// Color picker sync
document.getElementById('color').addEventListener('input', function(e) {
    document.getElementById('colorHex').value = e.target.value;
    document.getElementById('previewIcon').style.backgroundColor = e.target.value;
});

document.getElementById('colorHex').addEventListener('input', function(e) {
    if (/^#([A-Fa-f0-9]{6})$/.test(e.target.value)) {
        document.getElementById('color').value = e.target.value;
        document.getElementById('previewIcon').style.backgroundColor = e.target.value;
    }
});

// Name to slug preview
document.getElementById('name').addEventListener('input', function(e) {
    document.getElementById('previewName').textContent = e.target.value || 'Category Name';
    document.getElementById('previewSlug').textContent = e.target.value
        ? e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '')
        : 'category-name';
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    initializeIconGrid();
});
</script>
@endpush 