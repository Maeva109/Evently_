<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\EventPhoto;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    // 
    public function home(){
        // Get the next featured event
        $nextFeaturedEvent = Event::where('is_published', true)
            ->where('is_active', true)
            ->where('start_date', '>=', Carbon::now())
            ->orderBy('start_date')
            ->first();

        // Get all upcoming events grouped by date
        $events = Event::where('is_published', true)
            ->where('is_active', true)
            ->where('start_date', '>=', Carbon::now())
            ->orderBy('start_date')
            ->get()
            ->groupBy(function($event) {
                return Carbon::parse($event->start_date)->format('Y-m-d');
            });

        // Get statistics for counter section
        $totalEvents = Event::where('is_published', true)->count();
        $totalOrganizers = Event::distinct('created_by')->count();
        $totalLocations = Event::distinct('location')->count();
        $totalBookings = 0; // You'll need to implement this based on your booking model

        // Get featured organizers (users who have created the most events)
        $featuredOrganizers = User::select('users.*')
            ->selectRaw('(SELECT COUNT(*) FROM events WHERE users.id = events.created_by AND is_published = 1 AND is_active = 1) as events_count')
            ->having('events_count', '>', 0)
            ->orderBy('events_count', 'desc')
            ->take(4)
            ->get();

        // Get event gallery photos
        $eventGallery = EventPhoto::with('event')
            ->whereHas('event', function($query) {
                $query->where('is_published', true)
                      ->where('is_active', true);
            })
            ->latest()
            ->take(6)
            ->get();

        // Get latest blog posts
        $latestPosts = Post::latest()
            ->take(3)
            ->get();

        return view('home', compact(
            'events',
            'nextFeaturedEvent',
            'totalEvents',
            'totalOrganizers',
            'totalLocations',
            'totalBookings',
            'featuredOrganizers',
            'eventGallery',
            'latestPosts'
        ));
    }
    
}
