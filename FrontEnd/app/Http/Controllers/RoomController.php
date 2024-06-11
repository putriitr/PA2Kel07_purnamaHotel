<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Auth;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('category')->get();
        return view('admin.room.index', compact('rooms'));
    }

    public function create()
    {
        $categories = RoomCategory::all();
        return view('admin.room.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'facility' => 'required|string',
            'capacity' => 'required|integer',
            'room_number' => 'required',
            'size' => 'required|integer',
            'room_category_id' => 'required|exists:roomcategories,id',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $adminId = Auth::guard('admin')->id();
        if (!$adminId) {
            return redirect()->route('room.create')->with('error', 'Anda harus login sebagai admin.');
        }

        $file = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/rooms'), $file);

        $room = new Room;
        $room->name = $request->name;
        $room->price = $request->price;
        $room->facility = $request->facility;
        $room->capacity = $request->capacity;
        $room->room_number = $request->room_number;
        $room->size = $request->size;
        $room->room_category_id = $request->room_category_id;
        $room->image = $file;
        $room->admin_id = $adminId; // Set admin_id dengan ID admin yang sedang login
        $room->created_by = $adminId;
        $room->updated_by = $adminId;
        $room->save();

        return redirect()->route('room.index')->with('success', 'Room created successfully.');
    }

    public function edit($id)
    {
        $room = Room::find($id);
        $categories = RoomCategory::all();
        return view('admin.room.edit', compact('room', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'facility' => 'required|string',
            'capacity' => 'required|integer',
            'room_number' => 'required',
            'size' => 'required|integer',
            'room_category_id' => 'required|exists:roomcategories,id',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $room = Room::findOrFail($id);

        if ($request->hasFile('image')) {
            $path = public_path('images/rooms/');
            if (File::exists($path . $room->image)) {
                File::delete($path . $room->image);
            }
            $file = time() . '.' . $request->image->extension();
            $request->image->move($path, $file);
            $room->image = $file;
        }

        $room->name = $request->name;
        $room->price = $request->price;
        $room->facility = $request->facility;
        $room->capacity = $request->capacity;
        $room->room_number = $request->room_number;
        $room->size = $request->size;
        $room->room_category_id = $request->room_category_id;
        $room->save();

        return redirect()->route('room.index')->with('success', 'Room updated successfully.');
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $path = public_path('images/rooms/');
        if (File::exists($path . $room->image)) {
            File::delete($path . $room->image);
        }
        $room->delete();

        return redirect()->route('room.index')->with('success', 'Room deleted successfully.');
    }

    public function review(Request $request, $roomId)
    {
        // Validasi autentikasi
        if (!Auth::check()) {
            return redirect()->route('login');
        } elseif (Auth::check()) {
            // Validasi data ulasan
            $request->validate([
                'rating' => 'required|integer|between:1,5',
                'comment' => 'nullable|string',
            ]);

            // Mendapatkan roomId dari permintaan
            $roomId = $request->roomId;

            $booking = Auth::user()->bookings()->where('room_id', $roomId)->where('checkout_date', '>', now())->first();
            if (!$booking) {
                return redirect()->back()->with('error', 'You can only leave a review for a room after your stay.');
            }

            $review = new Review;
            $review->user_id = Auth::id();
            $review->room_id = $roomId;
            $review->rating = $request->rating;
            $review->comment = $request->comment;
            $review->save();

            return redirect()->back()->with('success', 'Thank you for your review!');
        }
    }

    public function show($roomId)
    {
        $room = Room::findOrFail($roomId);
        $userHasBooked = false;

        if (Auth::check()) {
            $userHasBooked = Booking::where('room_id', $roomId)
                ->where('user_id', Auth::id())
                ->exists();
        }
        return view('room.details', compact('room', 'userHasBooked'));
    }
}
