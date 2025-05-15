@extends('layouts.app')

@section('content')
<section class="event-details section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="event-header mb-5">
                    @if($event->image)
                        <div class="event-image mb-4">
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 class="img-fluid rounded" 
                                 alt="{{ $event->title }}">
                        </div>
                    @endif
                    <h1 class="event-title">{{ $event->title }}</h1>
                    <div class="event-meta">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="meta-info">
                                    <span class="date">
                                        <i class="lni-calendar"></i> 
                                        {{ $event->start_date->format('F d, Y') }}
                                        @if($event->start_date->format('Y-m-d') != $event->end_date->format('Y-m-d'))
                                            - {{ $event->end_date->format('F d, Y') }}
                                        @endif
                                    </span>
                                    <span class="time">
                                        <i class="lni-timer"></i> 
                                        {{ $event->start_date->format('H:i') }} - {{ $event->end_date->format('H:i') }}
                                    </span>
                                    @if($event->location)
                                        <span class="location">
                                            <i class="lni-map-marker"></i> 
                                            {{ $event->location }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end">
                                @auth
                                    <a href="{{ route('events.book', $event) }}" class="btn btn-common">
                                        <i class="lni-ticket"></i> Book Now
                                    </a>
                                @else
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('login') }}?redirect_to={{ urlencode(route('events.book', $event)) }}" 
                                           class="btn btn-common mb-2">
                                            <i class="lni-user"></i> Login to Book
                                        </a>
                                        <a href="{{ route('register') }}?redirect_to={{ urlencode(route('events.book', $event)) }}" 
                                           class="btn btn-outline-common">
                                            <i class="lni-user-plus"></i> Register to Book
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <div class="event-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="description card">
                                <div class="card-body">
                                    <h3 class="card-title">About This Event</h3>
                                    <div class="description-content">
                                        {{ $event->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="event-sidebar">
                                <div class="card organizer-card mb-4">
                                    <div class="card-body">
                                        <h4 class="card-title">Event Organizer</h4>
                                        @if($event->creator)
                                            <div class="organizer-info">
                                                <h5>{{ $event->creator->name }}</h5>
                                                <p class="text-muted">
                                                    <i class="lni-envelope"></i> {{ $event->creator->email }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="card share-card">
                                    <div class="card-body">
                                        <h4 class="card-title">Share This Event</h4>
                                        <div class="social-share">
                                            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                               target="_blank" 
                                               class="btn btn-facebook btn-block mb-2">
                                                <i class="lni-facebook-filled"></i> Share on Facebook
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($event->title) }}" 
                                               target="_blank" 
                                               class="btn btn-twitter btn-block">
                                                <i class="lni-twitter-filled"></i> Share on Twitter
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .event-details {
        padding-top: 120px;
    }
    
    .event-image {
        max-height: 500px;
        overflow: hidden;
        border-radius: 8px;
    }
    
    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .event-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #333;
    }
    
    .event-meta {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 2rem;
    }
    
    .meta-info span {
        display: inline-block;
        margin-right: 20px;
        color: #666;
    }
    
    .meta-info i {
        color: #E91E63;
        margin-right: 5px;
    }
    
    .description {
        margin-bottom: 30px;
    }
    
    .description-content {
        line-height: 1.8;
        color: #666;
    }
    
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        border-radius: 8px;
        margin-bottom: 30px;
    }
    
    .card-title {
        color: #333;
        font-size: 1.25rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }
    
    .organizer-info h5 {
        color: #333;
        margin-bottom: 0.5rem;
    }
    
    .btn-facebook {
        background: #3b5998;
        color: #fff;
    }
    
    .btn-twitter {
        background: #1da1f2;
        color: #fff;
    }
    
    .btn-facebook:hover,
    .btn-twitter:hover {
        opacity: 0.9;
        color: #fff;
    }
    
    .social-share .btn {
        text-align: left;
        padding: 10px 20px;
    }
    
    .social-share .btn i {
        margin-right: 10px;
    }
</style>
@endpush 