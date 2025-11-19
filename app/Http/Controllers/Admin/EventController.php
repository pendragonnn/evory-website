<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.form', [
            'event' => new Event(),
            'method' => 'POST',
            'action' => route('admin.events.store'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name'     => 'required|string|max:200',
            'location'       => 'nullable|string|max:255',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'organizer_name' => 'nullable|string|max:150',
            'description'    => 'nullable|string',
            'event_booth_map' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan data event tanpa file dulu
        $event = Event::create(Arr::except($validated, ['event_booth_map']));

        // Jika ada file map
        if ($request->hasFile('event_booth_map')) {
            $extension = $request->file('event_booth_map')->getClientOriginalExtension();
            $filename = Str::slug($event->event_name) . '_' . $event->id . '.' . $extension;

            $destination = public_path('event_maps');

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $request->file('event_booth_map')->move($destination, $filename);

            $event->update(['event_booth_map' => 'event_maps/' . $filename]);
        }

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event successfully created!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.form', [
            'event' => $event,
            'method' => 'PUT',
            'action' => route('admin.events.update', $event),
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'event_name'     => 'required|string|max:200',
            'location'       => 'nullable|string|max:255',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'organizer_name' => 'nullable|string|max:150',
            'description'    => 'nullable|string',
            'event_booth_map' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika upload map baru
        if ($request->hasFile('event_booth_map')) {

            // Hapus file lama
            if ($event->event_booth_map && file_exists(public_path($event->event_booth_map))) {
                unlink(public_path($event->event_booth_map));
            }

            // Buat nama file baru
            $extension = $request->file('event_booth_map')->getClientOriginalExtension();
            $filename = Str::slug($event->event_name) . '_' . $event->id . '.' . $extension;

            $destination = public_path('event_maps');
            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $request->file('event_booth_map')->move($destination, $filename);

            $validated['event_booth_map'] = 'event_maps/' . $filename;
        }

        $event->update($validated);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event successfully updated!');
    }

    public function destroy(Event $event)
    {
        // Hapus file map jika ada
        if ($event->event_booth_map && file_exists(public_path($event->event_booth_map))) {
            unlink(public_path($event->event_booth_map));
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event successfully deleted!');
    }
}
