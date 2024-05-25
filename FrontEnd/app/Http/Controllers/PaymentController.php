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
        $request->validate([
            'payment_method' => 'required',
            'proof_of_payment' => 'required|image|max:2048',
        ]);

        // Simpan file bukti pembayaran ke direktori public/images/payment
        $proofOfPaymentFile = time() . '.' . $request->file('proof_of_payment')->getClientOriginalExtension();
        $request->file('proof_of_payment')->move(public_path('images/payment'), $proofOfPaymentFile);

        // Temukan booking berdasarkan ID yang diberikan
        $booking = Booking::findOrFail($request->booking_id);

        // Hitung total pembayaran berdasarkan harga kamar dan durasi booking
        $checkinDate = new \DateTime($booking->checkin_date);
        $checkoutDate = new \DateTime($booking->checkout_date);
        $interval = $checkinDate->diff($checkoutDate);
        $days = $interval->days;
        $totalAmount = $booking->room->price * $days;

        // Buat entri pembayaran baru
        Payment::create([
            'booking_id' => $booking->id,
            'payment_method' => $request->payment_method,
            'proof_of_payment' => $proofOfPaymentFile,
            'amount' => $totalAmount,
        ]);

        // Redirect kembali ke halaman pembayaran dengan pesan sukses
        return redirect()->route('payment.form', ['bookingId' => $request->booking_id])->with('success', 'Payment processed successfully!');
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

        // Decrease room availability
        $room = $booking->room;
        if ($room->available > 0) {
            $room->available -= 1;
            $room->save();
        }

        // Schedule a job to increase availability after checkout
        $checkoutDate = Carbon::parse($booking->checkout_date);
        $this->scheduleRoomAvailabilityUpdate($room, $checkoutDate);

        return redirect()->route('admin.payments.index')->with('success', 'Payment and booking approved successfully.');
    }

    private function scheduleRoomAvailabilityUpdate(Room $room, Carbon $checkoutDate)
    {
        // Use Laravel's job scheduling to update room availability after checkout
        RoomAvailabilityUpdateJob::dispatch($room->id)->delay($checkoutDate->addDay());
    }

    public function reject($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        $payment->status = 'rejected';
        $payment->save();

        return redirect()->route('admin.payments.index')->with('success', 'Payment rejected successfully.');
    }
}

