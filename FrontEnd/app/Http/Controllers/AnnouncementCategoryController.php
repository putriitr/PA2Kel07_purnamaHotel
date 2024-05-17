<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnnouncementCategory;

class AnnouncementCategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori pengumuman dari database
        $announcementcategories = AnnouncementCategory::all();

        // Mengirimkan data ke view
        return view('admin.announcementcategory.index', compact('announcementcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcementcategory.create');
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
            'description.required' => 'Isi Pengumuman Harus Di Isi',
            'description.min' => 'Isi Pengumuman minimal 20 karakter',
            'description.max' => 'Isi Pengumuman tidak boleh lebih dari 400 karakter'
        ];
        $this->validate($request, $alert, $message);

        $announcementcategory = new AnnouncementCategory;
        $announcementcategory->name = $request->name;
        $announcementcategory->description = $request->description;
        $announcementcategory->save();

        return redirect('/admin/announcementcategory')->with('success', 'Pengumuman Sudah Ditambah');
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
        return view('admin.announcementcategory.edit')->with([
            'announcementcategory' => AnnouncementCategory::find($id),
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

        $announcementcategory = AnnouncementCategory::find($id);
        $announcementcategory->name = $request->name;
        $announcementcategory->description = $request->description;
        $announcementcategory->save();

        return redirect()->route('announcementcategory.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announcementcategory = AnnouncementCategory::find($id);
        $announcementcategory->delete();

        return redirect('/admin/announcementcategory')->with('success', 'Data Berhasil Dihapus');
    }
}
