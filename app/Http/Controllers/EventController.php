<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['book']);
    }

    public function index()
    {
        $eventsByDate = Event::where('is_published', true)
            ->where('is_active', true)
            ->where('start_date', '>=', Carbon::now())
            ->orderBy('start_date')
            ->get()
            ->groupBy(function($event) {
                return $event->start_date->format('Y-m-d');
            });

        return view('events.index', compact('eventsByDate'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function featured()
    {
        $events = Event::where('is_published', true)
                      ->where('is_active', true)
                      ->where('start_date', '>=', Carbon::now())
                      ->orderBy('start_date')
                      ->take(6)
                      ->get();

        return view('events.featured', compact('events'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function book(Event $event)
    {
        // Check if event is still available for booking
        if (!$event->is_published || !$event->is_active || $event->start_date < Carbon::now()) {
            return redirect()->route('events.show', $event)
                           ->with('error', 'This event is no longer available for booking.');
        }

        // Check if there are available tickets
        if ($event->isFullyBooked()) {
            return redirect()->route('events.show', $event)
                           ->with('error', 'Sorry, this event is fully booked.');
        }

        return view('events.book', compact('event'));
    }

    public function register(Event $event)
    {
        return view('events.register', compact('event'));
    }

    public function schedules()
    {
        $eventsByDate = Event::where('is_published', true)
            ->where('is_active', true)
            ->where('start_date', '>=', Carbon::now())
            ->orderBy('start_date')
            ->get()
            ->groupBy(function($event) {
                return $event->start_date->format('Y-m-d');
            });

        return view('events.schedules', compact('eventsByDate'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'ticket_types' => 'required|array|min:1',
            'ticket_types.*.name' => 'required|string|max:255',
            'ticket_types.*.price' => 'required|numeric|min:0',
            'ticket_types.*.capacity' => 'nullable|integer|min:1',
            'ticket_types.*.description' => 'nullable|string',
        ]);

        $event = new Event();
        $event->title = $validated['title'];
        $event->description = $validated['description'];
        $event->start_date = $validated['start_date'];
        $event->end_date = $validated['end_date'];
        $event->location = $validated['location'];
        $event->is_published = $request->has('is_published');
        $event->is_active = true;
        $event->created_by = auth()->id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/events'), $imageName);
            $event->image = 'images/events/' . $imageName;
        }

        $event->save();

        // Create ticket types
        foreach ($request->ticket_types as $ticketTypeData) {
            $event->ticketTypes()->create([
                'name' => $ticketTypeData['name'],
                'price' => $ticketTypeData['price'],
                'capacity' => $ticketTypeData['capacity'] ?? null,
                'description' => $ticketTypeData['description'] ?? null,
            ]);
        }

        return redirect()->route('events.show', $event)
            ->with('success', 'Event created successfully!');
    }
}