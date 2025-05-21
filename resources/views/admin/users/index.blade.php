@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="usersTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 
                                        ($user->role === 'moderator' ? 'warning' : 
                                        ($user->role === 'organizer' ? 'info' : 'success')) }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.users.edit', $user) }}" 
                                           class="btn btn-sm btn-primary me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" 
                                                  method="POST" 
                                                  class="d-inline-block delete-user-form"
                                                  onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
    }
    .table th {
        font-weight: 600;
        background-color: #f8f9fc;
    }
    .btn-group {
        display: flex;
        gap: 0.5rem;
    }
    .btn-group form {
        margin: 0;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
    }
    .d-inline-block {
        display: inline-block !important;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#usersTable').DataTable({
            "order": [[4, "desc"]],
            "pageLength": 10,
            "language": {
                "search": "Search users:",
                "lengthMenu": "Show _MENU_ users per page",
            }
        });

        // Handle delete form submission
        $('.delete-user-form').on('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                this.submit();
            }
        });
    });
</script>
@endpush
@endsection 