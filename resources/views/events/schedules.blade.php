@extends('layouts.app')

@section('content')
<section id="schedules" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title-header text-center">
                    <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">Upcoming Events Schedule</h1>
                    <p class="wow fadeInDown" data-wow-delay="0.2s">View all our upcoming events in one place</p>
                </div>
            </div>
        </div>

        @if($eventsByDate->isEmpty())
            <div class="text-center">
                <h3>No upcoming events scheduled at the moment.</h3>
                <p>Please check back later for new events!</p>
            </div>
        @else
            @foreach($eventsByDate as $date => $dayEvents)
                <div class="date-section mb-5">
                    <h3 class="date-header mb-4">{{ \Carbon\Carbon::parse($date)->locale('en')->isoFormat('dddd, MMMM D, YYYY') }}</h3>
                    <div class="row">
                        @foreach($dayEvents as $event)
                            <div class="col-xs-12 col-md-6 col-lg-4 mb-4">
                                <div class="card event-card h-100 wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="event-img-wrapper">
                                        @if($event->image)
                                            <img src="{{ asset('storage/' . $event->image) }}" 
                                                class="card-img-top event-img" 
                                                alt="{{ $event->title }}">
                                        @else
                                            <div class="no-image-placeholder">
                                                <i class="lni-calendar"></i>
                                            </div>
                                        @endif
                                        <div class="event-time">
                                            <i class="lni-timer"></i> 
                                            {{ $event->start_date->format('H:i') }}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $event->title }}</h5>
                                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                                        <div class="event-info">
                                            @if($event->location)
                                                <p class="location">
                                                    <i class="lni-map-marker"></i> {{ $event->location }}
                                                </p>
                                            @endif
                                        </div>
                                        <a href="{{ route('events.show', $event) }}" class="btn btn-common float-right">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
    .date-header {
        color: #333;
        border-bottom: 2px solid #E91E63;
        padding-bottom: 10px;
        margin-top: 30px;
    }
    
    .event-card {
        transition: transform 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .event-img-wrapper {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    
    .event-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .no-image-placeholder {
        height: 100%;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .no-image-placeholder i {
        font-size: 3rem;
        color: #dee2e6;
    }
    
    .event-time {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(233, 30, 99, 0.9);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9rem;
    }
    
    .event-info {
        margin: 15px 0;
        font-size: 0.9rem;
    }
    
    .event-info p {
        margin-bottom: 5px;
        color: #666;
    }
    
    .event-info i {
        margin-right: 5px;
        color: #E91E63;
    }
    
    .btn-common {
        background: #E91E63;
        color: #fff;
        border-radius: 20px;
        padding: 8px 20px;
        transition: all 0.3s ease;
    }
    
    .btn-common:hover {
        background: #d81557;
        color: #fff;
    }
</style>
@endpush 