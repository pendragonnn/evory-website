<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventListingController extends Controller
{
    public function index(Request $request)
    {
        // Basic query
        $events = Event::orderBy('start_date', 'asc')->paginate(10);

        // Featured events
        $featured = Event::inRandomOrder()->take(4)->get();

        return view('events.index', compact('events', 'featured'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
}
