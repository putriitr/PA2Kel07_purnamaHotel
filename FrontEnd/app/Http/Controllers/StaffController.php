<?php

namespace App\Http\Controllers;
use File;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $staffs = Staff::All();
        return view('admin.staff.index')->with('staffs', $staffs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alert = [
            'name' => 'required|string|max:255',
            'role' => 'required',
            'last_education' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ];
        $message = [
            'name.required' => 'Kolom Nama Tidak Boleh Kosong',
            'role.required' => 'Kolom Role Tidak Boleh Kosong',
            'description.required' => 'description Harus Di Isi',
            'image.required' => 'Image Harus Di Isi',
            'image.mimes' => 'Harus Berupa JPG,PNG,JPEG',
        ];
        $this->validate($request, $alert, $message);
        $file = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/staff'),$file);

        $staffs = new Staff;

        $staffs->name = $request->name;
        $staffs->role = $request->role;
        $staffs->last_education = $request->last_education;
        $staffs->image = $file;

        $staffs->save();
        return redirect('/admin/staff')->with('flash_message', 'Data Sudah Ditambah!');
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
        return view('admin.staff.edit')->with([
            'staffs' => Staff::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'last_education' => 'required',
            'image' => 'required',
        ]);

        $staffs = Staff::find($id);
        if ($request->has('image')) {
            $path = 'images/staff/';
            File::delete($path.$staffs->image);
            $file = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images/staff'), $file);

            $staffs->image = $file;
            $staffs->save();
        }

        $staffs->name = $request['name'];
        $staffs->role = $request['role'];
        $staffs->last_education = $request['last_education'];
        $staffs->update();

        return redirect()->route('staff.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staffs = Staff::find($id);
        $path = 'images/staff/';
        File::delete($path.$staffs->image);
        $staffs->delete();
        return redirect()->route('staff.index')->with('success', 'Data Berhasil Dihapus');
    }
}
