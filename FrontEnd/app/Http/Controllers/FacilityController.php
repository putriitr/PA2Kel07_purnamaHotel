<?php

namespace App\Http\Controllers;
use File;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $facilities = Facility::All();
        return view('admin.facility.index')->with('facilities', $facilities);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.facility.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alert = [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'rent_price' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ];
        $message = [
            'name.required' => 'Kolom Nama Tidak Boleh Kosong',
            'description.required' => 'description Harus Di Pilih',
            'rent_price.required' => 'Harga Sewa Harus Di Isi',
            'image.required' => 'Image Harus Di Isi',
            'image.mimes' => 'Harus Berupa JPG,PNG,JPEG',
        ];
        $this->validate($request, $alert, $message);
        $file = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/facility'),$file);

        $facilities = new Facility;

        $facilities->name = $request->name;
        $facilities->description = $request->description;
        $facilities->rent_price = $request->rent_price;
        $facilities->image = $file;

        $facilities->save();
        return redirect('/admin/facility')->with('flash_message', 'Data Sudah Ditambah!');
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
        return view('admin.facility.edit')->with([
            'facilities' => Facility::find($id),
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
            'rent_price' => 'required',
            'image' => 'required',
        ]);

        $facilities = Facility::find($id);
        if ($request->has('image')) {
            $path = 'images/facility/';
            File::delete($path . $facilities->image);
            $file = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images/facility'), $file);

            $facilities->image = $file;
            $facilities->save();
        }

        $facilities->name = $request['name'];
        $facilities->description = $request['description'];
        $facilities->rent_price = $request['rent_price'];
        $facilities->update();

        return redirect()->route('facility.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facilities = Facility::find($id);
        $path = 'images/facility/';
        File::delete($path.$facilities->image);
        $facilities->delete();
        return redirect()->route('facility.index')->with('success', 'Data Berhasil Dihapus');
    }
}
