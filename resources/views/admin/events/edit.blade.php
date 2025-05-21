
@extends('admin.layout')

@section('title', 'Modifier un événement')

@section('content')
    <h1>Modifier un événement</h1>

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $event->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $event->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Date de début</label>
            <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ $event->start_date }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Date de fin</label>
            <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ $event->end_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection