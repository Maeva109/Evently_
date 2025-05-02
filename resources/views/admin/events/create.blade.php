@extends('admin.layout')

@section('content')

<div class="container">
    <h2 class="mb-4">Gestion des événements</h2>

    <!-- Formulaire de création -->
    <div class="card mb-4">
        <div class="card-header">Créer un nouvel événement</div>
        <div class="card-body">
            <form method="POST" action="/events/store">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Titre</label>
                    <input type="text" name="title" class="form-control"  >
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"  ></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date de début</label>
                    <input type="datetime-local" name="start_date" class="form-control"  >
                </div>

                <div class="mb-3">
                    <label class="form-label">Date de fin</label>
                    <input type="datetime-local" name="end_date" class="form-control"  >
                </div>

                <div class="mb-3">
                    <label class="form-label">Lieu</label>
                    <input type="text" name="location" class="form-control"  >
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="event_type" class="form-select">
                        <option value="presentiel">Présentiel</option>
                        <option value="online">En ligne</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Type de paiement</label>
                    <select name="payment_type" class="form-select">
                        <option value="free">Gratuit</option>
                        <option value="paid">Payant</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catégorie</label>
                    <input type="number" name="category_id" class="form-control"  >
                </div>

                <div class="mb-3">
                    <label class="form-label">Créé par (ID utilisateur)</label>
                    <input type="number" name="created_by" class="form-control"  >
                </div>

                <div class="mb-3">
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-select">
                        <option value="draft">Brouillon</option>
                        <option value="published">Publié</option>
                        <option value="deactivated">Désactivé</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Créer l'événement</button>
            </form>
        </div>
    </div>

</div>

@endsection
