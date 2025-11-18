<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">
        <div class="bg-white shadow rounded-lg p-6">

            <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
            <p class="text-gray-700 mb-6">
                Welcome back, <span class="font-semibold">{{ auth()->user()->name }}</span> 👋  
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="p-5 border rounded-lg hover:bg-gray-50 transition">
                    <h2 class="font-bold text-lg">Events</h2>
                    <p class="text-gray-600 text-sm mt-2">Manage all events in the system.</p>
                </div>

                <div class="p-5 border rounded-lg hover:bg-gray-50 transition">
                    <h2 class="font-bold text-lg">Booths</h2>
                    <p class="text-gray-600 text-sm mt-2">Control booth availability and pricing.</p>
                </div>

                <div class="p-5 border rounded-lg hover:bg-gray-50 transition">
                    <h2 class="font-bold text-lg">Bookings</h2>
                    <p class="text-gray-600 text-sm mt-2">Monitor booth rental activities.</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
