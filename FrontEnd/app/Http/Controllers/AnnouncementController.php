<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use Illuminate\Http\Request;
use File;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('category')->get();
        return view('admin.announcement.index', compact('announcements'));
    }

    public function create()
    {
        $categories = AnnouncementCategory::all();
        return view('admin.announcement.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $alert = [
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:announcementcategories,id', // Correct table name
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ];
        $message = [
            'title.required' => 'Kolom Judul Tidak Boleh Kosong',
            'content.required' => 'Kolom Isi Pengumuman Harus Di Pilih',
            'category_id.required' => 'Kategori Harus Di Pilih',
            'image.required' => 'Image Harus Di Isi',
            'image.mimes' => 'Harus Berupa JPG,PNG,JPEG',
        ];

        $this->validate($request, $alert, $message);

        $file = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/announcement'), $file);

        $announcement = new Announcement;
        $announcement->title = $request->title;
        $announcement->content = $request->content;
        $announcement->category_id = $request->category_id;
        $announcement->image = $file;
        $announcement->save();

        return redirect()->route('announcement.index')->with('success', 'Announcement created successfully.');
    }

    public function edit($id)
    {
        $announcement = Announcement::find($id);
        $categories = AnnouncementCategory::all(); // Use the correct model
        return view('admin.announcement.edit', compact('announcement', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:announcementcategories,id', // Correct table name
            'image' => 'sometimes|image|mimes:jpg,png,jpeg', // Image validation
        ]);

        $announcement = Announcement::find($id);

        if ($request->hasFile('image')) {
            $path = 'images/announcement/';
            // Delete the old image
            if (File::exists($path . $announcement->image)) {
                File::delete($path . $announcement->image);
            }
            $file = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/announcement'), $file);
            $announcement->image = $file;
        }

        $announcement->title = $request->title;
        $announcement->content = $request->content;
        $announcement->category_id = $request->category_id;
        $announcement->save();

        return redirect()->route('announcement.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::find($id);
        $path = 'images/announcement/';
        if (File::exists($path . $announcement->image)) {
            File::delete($path . $announcement->image);
        }
        $announcement->delete();

        return redirect()->route('announcement.index')->with('success', 'Announcement deleted successfully.');
    }
}
