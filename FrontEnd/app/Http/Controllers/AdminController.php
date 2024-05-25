<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $alert = [
                'email' => 'required|email',
                'password' => 'required'
            ];
            $message = [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Masukkan email yang valid',
                'password' => 'Masukkan Password'
            ];
            $this->validate($request, $alert, $message);
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Tidak Sesuai');
            }
        }
        return view('admin.login.login');

    }

    public function dashboard()
    {
        // $total_berita = News::count();

        // $total_structure = Structure::count();

        // $total_galery = Galery::count();

        // $total_pengumuman = Pengumuman::count();

        return view(
            'admin.dashboard.index',
            // compact(
            //     'total_berita',
            //     'total_structure',
            //     'total_galery',
            //     'total_pengumuman'
            // )
        );
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function showPayments()
    {
        // Ambil semua data pembayaran beserta detail booking dan kamar
        $payments = Payment::with('booking.room')->get();

        // Kirim data ke view
        return view('admin.booking.index', compact('payments'));
    }
}


