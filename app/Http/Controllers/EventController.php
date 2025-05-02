<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // Afficher la liste des événements avec recherche, filtres et pagination
    public function index(Request $request)
    {
        $query = Event::query();

        // Recherche par titre, description ou lieu
        if ($request->filled('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('location', 'LIKE', '%' . $request->search . '%');
        }

        // Filtrer par type d'événement (présentiel/en ligne)
        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }

        // Filtrer par statut (brouillon, publié, désactivé)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pagination (10 événements par page)
        $events = $query->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('admin.events.create');
    }

    // Enregistrer un nouvel événement
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'event_type' => 'required|in:presentiel,online',
            'payment_type' => 'required|in:free,paid',
            'category_id' => 'required|integer|exists:categories,id',
            'created_by' => 'required|integer|exists:users,id',
            'status' => 'required|in:draft,published,deactivated',
        ]);
 
     

            dd($request->all()); // Debug request data


        Event::create($request->all());

        return redirect()->route('admin.events.index')->with('success', 'Événement ajouté avec succès.');
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    // Mettre à jour un événement existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'event_type' => 'required|in:presentiel,online',
            'payment_type' => 'required|in:free,paid',
            'category_id' => 'required|integer|exists:categories,id',
            'created_by' => 'required|integer|exists:users,id',
            'status' => 'required|in:draft,published,deactivated',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Événement mis à jour avec succès.');
    }

    // Supprimer un événement
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Événement supprimé.');
    }
}
