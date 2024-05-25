<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Staff;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function dashboard()
    {
        $staffs = Staff::orderBy('created_at', 'desc')->get();
        return view('layout.home', compact('staffs'));
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
        $announcements = Announcement::all();

        $announcementCategories = AnnouncementCategory::all();

        return view('layout.event', [
            'announcements' => $announcements,
            'announcementCategories' => $announcementCategories,
        ]);
    }

    public function room(Request $request)
    {
        $rooms = Room::all();

        $roomCategories = RoomCategory::all();

        return view('layout.room', [
            'rooms' => $rooms,
            'roomCategories' => $roomCategories,
        ]);
    }
    public function booking($roomId)
    {
        $room = Room::findOrFail($roomId);

        return view('layout.booking', compact('room'));
    }
    public function staff()
    {
        $staffs = Staff::all();
        return view('layout.home', compact('staffs'));
    }

}
