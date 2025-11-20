<x-app-layout>

<div class="w-full bg-gray-100 min-h-screen pb-20">

    {{-- HERO / PAGE HEADER --}}
    <section class="text-center py-12 px-6 sm:px-12 lg:px-24">
        <h1 class="text-3xl font-semibold mb-2">Explore Events on Evory</h1>

        <p class="text-gray-600 max-w-xl mx-auto text-sm sm:text-base leading-relaxed">
            Discover upcoming exhibitions, creative bazaars, campus events, and more.
        </p>

        <div class="flex justify-center gap-3 mt-4">
            <button class="px-4 py-2 bg-gray-300 rounded-md text-sm">Upcoming</button>
            <button class="px-4 py-2 bg-gray-300 rounded-md text-sm">Featured</button>
        </div>
    </section>


    {{-- FILTER BAR --}}
    <div class="w-full bg-gray-200 py-3 px-6 sm:px-12 lg:px-24 flex gap-3 justify-center text-sm font-medium">
        <button class="px-3 py-1 bg-white rounded-md">All</button>
        <button class="px-3 py-1 bg-white rounded-md">Upcoming</button>
        <button class="px-3 py-1 bg-white rounded-md">Location</button>
        <button class="px-3 py-1 bg-white rounded-md">Event Type</button>
    </div>


    {{-- EVENT LIST --}}
    <section class="px-6 sm:px-12 lg:px-24 py-10 flex flex-col gap-10">
      {{-- {{ dd($events) }} --}}

        @forelse ($events as $event)
        <div class="flex flex-col md:flex-row gap-6">

            {{-- Event image --}}
            <div class="w-full md:w-1/3 h-48 bg-gray-400 rounded-lg">
                @if ($event->cover)
                    <img src="{{ asset($event->cover) }}" 
                         class="w-full h-full object-cover rounded-lg">
                @endif
            </div>

            {{-- Event card --}}
            <div class="w-full md:w-2/3 bg-white rounded-lg p-6 shadow-sm">

                <h3 class="text-xl font-semibold">{{ $event->event_name }}</h3>

                <p class="text-gray-600 text-sm mt-1">
                    Location: {{ $event->location ?? '-' }}
                </p>

                <p class="text-gray-600 text-sm">
                    {{ date('M d, Y', strtotime($event->start_date)) }}
                    —
                    {{ date('M d, Y', strtotime($event->end_date)) }}
                </p>

                <a href="{{ route('events.show', $event->id) }}">
                    <button class="mt-4 px-4 py-2 bg-black text-white rounded-md text-sm">
                        View Details
                    </button>
                </a>

            </div>

        </div>
        @empty
            <p class="text-center text-gray-600">No events available.</p>
        @endforelse

    </section>


    {{-- PAGINATION --}}
    <div class="flex justify-center mt-4">
        {{ $events->links() }}
    </div>


    {{-- FEATURED EVENTS --}}
    <section class="bg-gray-200 py-12 px-6 sm:px-12 lg:px-24 text-center">

        <h2 class="text-xl font-semibold mb-8">Featured Events</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 max-w-5xl mx-auto">

            @foreach ($featured as $item)
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="h-24 bg-gray-300 rounded-md mb-3">
                    @if ($item->cover)
                        <img src="{{ asset('storage/' . $item->cover) }}" 
                             class="w-full h-full object-cover rounded-md">
                    @endif
                </div>

                <h3 class="text-sm font-semibold truncate">{{ $item->event_name }}</h3>

                <p class="text-gray-500 text-xs">
                    {{ date('M d, Y', strtotime($item->start_date)) }} – {{ $item->location }}
                </p>

                <a href="{{ route('events.show', $item->id) }}">
                    <button class="mt-3 px-3 py-1 bg-black text-white text-xs rounded-md">
                        View Details
                    </button>
                </a>
            </div>
            @endforeach

        </div>

        <div class="text-3xl mt-6">...</div>

    </section>

</div>

</x-app-layout>
