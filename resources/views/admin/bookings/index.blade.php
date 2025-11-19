<x-admin-layout>
    <x-slot name="title">Bookings</x-slot>

    <div class="max-w-7xl mx-auto py-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Bookings Management</h1>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-4">
            <table id="bookings-table" class="stripe hover w-full text-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Event</th>
                        <th>Booth</th>
                        <th>Rental</th>
                        <th>Booking Status</th>
                        <th>Payment Status</th>
                        <th style="width:160px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $b)
                        <tr>
                            <td>{{ $b->id }}</td>
                            <td>{{ $b->user->name ?? '-' }}<br><small class="text-gray-500">{{ $b->user->email ?? '' }}</small></td>
                            <td>{{ $b->booth->event->event_name ?? '-' }}</td>
                            <td>{{ $b->booth->booth_code ?? '-' }}</td>
                            <td>{{ $b->rental_start_date }} — {{ $b->rental_end_date }}</td>
                            <td>
                                <span class="px-3 py-1 rounded-full text-xs
                                    {{ $b->status === 'Approved' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $b->status === 'Pending' ? 'bg-gray-100 text-gray-700' : '' }}
                                    {{ $b->status === 'Waiting Payment' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $b->status === 'Processing' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $b->status === 'Rejected' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $b->status === 'Cancelled' ? 'bg-gray-800 text-white' : '' }}">
                                    {{ $b->status }}
                                </span>
                            </td>
                            <td>
                                <span class="px-3 py-1 rounded-full text-xs
                                    {{ optional($b->payment)->payment_status === 'Paid' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ optional($b->payment)->payment_status === 'Waiting Verification' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ optional($b->payment)->payment_status === 'Rejected' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ optional($b->payment)->payment_status === 'Unpaid' ? 'bg-gray-100 text-gray-700' : '' }}">
                                    {{ optional($b->payment)->payment_status ?? 'Unpaid' }}
                                </span>
                            </td>
                            <td class="flex gap-2">
                                <a href="{{ route('admin.bookings.show', $b) }}" class="px-3 py-1 text-xs bg-purple-700 hover:bg-purple-800 text-white rounded">View</a>

                                @if($b->status !== 'Approved')
                                    <button class="approve-btn px-3 py-1 text-xs bg-green-600 hover:bg-green-700 text-white rounded"
                                            data-id="{{ $b->id }}" data-action="approve">Approve</button>
                                @endif

                                @if($b->status !== 'Rejected')
                                    <button class="reject-btn px-3 py-1 text-xs bg-red-600 hover:bg-red-700 text-white rounded"
                                            data-id="{{ $b->id }}" data-action="reject">Reject</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- modal form -->
    <div id="confirm-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
            <h3 id="confirm-title" class="text-lg font-semibold mb-2">Confirm Action</h3>
            <p id="confirm-message" class="text-sm text-gray-600 mb-4">Are you sure?</p>
            <div class="flex justify-end gap-3">
                <button id="confirm-cancel" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>

                <form id="confirm-form" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="action" id="confirm-action" value="">
                    <button type="submit" class="px-4 py-2 rounded text-white" id="confirm-submit">Confirm</button>
                </form>
            </div>
        </div>
    </div>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#bookings-table').DataTable({
                pageLength: 10,
                responsive: true,
                order: [[0, 'desc']]
            });

            // Modal logic
            function openModal(title, message, formAction, actionName, btnClass) {
                $('#confirm-title').text(title);
                $('#confirm-message').text(message);
                $('#confirm-action').val(actionName);
                $('#confirm-form').attr('action', formAction);

                $('#confirm-submit').removeClass().addClass('px-4 py-2 rounded text-white ' + btnClass).text(actionName.charAt(0).toUpperCase() + actionName.slice(1));
                $('#confirm-modal').removeClass('hidden').addClass('flex');
            }

            function closeModal() {
                $('#confirm-modal').removeClass('flex').addClass('hidden');
                $('#confirm-form').attr('action', '#');
                $('#confirm-action').val('');
            }

            $('#confirm-cancel').on('click', closeModal);

            // Approve / Reject buttons
            $('.approve-btn, .reject-btn').on('click', function() {
                const id = $(this).data('id');
                const action = $(this).data('action'); // approve or reject
                const formAction = '{{ url("admin/bookings") }}/' + id + '/status';
                const title = action === 'approve' ? 'Approve Booking' : 'Reject Booking';
                const message = action === 'approve' ? 'Are you sure you want to approve this booking?' : 'Are you sure you want to reject this booking?';
                const btnClass = action === 'approve' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700';

                openModal(title, message, formAction, action, btnClass);
            });
        });
    </script>
</x-admin-layout>
