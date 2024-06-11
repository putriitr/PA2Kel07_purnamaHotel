<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the bookings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with('user', 'room')->get();
        return response()->json($bookings);
    }

    /**
     * Store a newly created booking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'number_of_guests' => 'required|integer|min:1',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
        ];

        // Custom error messages
        $messages = [
            'first_name.required' => 'Silahkan isi Kolom Nama',
            'last_name.required' => 'Silahkan isi Kolom Nama',
            'email.required' => 'Silahkan isi Kolom Email',
            'phone.required' => 'Silahkan isi Kolom Phone',
            'room_id.required' => 'Silahkan pilih Kamar',
            'room_id.exists' => 'Kamar yang dipilih tidak valid',
            'number_of_guests.required' => 'Silahkan isi Kolom Jumlah Tamu',
            'number_of_guests.integer' => 'Jumlah Tamu harus berupa angka',
            'number_of_guests.min' => 'Jumlah Tamu minimal 1',
            'checkin_date.required' => 'Silahkan isi Kolom Tanggal Checkin',
            'checkin_date.after_or_equal' => 'Tanggal Checkin tidak boleh sebelum hari ini',
            'checkout_date.required' => 'Silahkan isi Kolom Tanggal Checkout',
            'checkout_date.after' => 'Tanggal Checkout harus setelah Tanggal Checkin',
        ];

        // Validate request
        $request->validate($rules, $messages);

        // Check if the room is already booked for the selected dates
        $existingBooking = Booking::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('checkin_date', [$request->checkin_date, $request->checkout_date])
                    ->orWhereBetween('checkout_date', [$request->checkin_date, $request->checkout_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('checkin_date', '<=', $request->checkin_date)
                            ->where('checkout_date', '>=', $request->checkout_date);
                    });
            })
            ->where('status', '!=', 'cancelled') // tambahan kondisi untuk memeriksa status bukan cancel
            ->exists();

        if ($existingBooking) {
            return redirect()->back()->withErrors(['room_id' => 'Kamar ini sudah dipesan pada tanggal yang dipilih. Silahkan pilih tanggal lain atau kamar lain.'])->withInput();
        }

        // Check if the number of guests exceeds the room capacity
        $room = Room::findOrFail($request->room_id);
        if ($request->number_of_guests > $room->capacity) {
            return redirect()->back()->withErrors(['number_of_guests' => 'Jumlah tamu melebihi kapasitas kamar yang dipilih. Kapasitas kamar adalah ' . $room->capacity . ' tamu.'])->withInput();
        }

        // Create new booking
        $booking = new Booking;
        $booking->user_id = Auth::guard('customers')->user()->id;
        $booking->first_name = $request->first_name;
        $booking->last_name = $request->last_name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->room_id = $request->room_id;
        $booking->number_of_guests = $request->number_of_guests;
        $booking->checkin_date = $request->checkin_date;
        $booking->checkout_date = $request->checkout_date;
        $booking->save();

        // Redirect to payment form
        return redirect()->route('payment.form', ['bookingId' => $booking->id]);
    }



    public function cancel($bookingId)
    {

        $booking = Booking::find($bookingId);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }

}
