<x-app-layout>
  <div class="max-w-6xl mx-auto py-10">
    <div class="bg-white shadow rounded-lg p-6">

      <h1 class="text-3xl font-bold mb-4">Welcome to Evory</h1>
      @if(auth()->check())
        <p class="text-gray-700 mb-6">
          Hello <span class="font-semibold">{{ auth()->user()->name }}</span>,
          explore available events and book your booth with ease.
        </p>
      @else
        <p class="text-gray-700 mb-6">
          Welcome to Evory. Please login to browse and book booths.
        </p>
      @endif

      <div class="space-y-4">
        <a href="#" class="block p-5 border rounded-lg hover:bg-gray-50 transition">
          <h2 class="font-semibold text-lg">Browse Events</h2>
          <p class="text-gray-600 text-sm">Discover events currently open for booth rentals.</p>
        </a>

        <a href="#" class="block p-5 border rounded-lg hover:bg-gray-50 transition">
          <h2 class="font-semibold text-lg">My Bookings</h2>
          <p class="text-gray-600 text-sm">Check the status of your booth reservations.</p>
        </a>
      </div>

    </div>
  </div>
</x-app-layout>