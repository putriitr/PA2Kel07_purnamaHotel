<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use Illuminate\Http\Request;

class GalleryCategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori pengumuman dari database
        $gallerycategories = galleryCategory::all();

        // Mengirimkan data ke view
        return view('admin.gallerycategory.index', compact('gallerycategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallerycategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alert = [
            'name' => 'required|string|max:255',
        ];
        $message = [
            'name.required' => 'Kolom nama Harus Di Isi',
        ];
        $this->validate($request, $alert, $message);

        $gallerycategory = new GalleryCategory;
        $gallerycategory->name = $request->name;
        $gallerycategory->save();

        return redirect('/admin/gallerycategory')->with('success', 'Pengumuman Sudah Ditambah');
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
        return view('admin.gallerycategory.edit')->with([
            'gallerycategory' => GalleryCategory::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate([
            'name' => 'required',
        ]);

        $gallerycategory = galleryCategory::find($id);
        $gallerycategory->name = $request->name;
        $gallerycategory->save();

        return redirect()->route('gallerycategory.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallerycategory = GalleryCategory::find($id);
        $gallerycategory->delete();

        return redirect('/admin/gallerycategory')->with('success', 'Data Berhasil Dihapus');
    }
}
