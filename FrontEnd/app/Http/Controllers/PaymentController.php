<?php

namespace App\Http\Controllers;

use App\Jobs\RoomAvailabilityUpdateJob;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function showPaymentForm($bookingId)
    {
        $booking = Booking::with('room')->findOrFail($bookingId);
        return view('layout.payment', compact('booking'));
    }

    public function processPayment(Request $request)
    {
        $paymentAmount = $request->input('total_amount');
        $request->validate([
            'payment_method' => 'required',
            'proof_of_payment' => 'required|image|max:2048',
        ]);

        // Save proof of payment file
        $proofOfPaymentFile = time() . '.' . $request->file('proof_of_payment')->getClientOriginalExtension();
        $request->file('proof_of_payment')->move(public_path('images/payment'), $proofOfPaymentFile);

        // Find the booking
        $booking = Booking::findOrFail($request->booking_id);

        // Create a new payment entry
        Payment::create([
            'booking_id' => $booking->id,
            'payment_method' => $request->payment_method,
            'proof_of_payment' => $proofOfPaymentFile,
            'amount' => $paymentAmount,
            'paid' => true,
        ]);

        // Redirect to bookings page with success message
        return redirect()->route('user.bookings')->with('success', 'Pembayaran berhasil diproses! Menunggu konfirmasi dari admin.');
    }

    public function approve($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $payment->status = 'approved';
        $payment->save();

        // Update booking status to confirmed
        $booking = $payment->booking;
        $booking->status = 'confirmed';
        $booking->save();

        return redirect()->route('admin.payments')->with('success', 'Payment and booking approved successfully.');
    }

    public function reject($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $payment->status = 'rejected';
        $payment->save();

        return redirect()->route('admin.payments')->with('success', 'Payment rejected successfully.');
    }
}
