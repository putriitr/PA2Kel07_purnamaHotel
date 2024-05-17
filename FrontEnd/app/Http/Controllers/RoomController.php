<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use File;

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
            'price' => 'required',
            'facility' => 'required',
            'capacity' => 'required',
            'room_category_id' => 'required|exists:roomcategories,id',
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ]);

        $file = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/rooms'), $file);

        $room = new Room;
        $room->name = $request->name;
        $room->price = $request->price;
        $room->facility = $request->facility;
        $room->capacity = $request->capacity;
        $room->room_category_id = $request->room_category_id;
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
            'price' => 'required',
            'facility' => 'required',
            'capacity' => 'required',
            'room_category_id' => 'required|exists:roomcategories,id',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg',
        ]);

        $room = Room::find($id);

        if ($request->hasFile('image')) {
            $path = 'images/rooms/';
            if (File::exists($path . $room->image)) {
                File::delete($path . $room->image);
            }
            $file = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/rooms'), $file);
            $room->image = $file;
        }

        $room->name = $request->name;
        $room->price = $request->price;
        $room->facility = $request->facility;
        $room->capacity = $request->capacity;
        $room->room_category_id = $request->room_category_id;
        $room->save();

        return redirect()->route('room.index')->with('success', 'Room updated successfully.');
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $path = 'images/rooms/';
        if (File::exists($path . $room->image)) {
            File::delete($path . $room->image);
        }
        $room->delete();

        return redirect()->route('room.index')->with('success', 'Room deleted successfully.');
    }
}
