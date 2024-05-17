<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomCategory;

class RoomCategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori pengumuman dari database
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

        $roomcategories = new RoomCategory;
        $roomcategories->name = $request->name;
        $roomcategories->description = $request->description;
        $roomcategories->save();

        return redirect('/admin/roomcategory')->with('success', 'Pengumuman Sudah Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.roomcategory.edit')->with([
            'roomcategories' => RoomCategory::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $roomcategories = RoomCategory::find($id);
        $roomcategories->name = $request->name;
        $roomcategories->description = $request->description;
        $roomcategories->save();

        return redirect()->route('roomcategory.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roomcategories = RoomCategory::find($id);
        $roomcategories->delete();

        return redirect('/admin/roomcategory')->with('success', 'Data Berhasil Dihapus');
    }
}
