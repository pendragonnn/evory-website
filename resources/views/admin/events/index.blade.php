<x-admin-layout>
    <x-slot name="title">Events</x-slot>

    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Events Data Management</h1>

            <a href="{{ route('admin.events.create') }}"
               class="px-4 py-2 bg-purple-700 hover:bg-purple-800 text-white rounded-md text-sm shadow">
                + Create Event
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-lg rounded-lg p-5 overflow-x-auto">
            <table id="events-table" class="stripe hover w-full text-sm">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Location</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->event_name }}</td>
                            <td>{{ $event->location ?? '-' }}</td>
                            <td>{{ $event->start_date }}</td>
                            <td>{{ $event->end_date }}</td>

                            <td class="flex items-center gap-2">

                                <!-- Edit -->
                                <a href="{{ route('admin.events.edit', $event->id) }}"
                                   class="px-3 py-1 rounded-md text-xs bg-blue-600 hover:bg-blue-700 text-white">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.events.destroy', $event->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this event?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-3 py-1 rounded-md text-xs bg-red-600 hover:bg-red-700 text-white">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#events-table').DataTable({
                pageLength: 10,
                responsive: true,
                order: [[0, 'asc']],
            });
        });
    </script>

</x-admin-layout>
