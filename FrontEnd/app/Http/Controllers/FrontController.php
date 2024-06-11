<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Booking;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Staff;
use App\Notifications\AnnouncementNotification;
use App\Notifications\ApprovePaymentNotification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class FrontController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan pelanggan yang sedang login
        $customer = Auth::guard('customers')->user();

        // Jika ada pelanggan yang login
        if ($customer) {
            // Mendapatkan semua pengumuman
            $announcements = Announcement::all();

            // Loop melalui setiap pengumuman
            foreach ($announcements as $announcement) {
                // Periksa apakah pelanggan sudah menerima notifikasi untuk pengumuman ini
                $existingNotification = $customer->notifications()
                    ->where('data->announcement_id', $announcement->id)
                    ->first();

                // Jika belum ada notifikasi, kirimkan notifikasi
                if (!$existingNotification) {
                    $notification = new AnnouncementNotification($announcement);
                    $customer->notify($notification);
                }
            }
        }

        if ($customer) {
            // Ambil semua pembayaran yang belum disetujui
            $unapprovedPayments = Payment::where('status', 'pending')->get();

            // Loop melalui setiap pembayaran yang belum disetujui
            foreach ($unapprovedPayments as $payment) {
                // Kirim notifikasi pembayaran disetujui
                $payment->status = 'approved'; // Ubah status pembayaran menjadi disetujui
                $payment->save();

                // Kirim notifikasi pembayaran disetujui ke pelanggan
                $paymentOwner = $payment->customer; // Anda harus menyesuaikan ini dengan relasi pada model Payment
                $paymentOwner->notify(new ApprovePaymentNotification($payment));
            }
        }


        // Tampilkan tampilan dashboard
        return view('layout.home');
    }


    public function gallery()
    {
        $buildingViews = Gallery::where('category_id', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        $restaurant = Gallery::where('category_id', 2)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        $outdoor = Gallery::where('category_id', 3)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        $spaAndSauna = Gallery::where('category_id', 4)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        $sports = Gallery::where('category_id', 5)
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('layout.gallery', compact('buildingViews', 'restaurant', 'outdoor', 'spaAndSauna', 'sports'));
    }

    public function facility()
    {
        $facilities = Facility::orderBy('created_at', 'desc')->get();
        return view('layout.facility', compact('facilities'));
    }

    public function announcement(Request $request)
{
    $announcements = Announcement::orderBy('created_at', 'desc')
                                  ->take(10)
                                  ->get();

    $announcementCategories = AnnouncementCategory::all();

    return view('layout.event', [
        'announcements' => $announcements,
        'announcementCategories' => $announcementCategories,
    ]);
}



    public function room(Request $request)
    {
        $currentDate = Carbon::now();

        // Retrieve rooms and their bookings
        $rooms = Room::with([
            'bookings' => function ($query) use ($currentDate) {
                $query->where('status', 'confirmed')
                    ->where('checkout_date', '>', $currentDate);
            }
        ])->get();

        $rooms->each(function ($room) use ($currentDate) {
            $room->is_booked = $room->bookings->contains(function ($booking) use ($currentDate) {
                return $booking->status == 'confirmed' && $booking->checkout_date > $currentDate;
            });
        });

        $roomCategories = RoomCategory::all();

        return view('layout.room', [
            'rooms' => $rooms,
            'roomCategories' => $roomCategories, // Correct variable name
        ]);
    }

    public function showroom($id)
    {
        $room = Room::with('bookings')->findOrFail($id);

        // Check if the room is booked
        $currentDate = Carbon::now();
        $isBooked = $room->bookings->where('status', 'confirmed')
            ->where('checkout_date', '>', $currentDate)
            ->isNotEmpty();

        return view('layout.roomdetails', compact('room', 'isBooked'));
    }

    public function booking($roomId)
    {
        $room = Room::findOrFail($roomId);

        return view('layout.booking', compact('room'));
    }
    public function staff()
    {
        $staffMembers = Staff::all(); // Assuming you have a Staff model
        return view('layout.staff', compact('staffMembers'));
    }

    public function showBookings()
    {
        $userId = Auth::guard('customers')->user()->id;
        $bookings = Booking::where('user_id', $userId)->with('payments')->get();
        foreach ($bookings as $booking) {
            error_log('Booking ID: ' . $booking->id);
            error_log('Is Paid: ' . $booking->isPaid());
        }
        return view('layout.history', compact('bookings'));
    }


}
