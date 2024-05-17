<?php

namespace App\Http\Controllers;
use File;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $galeries = Gallery::All();
        return view('admin.gallery.index')->with('galeries', $galeries);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alert = [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ];
        $message = [
            'name.required' => 'Kolom Nama Tidak Boleh Kosong',
            'description.required' => 'description Harus Di Pilih',
            'image.required' => 'Image Harus Di Isi',
            'image.mimes' => 'Harus Berupa JPG,PNG,JPEG',
        ];
        $this->validate($request, $alert, $message);
        $file = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/gallery'),$file);

        $galeries = new Gallery;

        $galeries->name = $request->name;
        $galeries->description = $request->description;
        $galeries->image = $file;

        $galeries->save();
        return redirect('/admin/gallery')->with('flash_message', 'Data Sudah Ditambah!');
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
        return view('admin.gallery.edit')->with([
            'galeries' => Gallery::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $galeries = Gallery::find($id);
        if ($request->has('image')) {
            $path = 'images/gallery/';
            File::delete($path.$galeries->image);
            $file = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images/gallery'), $file);

            $galeries->image = $file;
            $galeries->save();
        }

        $galeries->name = $request['name'];
        $galeries->description = $request['description'];
        $galeries->update();

        return redirect()->route('gallery.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galeries = Gallery::find($id);
        $path = 'images/gallery/';
        File::delete($path.$galeries->image);
        $galeries->delete();
        return redirect()->route('gallery.index')->with('success', 'Data Berhasil Dihapus');
    }
}
