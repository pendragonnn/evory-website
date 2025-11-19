<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Booth;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $events_count   = Event::count();
        $booths_count   = Booth::count();
        $bookings_count = Booking::count();

        // ambil 5 booking terakhir (nanti bisa diganti real)
        $recent_bookings = Booking::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'events_count',
            'booths_count',
            'bookings_count',
            'recent_bookings'
        ));
    }
}
