<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="max-w-7xl mx-auto">

        <!-- Greeting -->
        <h1 class="text-3xl font-bold mb-2">Admin Dashboard</h1>
        <p class="text-gray-700 mb-8">
            Welcome back, <span class="font-semibold">{{ auth()->user()->name }}</span> 👋  
        </p>

        <!-- Stats Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <!-- Events Count -->
            <div class="bg-white shadow rounded-lg p-6 flex items-center gap-4">
                <div class="p-4 bg-purple-100 rounded-full">
                    <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                              d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2v-6H3v6a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold">{{ $events_count ?? 0 }}</h3>
                    <p class="text-gray-600 text-sm">Total Events</p>
                </div>
            </div>

            <!-- Booths Count -->
            <div class="bg-white shadow rounded-lg p-6 flex items-center gap-4">
                <div class="p-4 bg-purple-100 rounded-full">
                    <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                              d="M4 6a2 2 0 012-2h12a2 2 0 012 2v6H4V6zM4 14h16v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold">{{ $booths_count ?? 0 }}</h3>
                    <p class="text-gray-600 text-sm">Total Booths</p>
                </div>
            </div>

            <!-- Bookings Count -->
            <div class="bg-white shadow rounded-lg p-6 flex items-center gap-4">
                <div class="p-4 bg-purple-100 rounded-full">
                    <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                              d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold">{{ $bookings_count ?? 0 }}</h3>
                    <p class="text-gray-600 text-sm">Total Bookings</p>
                </div>
            </div>

        </div>

        <!-- Recent Bookings Table -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Recent Bookings</h2>

            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="py-3 px-2 font-semibold text-gray-700">Customer</th>
                        <th class="py-3 px-2 font-semibold text-gray-700">Event</th>
                        <th class="py-3 px-2 font-semibold text-gray-700">Booth</th>
                        <th class="py-3 px-2 font-semibold text-gray-700">Status</th>
                        <th class="py-3 px-2 font-semibold text-gray-700">Date</th>
                    </tr>
                </thead>

                <tbody class="text-gray-600">

                    <!-- Dummy Data -->
                    @foreach([
                        ['name' => 'Budi Santoso', 'event' => 'Tech Expo 2025', 'booth' => 'A12', 'status' => 'Pending', 'date' => '2025-02-01'],
                        ['name' => 'Siti Aminah', 'event' => 'Fashion Fair', 'booth' => 'C07', 'status' => 'Approved', 'date' => '2025-02-02'],
                        ['name' => 'Agus Pratama', 'event' => 'Culinary Week', 'booth' => 'B03', 'status' => 'Waiting Payment', 'date' => '2025-02-03'],
                        ['name' => 'Dewi Lestari', 'event' => 'Startup Summit', 'booth' => 'D15', 'status' => 'Rejected', 'date' => '2025-02-04'],
                        ['name' => 'Rizky Kurniawan', 'event' => 'Craft Festival', 'booth' => 'A09', 'status' => 'Pending', 'date' => '2025-02-05'],
                    ] as $booking)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-2">{{ $booking['name'] }}</td>
                            <td class="py-3 px-2">{{ $booking['event'] }}</td>
                            <td class="py-3 px-2">{{ $booking['booth'] }}</td>
                            <td class="py-3 px-2">
                                <span class="px-3 py-1 text-xs rounded-full
                                    {{ $booking['status'] === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $booking['status'] === 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $booking['status'] === 'Rejected' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $booking['status'] === 'Waiting Payment' ? 'bg-blue-100 text-blue-700' : '' }}">
                                    {{ $booking['status'] }}
                                </span>
                            </td>
                            <td class="py-3 px-2">{{ $booking['date'] }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</x-admin-layout>
