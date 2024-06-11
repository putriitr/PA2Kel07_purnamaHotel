<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Auth;

class RoomCategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori ruangan dari database
        $roomcategories = RoomCategory::all();

        // Mengirimkan data ke view
        return view('admin.roomcategory.index', compact('roomcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roomcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alert = [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:20|max:400',
        ];
        $message = [
            'name.required' => 'Kolom Judul Harus Di Isi',
            'description.required' => 'Deskripsi Harus Di Isi',
            'description.min' => 'Deskripsi minimal 20 karakter',
            'description.max' => 'Deskripsi tidak boleh lebih dari 400 karakter'
        ];
        $this->validate($request, $alert, $message);

        $adminId = Auth::guard('admin')->id();
        if (!$adminId) {
            return redirect('/admin/roomcategory')->with('error', 'Anda harus login sebagai admin.');
        }

        $roomcategory = new RoomCategory;
        $roomcategory->name = $request->name;
        $roomcategory->description = $request->description;
        $roomcategory->admin_id = $adminId;
        $roomcategory->created_by = $adminId;
        $roomcategory->updated_by = $adminId;
        $roomcategory->save();

        return redirect('/admin/roomcategory')->with('success', 'Kategori ruangan sudah ditambah.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.roomcategory.edit')->with([
            'roomcategory' => RoomCategory::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:20|max:400',
        ], [
            'name.required' => 'Kolom Judul Harus Di Isi',
            'description.required' => 'Deskripsi Harus Di Isi',
            'description.min' => 'Deskripsi minimal 20 karakter',
            'description.max' => 'Deskripsi tidak boleh lebih dari 400 karakter'
        ]);

        $roomcategory = RoomCategory::find($id);
        if (!$roomcategory) {
            return redirect()->route('roomcategory.index')->with('error', 'Data tidak ditemukan.');
        }
        $roomcategory->name = $request->name;
        $roomcategory->description = $request->description;
        $roomcategory->save();

        return redirect()->route('roomcategory.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roomcategory = RoomCategory::find($id);
        if (!$roomcategory) {
            return redirect('/admin/roomcategory')->with('error', 'Data tidak ditemukan.');
        }
        $roomcategory->delete();

        return redirect('/admin/roomcategory')->with('success', 'Data berhasil dihapus.');
    }
}
