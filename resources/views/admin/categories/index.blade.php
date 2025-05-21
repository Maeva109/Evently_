@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Event Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>

    <!-- Categories List -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Events</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="category-icon me-3 category-icon-box" data-color="{{ $category->color }}">
                                        <i class="{{ $category->icon }} text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $category->name }}</h6>
                                        <small class="text-muted">{{ $category->slug }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $category->events_count }} events</span>
                            </td>
                            <td>{{ Str::limit($category->description, 100) ?? 'No description' }}</td>
                            <td>{{ $category->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this category? Events in this category will be uncategorized.');">
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
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-folder-open text-muted mb-2" style="font-size: 2rem;"></i>
                                <p class="text-muted mb-0">No categories found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($categories->hasPages())
                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .category-icon {
        transition: all 0.3s ease;
    }
    
    .category-icon:hover {
        transform: scale(1.1);
    }

    .category-icon-box {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table td {
        vertical-align: middle;
    }

    .badge {
        font-weight: 500;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.category-icon-box').forEach(icon => {
            icon.style.backgroundColor = icon.dataset.color;
        });
    });
</script>
@endpush 