<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['creator'])
            ->latest()
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ticket_types' => 'required|array|min:1',
            'ticket_types.*.name' => 'required|string|max:255',
            'ticket_types.*.price' => 'required|numeric|min:0',
            'ticket_types.*.capacity' => 'nullable|integer|min:1',
            'ticket_types.*.description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validatedData['image'] = $path;
        }

        $validatedData['created_by'] = auth()->id();
        $validatedData['is_published'] = false;
        $validatedData['is_active'] = true;

        $event = Event::create($validatedData);

        // Create ticket types
        foreach ($request->ticket_types as $ticketTypeData) {
            $event->ticketTypes()->create([
                'name' => $ticketTypeData['name'],
                'price' => $ticketTypeData['price'],
                'capacity' => $ticketTypeData['capacity'] ?? null,
                'description' => $ticketTypeData['description'] ?? null,
            ]);
        }

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            
            $path = $request->file('image')->store('events', 'public');
            $validatedData['image'] = $path;
        }

        $event->update($validatedData);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function publish(Event $event)
    {
        $event->update([
            'is_published' => true,
            'published_at' => Carbon::now()
        ]);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event published successfully.');
    }

    public function deactivate(Event $event)
    {
        $event->update([
            'is_published' => false
        ]);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event unpublished successfully.');
    }
}