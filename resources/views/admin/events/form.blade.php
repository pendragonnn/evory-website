<x-admin-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <div class="max-w-5xl mx-auto py-6">
        <div class="bg-white shadow rounded-lg p-6">

            <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>

            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($method === 'PUT')
                    @method('PUT')
                @endif

                <!-- EVENT FIELDS -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="font-semibold">Event Name</label>
                        <input type="text" name="event_name" value="{{ old('event_name', $event->event_name) }}"
                               class="mt-1 w-full border-gray-300 rounded" required>
                    </div>

                    <div>
                        <label class="font-semibold">Location</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}"
                               class="mt-1 w-full border-gray-300 rounded">
                    </div>

                    <div>
                        <label class="font-semibold">Start Date</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $event->start_date) }}"
                               class="mt-1 w-full border-gray-300 rounded" required>
                    </div>

                    <div>
                        <label class="font-semibold">End Date</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $event->end_date) }}"
                               class="mt-1 w-full border-gray-300 rounded" required>
                    </div>

                    <div class="md:col-span-2 mt-3">
                        <label class="font-semibold">Organizer Name</label>
                        <input type="text" name="organizer_name" value="{{ old('organizer_name', $event->organizer_name) }}"
                               class="mt-1 w-full border-gray-300 rounded">
                    </div>

                    <div class="md:col-span-2 mt-3">
                        <label class="font-semibold">Description</label>
                        <textarea name="description" rows="4"
                                  class="mt-1 w-full border-gray-300 rounded">{{ old('description', $event->description) }}</textarea>
                    </div>

                    <div>
                        <label class="font-semibold">Event Booth Map</label>
                        <input type="file" name="event_booth_map" class="mt-1 w-full border-gray-300 rounded">
                        @if($event->event_booth_map)
                            <p class="text-sm text-gray-600 mt-1">Current: {{ $event->event_booth_map }}</p>
                        @endif
                    </div>

                    <div>
                        <label class="font-semibold">Cover</label>
                        <input type="file" name="cover" class="mt-1 w-full border-gray-300 rounded">
                        @if($event->cover)
                            <p class="text-sm text-gray-600 mt-1">Current: {{ $event->cover }}</p>
                        @endif
                    </div>

                </div>

                <!-- BOOTH REPEATER -->
                <div class="mt-10">
                    <h2 class="text-xl font-semibold mb-4">Booth Management</h2>

                    <div id="booth-wrapper" class="space-y-4">

                        @php
                            $booths = old('booths', $event->id ? $event->booths->toArray() : []);
                        @endphp

                        @foreach ($booths as $i => $booth)
                            <div class="booth-item p-4 border rounded-md bg-gray-50">

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                    <div>
                                        <label class="text-sm font-semibold">Booth Code</label>
                                        <input type="text" name="booths[{{ $i }}][booth_code]" value="{{ $booth['booth_code'] }}"
                                               class="mt-1 w-full border-gray-300 rounded" required>
                                    </div>

                                    <div>
                                        <label class="text-sm font-semibold">Type</label>
                                        <input type="text" name="booths[{{ $i }}][type]" value="{{ $booth['type'] ?? '' }}"
                                               class="mt-1 w-full border-gray-300 rounded">
                                    </div>

                                    <div>
                                        <label class="text-sm font-semibold">Size</label>
                                        <input type="text" name="booths[{{ $i }}][size]" value="{{ $booth['size'] ?? '' }}"
                                               class="mt-1 w-full border-gray-300 rounded">
                                    </div>

                                    <div>
                                        <label class="text-sm font-semibold">Price</label>
                                        <input type="number" name="booths[{{ $i }}][price]" value="{{ $booth['price'] }}"
                                               class="mt-1 w-full border-gray-300 rounded" required>
                                    </div>

                                    <div>
                                        <label class="text-sm font-semibold">Available From</label>
                                        <input type="date" name="booths[{{ $i }}][available_start_date]"
                                               value="{{ $booth['available_start_date'] }}"
                                               class="mt-1 w-full border-gray-300 rounded" required>
                                    </div>

                                    <div>
                                        <label class="text-sm font-semibold">Available Until</label>
                                        <input type="date" name="booths[{{ $i }}][available_end_date]"
                                               value="{{ $booth['available_end_date'] }}"
                                               class="mt-1 w-full border-gray-300 rounded" required>
                                    </div>

                                </div>

                                <button type="button"
                                        class="remove-booth mt-3 px-3 py-1 bg-red-600 text-white text-xs rounded">
                                    Remove Booth
                                </button>

                            </div>
                        @endforeach

                    </div>

                    <button type="button" id="add-booth"
                            class="mt-4 px-4 py-2 bg-purple-700 text-white rounded-md text-sm">
                        + Add Booth
                    </button>

                </div>

                <!-- SAVE BUTTON -->
                <div class="mt-10">
                    <button class="px-6 py-2 bg-purple-800 hover:bg-purple-900 text-white rounded-md shadow">
                        Save Event
                    </button>
                </div>

            </form>
        </div>
    </div>


    <!-- JS TEMPLATE FOR BOOTH REPEATER -->
    <template id="booth-template">
        <div class="booth-item p-4 border rounded-md bg-gray-50">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="text-sm font-semibold">Booth Code</label>
                    <input type="text" name="booths[__i__][booth_code]"
                           class="mt-1 w-full border-gray-300 rounded" required>
                </div>

                <div>
                    <label class="text-sm font-semibold">Type</label>
                    <input type="text" name="booths[__i__][type]"
                           class="mt-1 w-full border-gray-300 rounded">
                </div>

                <div>
                    <label class="text-sm font-semibold">Size</label>
                    <input type="text" name="booths[__i__][size]"
                           class="mt-1 w-full border-gray-300 rounded">
                </div>

                <div>
                    <label class="text-sm font-semibold">Price</label>
                    <input type="number" name="booths[__i__][price]"
                           class="mt-1 w-full border-gray-300 rounded" required>
                </div>

                <div>
                    <label class="text-sm font-semibold">Available From</label>
                    <input type="date" name="booths[__i__][available_start_date]"
                           class="mt-1 w-full border-gray-300 rounded" required>
                </div>

                <div>
                    <label class="text-sm font-semibold">Available Until</label>
                    <input type="date" name="booths[__i__][available_end_date]"
                           class="mt-1 w-full border-gray-300 rounded" required>
                </div>

            </div>

            <button type="button"
                    class="remove-booth mt-3 px-3 py-1 bg-red-600 text-white text-xs rounded">
                Remove Booth
            </button>

        </div>
    </template>

    <script>
        let index = {{ count($booths) }};

        document.getElementById('add-booth').addEventListener('click', () => {
            let template = document.getElementById('booth-template').innerHTML;
            template = template.replace(/__i__/g, index);

            const wrapper = document.getElementById('booth-wrapper');
            wrapper.insertAdjacentHTML('beforeend', template);

            index++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-booth')) {
                e.target.closest('.booth-item').remove();
            }
        });
    </script>

</x-admin-layout>
