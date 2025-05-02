@extends('admin.layout')

@section('content')

<div class="container">
    <h2 class="mb-4">Gestion des événements</h2>

    <!-- Formulaire de recherche et filtres -->
    <form method="GET" action="{{ route('events.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" placeholder="Rechercher..." class="form-control" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="event_type" class="form-select">
                    <option value="">Tous types</option>
                    <option value="presentiel" {{ request('event_type') == 'presentiel' ? 'selected' : '' }}>Présentiel</option>
                    <option value="online" {{ request('event_type') == 'online' ? 'selected' : '' }}>En ligne</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Tous statuts</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publié</option>
                    <option value="deactivated" {{ request('status') == 'deactivated' ? 'selected' : '' }}>Désactivé</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtrer</button>
            </div>
        </div>
    </form>

    <!-- Liste des événements -->
    <div class="card">
        <div class="card-header">Événements existants</div>
        <div class="card-body">
            @if($events->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Lieu</th>
                        <th>Type</th>
                        <th>Type de paiement</th>
                        <th>Catégorie</th>
                        <th>Créé par</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ ucfirst($event->event_type) }}</td>
                        <td>{{ ucfirst($event->payment_type) }}</td>
                        <td>{{ $event->category_id }}</td>
                        <td>{{ $event->created_by }}</td>
                        <td>
                            @if($event->status == 'published')
                                <span class="badge bg-success">Publié</span>
                            @elseif($event->status == 'draft')
                                <span class="badge bg-warning">Brouillon</span>
                            @else
                                <span class="badge bg-secondary">Désactivé</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-info">Voir</a>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $events->links() }}
            </div>

            @else
            <p class="text-muted">Aucun événement disponible.</p>
            @endif
        </div>
    </div>
</div>

@endsection
