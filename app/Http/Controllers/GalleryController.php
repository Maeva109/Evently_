<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $events = Event::where('is_published', true)
            ->where('is_active', true)
            ->whereNotNull('image')
            ->orderBy('start_date', 'desc')
            ->paginate(12);

        return view('gallery.index', compact('events'));
    }
} 