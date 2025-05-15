@extends('layouts.app')

@section('content')
<section id="gallery" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title-header text-center">
                    <h1 class="section-title wow fadeInUp" data-wow-delay="0.2s">Galerie d'événements</h1>
                    <p class="wow fadeInDown" data-wow-delay="0.2s">Découvrez nos événements en images</p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($events as $event)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card gallery-card h-100">
                        <div class="gallery-img-wrapper">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" 
                                     class="card-img-top gallery-img" 
                                     alt="{{ $event->title }}">
                            @else
                                <div class="no-image-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                            <div class="event-details">
                                <span class="event-date">
                                    <i class="fas fa-calendar"></i> 
                                    {{ $event->start_date->format('d/m/Y') }}
                                </span>
                                <span class="event-location">
                                    <i class="fas fa-map-marker-alt"></i> 
                                    {{ $event->location ?? 'Non spécifié' }}
                                </span>
                            </div>
                            <a href="{{ route('events.show', $event->id) }}" 
                               class="btn btn-primary mt-3">
                                Voir l'événement
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Aucun événement disponible pour le moment.</p>
                </div>
            @endforelse
        </div>

        @if($events->hasPages())
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $events->links() }}
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
.gallery-card {
    transition: transform 0.3s ease;
    border: none;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

.gallery-card:hover {
    transform: translateY(-5px);
}

.gallery-img-wrapper {
    height: 200px;
    overflow: hidden;
    position: relative;
}

.gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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

.event-details {
    display: flex;
    justify-content: space-between;
    margin-top: 1rem;
    color: #6c757d;
    font-size: 0.9rem;
}

.event-date, .event-location {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
</style>
@endpush 