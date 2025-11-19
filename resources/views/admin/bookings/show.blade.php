<x-admin-layout>
    <x-slot name="title">Booking #{{ $booking->id }}</x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Booking Info -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold mb-4">Booking Information</h2>

                <p>
                    <span class="font-medium">Customer:</span> 
                    {{ $booking->user->name ?? '-' }} <br>
                    <span class="text-gray-500 text-sm">{{ $booking->user->email ?? '' }}</span>
                </p>

                <p class="mt-3"><span class="font-medium">Event:</span> {{ $booking->booth->event->event_name ?? '-' }}</p>

                <p>
                    <span class="font-medium">Booth:</span> 
                    {{ $booking->booth->booth_code ?? '-' }} ({{ $booking->booth->type ?? '' }})
                </p>

                <p class="mt-2">
                    <span class="font-medium">Rental:</span> 
                    {{ $booking->rental_start_date }} — {{ $booking->rental_end_date }}
                </p>

                <p class="mt-3">
                    <span class="font-medium">Booking Status:</span>
                    <span class="px-2 py-1 rounded text-sm
                        @if($booking->status === 'Approved') bg-green-100 text-green-700 @endif
                        @if($booking->status === 'Pending') bg-gray-100 text-gray-700 @endif
                        @if($booking->status === 'Waiting Payment') bg-yellow-100 text-yellow-700 @endif
                        @if($booking->status === 'Processing') bg-blue-100 text-blue-700 @endif
                        @if($booking->status === 'Rejected') bg-red-100 text-red-700 @endif">
                        {{ $booking->status }}
                    </span>
                </p>

                <div class="mt-4 flex gap-3">
                    <form method="POST" action="{{ route('admin.bookings.confirm', $booking) }}">
                        @csrf
                        <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
                            Approve Payment
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.bookings.reject', $booking) }}">
                        @csrf
                        <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                            Reject Payment
                        </button>
                    </form>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold mb-4">Payment</h2>

                @if($booking->payment)

                    <p><span class="font-medium">Method:</span> {{ $booking->payment->payment_method }}</p>

                    <p class="mt-1"><span class="font-medium">Status:</span>
                        <span class="px-2 py-1 rounded text-sm
                            @if($booking->payment->payment_status === 'Paid') bg-green-100 text-green-700 @endif
                            @if($booking->payment->payment_status === 'Waiting Verification') bg-yellow-100 text-yellow-700 @endif
                            @if($booking->payment->payment_status === 'Rejected') bg-red-100 text-red-700 @endif">
                            {{ $booking->payment->payment_status }}
                        </span>
                    </p>

                    @if($booking->payment->payment_proof)
                        <div class="mt-4">
                            <p class="font-medium mb-2">Payment Proof</p>
                            <a href="{{ asset($booking->payment->payment_proof) }}" target="_blank">
                                <img src="{{ asset($booking->payment->payment_proof) }}" 
                                     class="w-full max-w-sm rounded shadow">
                            </a>
                        </div>
                    @endif

                @else
                    <p class="text-gray-600">No payment record yet.</p>
                @endif

            </div>
        </div>

        <div class="mt-6">
            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST"
                  onsubmit="return confirm('Delete booking?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded">
                    Delete Booking
                </button>
            </form>
        </div>
    </div>
</x-admin-layout>
