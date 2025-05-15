<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['event', 'user', 'ticketType']);

        // Apply filters
        if ($request->filled('event')) {
            $query->where('event_id', $request->event);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment')) {
            $query->where('is_paid', $request->payment === 'paid');
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Get statistics
        $totalBookings = $query->count();
        $totalRevenue = $query->sum('total_price');
        $pendingBookings = $query->where('status', 'pending')->count();
        $todayBookings = $query->whereDate('created_at', today())->count();

        // Get paginated results
        $bookings = $query->latest()->paginate(10);
        $events = Event::all();

        return view('admin.bookings.index', compact(
            'bookings',
            'events',
            'totalBookings',
            'totalRevenue',
            'pendingBookings',
            'todayBookings'
        ));
    }

    public function confirm(Booking $booking)
    {
        $booking->update([
            'status' => Booking::STATUS_CONFIRMED
        ]);

        return back()->with('success', 'Booking confirmed successfully.');
    }

    public function markPaid(Booking $booking)
    {
        $booking->update([
            'is_paid' => true
        ]);

        return back()->with('success', 'Payment marked as received.');
    }

    public function receipt(Booking $booking)
    {
        $pdf = PDF::loadView('admin.bookings.receipt', compact('booking'));
        
        return $pdf->download('receipt-' . $booking->id . '.pdf');
    }

    public function export(Request $request)
    {
        $query = Booking::with(['event', 'user', 'ticketType']);

        // Apply filters
        if ($request->filled('event')) {
            $query->where('event_id', $request->event);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->get();

        $pdf = PDF::loadView('admin.bookings.export', compact('bookings'));
        
        return $pdf->download('bookings-report.pdf');
    }
} 