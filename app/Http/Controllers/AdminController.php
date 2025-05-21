<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Get total counts
        $totalEvents = Event::count();
        $activeEvents = Event::where('is_published', true)
            ->where('is_active', true)
            ->where('end_date', '>=', Carbon::now())
            ->count();
        $totalOrganizers = User::where('role', 'organizer')->count();
        $totalBookings = 0; // TODO: Implement when booking system is ready

        // Get recent events
        $recentEvents = Event::latest()
            ->take(5)
            ->get();

        // Get upcoming events
        $upcomingEvents = Event::where('start_date', '>=', Carbon::now())
            ->where('is_published', true)
            ->where('is_active', true)
            ->orderBy('start_date')
            ->take(5)
            ->get();

        // Recent activity will be implemented later with activity logging

        return view('admin.index', compact(
            'totalEvents',
            'activeEvents',
            'totalOrganizers',
            'totalBookings',
            'recentEvents',
            'upcomingEvents'
        ));
    }

    //
    public function admin(){
        $events = Event::all();
        // dd($events);
        return view('admin.home', compact('events'));
    }
}
