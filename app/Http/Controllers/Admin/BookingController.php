<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'booth.event', 'payment'])->latest()->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show booking detail.
     */
    public function show(Booking $booking)
    {
        $booking->load(['user', 'booth.event', 'payment']);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * ADMIN CONFIRMS PAYMENT
     * booking.status      => Approved
     * payment.payment_status => Paid
     * booth.status        => Booked (tetap)
     */
    public function confirmPayment(Booking $booking)
    {
        $payment = $booking->payment;

        if (!$payment) {
            return back()->with('error', 'Payment record not found.');
        }

        // Update payment
        $payment->payment_status = 'Paid';
        $payment->save();

        // Update booking
        $booking->status = 'Approved';
        $booking->save();

        // Booth tetap BOOKED

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('success', 'Payment approved — booking marked as Approved.');
    }

    /**
     * ADMIN REJECTS PAYMENT
     * booking.status      => Rejected
     * payment.payment_status => Rejected
     * booth.status        => Available (dibuka lagi)
     */
    public function rejectPayment(Booking $booking)
    {
        $payment = $booking->payment;

        if (!$payment) {
            return back()->with('error', 'Payment record not found.');
        }

        // Update payment
        $payment->payment_status = 'Rejected';
        $payment->save();

        // Update booking
        $booking->status = 'Rejected';
        $booking->save();

        // Open the booth again
        if ($booking->booth) {
            $booking->booth->status = 'available';
            $booking->booth->save();
        }

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('success', 'Payment rejected — booth is now available.');
    }

    /**
     * Soft delete booking.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking deleted.');
    }
}
