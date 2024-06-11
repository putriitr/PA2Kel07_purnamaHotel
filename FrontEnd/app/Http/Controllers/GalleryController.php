<?php

namespace App\Http\Controllers;
use App\Models\GalleryCategory;
use File;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Auth;

class GalleryController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $galeries = Gallery::all();
        return view('admin.gallery.index', ['galeries' => $galeries]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = GalleryCategory::all();
        return view('admin.gallery.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alert = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:gallerycategories,id',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ];
        $message = [
            'name.required' => 'Kolom Nama Tidak Boleh Kosong',
            'category_id.required' => 'Kategori Harus Di Pilih',
            'description.required' => 'description Harus Di Pilih',
            'image.required' => 'Image Harus Di Isi',
            'image.mimes' => 'Harus Berupa JPG,PNG,JPEG',
        ];
        $this->validate($request, $alert, $message);

        $adminId = Auth::guard('admin')->id();
        if (!$adminId) {
            return redirect()->route('gallery.create')->with('error', 'Anda harus login sebagai admin.');
        }
        $file = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/gallery'),$file);

        $galeries = new Gallery;

        $galeries->name = $request->name;
        $galeries->category_id = $request->category_id;
        $galeries->admin_id = $adminId; // Set admin_id dengan ID admin yang sedang login
        $galeries->created_by = $adminId;
        $galeries->updated_by = $adminId;
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
        $galeries = Gallery::find($id);
        $categories = GalleryCategory::all(); // Use the correct model
        return view('admin.gallery.edit', compact('galeries', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:gallerycategories,id',
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
        $galeries->category_id = $request['category_id'];
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
