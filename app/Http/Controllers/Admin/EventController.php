<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Booth;
use Illuminate\Http\Request;
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
            'title'  => 'Create Event',
            'event'  => new Event(),
            'method' => 'POST',
            'action' => route('admin.events.store'),
        ]);
    }

    public function store(Request $request)
    {
        // ============================
        // EVENT VALIDATION
        // ============================
        $validated = $request->validate([
            'event_name'     => 'required|string|max:200',
            'location'       => 'nullable|string|max:255',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'organizer_name' => 'nullable|string|max:150',
            'description'    => 'nullable|string',
            'event_booth_map' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cover'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'booths'                     => 'nullable|array',
            'booths.*.booth_code'        => 'required|string|max:50',
            'booths.*.type'              => 'nullable|string|max:100',
            'booths.*.size'              => 'nullable|string|max:50',
            'booths.*.price'             => 'required|numeric|min:0',
            'booths.*.available_start_date' => 'required|date',
            'booths.*.available_end_date'   => 'required|date|after_or_equal:booths.*.available_start_date',
        ]);

        // STEP 1 — Create event WITHOUT files
        $event = Event::create(Arr::except($validated, ['event_booth_map', 'cover', 'booths']));

        // STEP 2 — Upload booth map (if exists)
        if ($request->hasFile('event_booth_map')) {
            $extension = $request->event_booth_map->extension();
            $filename = Str::slug($event->event_name) . '_map_' . $event->id . '.' . $extension;

            $request->event_booth_map->move(public_path('event_maps'), $filename);

            $event->update(['event_booth_map' => 'event_maps/' . $filename]);
        }

        // STEP 3 — Upload cover (if exists)
        if ($request->hasFile('cover')) {
            $extension = $request->cover->extension();
            $filename = Str::slug($event->event_name) . '_cover_' . $event->id . '.' . $extension;

            $request->cover->move(public_path('event_covers'), $filename);

            $event->update(['cover' => 'event_covers/' . $filename]);
        }

        // STEP 4 — Insert booth array
        if (!empty($validated['booths'])) {
            foreach ($validated['booths'] as $booth) {
                Booth::create([
                    'event_id' => $event->id,
                    'booth_code' => $booth['booth_code'],
                    'type' => $booth['type'] ?? null,
                    'size' => $booth['size'] ?? null,
                    'price' => $booth['price'],
                    'available_start_date' => $booth['available_start_date'],
                    'available_end_date' => $booth['available_end_date'],
                    'status' => 'available',
                ]);
            }
        }

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event successfully created!');
    }


    public function edit(Event $event)
    {
        return view('admin.events.form', [
            'title'  => 'Edit Event',
            'event'  => $event,
            'method' => 'PUT',
            'action' => route('admin.events.update', $event->id),
        ]);
    }

    public function update(Request $request, Event $event)
    {
        // ============================
        // EVENT VALIDATION
        // ============================
        $validated = $request->validate([
            'event_name'     => 'required|string|max:200',
            'location'       => 'nullable|string|max:255',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'organizer_name' => 'nullable|string|max:150',
            'description'    => 'nullable|string',
            'event_booth_map' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cover'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'booths'                     => 'nullable|array',
            'booths.*.booth_code'        => 'required|string|max:50',
            'booths.*.type'              => 'nullable|string|max:100',
            'booths.*.size'              => 'nullable|string|max:50',
            'booths.*.price'             => 'required|numeric|min:0',
            'booths.*.available_start_date' => 'required|date',
            'booths.*.available_end_date'   => 'required|date|after_or_equal:booths.*.available_start_date',
        ]);

        // STEP 1 — Update event data (except files & booths)
        $event->update(Arr::except($validated, ['event_booth_map', 'cover', 'booths']));

        // STEP 2 — Update map (if uploaded)
        if ($request->hasFile('event_booth_map')) {
            if ($event->event_booth_map && file_exists(public_path($event->event_booth_map))) {
                unlink(public_path($event->event_booth_map));
            }

            $extension = $request->event_booth_map->extension();
            $filename = Str::slug($event->event_name) . '_map_' . $event->id . '.' . $extension;

            $request->event_booth_map->move(public_path('event_maps'), $filename);

            $event->update(['event_booth_map' => 'event_maps/' . $filename]);
        }

        // STEP 3 — Update cover (if uploaded)
        if ($request->hasFile('cover')) {
            if ($event->cover && file_exists(public_path($event->cover))) {
                unlink(public_path($event->cover));
            }

            $extension = $request->cover->extension();
            $filename = Str::slug($event->event_name) . '_cover_' . $event->id . '.' . $extension;

            $request->cover->move(public_path('event_covers'), $filename);

            $event->update(['cover' => 'event_covers/' . $filename]);
        }

        // STEP 4 — Replace booths
        // delete existing booths
        $event->booths()->delete();

        // insert new booths
        if (!empty($validated['booths'])) {
            foreach ($validated['booths'] as $booth) {
                Booth::create([
                    'event_id' => $event->id,
                    'booth_code' => $booth['booth_code'],
                    'type' => $booth['type'] ?? null,
                    'size' => $booth['size'] ?? null,
                    'price' => $booth['price'],
                    'available_start_date' => $booth['available_start_date'],
                    'available_end_date' => $booth['available_end_date'],
                    'status' => 'available',
                ]);
            }
        }

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event successfully updated!');
    }


    public function destroy(Event $event)
    {
        // Hapus event map file jika ada
        if ($event->event_booth_map && file_exists(public_path($event->event_booth_map))) {
            unlink(public_path($event->event_booth_map));
        }

        // Hapus cover file jika ada
        if ($event->cover && file_exists(public_path($event->cover))) {
            unlink(public_path($event->cover));
        }

        // Hapus semua booths terkait event ini
        foreach ($event->booths as $booth) {
            $booth->delete(); // soft delete
        }

        // Hapus event (soft delete)
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event and its booths successfully deleted!');
    }
}
