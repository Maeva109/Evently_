@extends('layouts.app')

@section('content')
<section id="events" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title-header text-center">
                    <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">Événements à venir</h1>
                    <p class="wow fadeInDown" data-wow-delay="0.2s">Découvrez tous nos événements</p>
                </div>
            </div>
        </div>

        @forelse($eventsByDate as $date => $dayEvents)
            <div class="date-section mb-5">
                <h3 class="date-header mb-4">{{ \Carbon\Carbon::parse($date)->locale('fr')->isoFormat('dddd D MMMM YYYY') }}</h3>
                <div class="row">
                    @foreach($dayEvents as $event)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card event-card h-100">
                                <div class="event-img-wrapper">
                                    @if($event->image)
                                        <img src="{{ asset('storage/' . $event->image) }}" 
                                             class="card-img-top event-img" 
                                             alt="{{ $event->title }}">
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    @endif
                                    <div class="event-time">
                                        <i class="fas fa-clock"></i> 
                                        {{ $event->start_date->format('H:i') }}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->title }}</h5>
                                    <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                                    
                                    <div class="event-details">
                                        <div class="event-location">
                                            <i class="fas fa-map-marker-alt"></i> 
                                            {{ $event->location ?? 'Non spécifié' }}
                                        </div>
                                        <div class="event-duration">
                                            <i class="fas fa-hourglass-half"></i>
                                            {{ $event->start_date->diffForHumans($event->end_date, ['parts' => 1]) }}
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <a href="{{ route('events.show', $event->id) }}" 
                                           class="btn btn-primary">
                                            Plus de détails
                                        </a>
                                        <a href="{{ route('events.book', $event->id) }}" 
                                           class="btn btn-outline-primary">
                                            Réserver
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <h3>Aucun événement prévu pour le moment</h3>
                <p>Revenez bientôt pour découvrir nos prochains événements!</p>
            </div>
        @endforelse
    </div>
</section>
@endsection

@push('styles')
<style>
.event-card {
    transition: transform 0.3s ease;
    border: none;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

.event-card:hover {
    transform: translateY(-5px);
}

.event-img-wrapper {
    height: 200px;
    overflow: hidden;
    position: relative;
}

.event-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.event-time {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.9rem;
}

.no-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    color: #dee2e6;
}

.no-image-placeholder i {
    font-size: 3rem;
}

.date-header {
    color: #333;
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
    text-transform: capitalize;
}

.event-details {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
    color: #6c757d;
    font-size: 0.9rem;
}

.event-location, .event-duration {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-outline-primary:hover {
    color: white;
}
</style>
@endpush 