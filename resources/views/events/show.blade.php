<x-app-layout>
<div class="w-full bg-gray-100 min-h-screen pb-20">

    {{-- EVENT COVER --}}
    <div class="w-full h-64 sm:h-80 lg:h-[420px] overflow-hidden">
        @if ($event->cover)
            <img src="{{ asset($event->cover) }}" 
                 class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gray-300"></div>
        @endif
    </div>

    {{-- EVENT HEADER INFO --}}
    <section class="px-6 sm:px-12 lg:px-24 py-10">
        <h1 class="text-3xl font-bold mb-3">{{ $event->event_name }}</h1>

        <div class="text-gray-600 text-sm sm:text-base leading-relaxed space-y-1">
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Organizer:</strong> {{ $event->organizer_name }}</p>
            <p>
                <strong>Dates:</strong>
                {{ date('M d, Y', strtotime($event->start_date)) }} – 
                {{ date('M d, Y', strtotime($event->end_date)) }}
            </p>
        </div>

        <p class="text-gray-700 text-sm sm:text-base mt-6 leading-relaxed">
            {{ $event->description }}
        </p>
    </section>


    {{-- BOOTH MAP IMAGE --}}
    @if ($event->event_booth_map)
    <section class="px-6 sm:px-12 lg:px-24">
        <h2 class="text-xl font-semibold mb-3">Booth Layout</h2>

        <div class="w-full bg-gray-200 rounded-lg overflow-hidden">
            <img src="{{ asset($event->event_booth_map) }}" 
                 class="w-full h-auto object-contain">
        </div>
    </section>
    @endif


    {{-- BOOTH STATUS LEGEND --}}
    <section class="px-6 sm:px-12 lg:px-24 mt-10 mb-6">
        <h2 class="text-xl font-semibold mb-4">Booth Status</h2>

        <div class="flex gap-4 text-sm items-center">
            <div class="flex items-center gap-1">
                <div class="w-4 h-4 bg-green-300 border border-green-500"></div>
                <span>Available</span>
            </div>

            <div class="flex items-center gap-1">
                <div class="w-4 h-4 bg-red-300 border border-red-500"></div>
                <span>Booked</span>
            </div>

            <div class="flex items-center gap-1">
                <div class="w-4 h-4 bg-yellow-300 border border-yellow-500"></div>
                <span>Unavailable</span>
            </div>
        </div>
    </section>


    {{-- BOOTH MAP GRID LIKE MOCKUP --}}
    <section class="px-6 sm:px-12 lg:px-24">
        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4 justify-items-center">

            @php
                function booth_color($status) {
                    return match($status) {
                        'available'   => 'bg-green-300 border-green-500',
                        'booked'      => 'bg-red-300 border-red-500',
                        'unavailable' => 'bg-yellow-300 border-yellow-500',
                        default       => 'bg-gray-300 border-gray-500',
                    };
                }
            @endphp

            @foreach ($event->booths as $booth)
                <div class="w-14 h-14 flex items-center justify-center 
                            border rounded-md text-sm font-semibold
                            {{ booth_color($booth->status) }}">
                    {{ $booth->booth_code }}
                </div>
            @endforeach

        </div>
    </section>


</div>
</x-app-layout>
