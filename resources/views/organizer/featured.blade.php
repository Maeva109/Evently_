@extends('layouts.app')

@section('content')
<div class="featured-organizers py-5">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold mb-2">Featured Event Organizers</h1>
            <p class="lead text-muted">Meet the creative minds behind our most extraordinary events</p>
            <div class="header-underline mx-auto"></div>
        </div>

        <!-- Organizers Grid -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
            @forelse($organizers as $organizer)
            <div class="col">
                <div class="organizer-card">
                    <div class="card shadow-hover h-100">
                        <div class="card-body p-4">
                            <div class="organizer-avatar mb-4">
                                @if($organizer->logo)
                                    <img src="{{ asset($organizer->logo) }}" alt="{{ $organizer->name }}" class="avatar-img">
                                @else
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($organizer->name, 0, 1)) }}
                                    </div>
                                @endif
                                @if($organizer->events()->where('is_active', true)->exists())
                                    <div class="status-badge">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <h3 class="organizer-name">{{ $organizer->name }}</h3>
                            
                            <div class="organizer-stats mb-3">
                                <div class="stat-item">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                    <span>{{ $organizer->events()->count() }} Events Created</span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-star text-warning"></i>
                                    <span>{{ $organizer->events()->where('is_active', true)->count() }} Active</span>
                                </div>
                            </div>

                            @if($organizer->description)
                                <p class="organizer-description text-muted">
                                    {{ Str::limit($organizer->description, 100) }}
                                </p>
                            @endif

                            <div class="organizer-footer">
                                <a href="{{ route('organizer.profile', $organizer) }}" class="btn btn-outline-primary btn-sm d-block">
                                    View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-users fa-4x text-muted mb-4"></i>
                    <h3>No Featured Organizers Yet</h3>
                    <p class="text-muted mb-4">Be the first to join our community of event creators!</p>
                    <a href="{{ route('organizer.register') }}" class="btn btn-primary">
                        Become an Organizer
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Call to Action -->
        <div class="cta-section text-center py-5">
            <h2 class="mb-4">Ready to Create Your Own Events?</h2>
            <p class="lead text-muted mb-4">Join our community of successful event organizers and start creating memorable experiences.</p>
            <a href="{{ route('organizer.register') }}" class="btn btn-primary btn-lg">
                Start Creating Events
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .featured-organizers {
        background-color: #f8f9fa;
    }

    .header-underline {
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        margin-top: 1.5rem;
        border-radius: 2px;
    }

    .organizer-card {
        transition: transform 0.2s;
    }

    .organizer-card:hover {
        transform: translateY(-5px);
    }

    .shadow-hover {
        transition: box-shadow 0.2s;
        border: none;
        border-radius: 15px;
    }

    .shadow-hover:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
    }

    .organizer-avatar {
        position: relative;
        width: 100px;
        height: 100px;
        margin: 0 auto;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .avatar-placeholder {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(45deg, #0d6efd, #0dcaf0);
        color: white;
        font-size: 2.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .status-badge {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #198754;
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
    }

    .organizer-name {
        font-size: 1.25rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 1rem;
        color: #2b3035;
    }

    .organizer-stats {
        display: flex;
        justify-content: center;
        gap: 1rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .organizer-description {
        text-align: center;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
    }

    .organizer-footer {
        text-align: center;
    }

    .cta-section {
        background: white;
        border-radius: 20px;
        padding: 3rem !important;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
</style>
@endpush 