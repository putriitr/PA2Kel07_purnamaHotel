<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email',
                'password' => 'required'
            ];
            $messages = [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Masukkan email yang valid',
                'password.required' => 'Masukkan Password'
            ];
            $this->validate($request, $rules, $messages);

            if (Auth::guard('customers')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect()->route('customer.home');
            } else {
                return redirect()->back()->with('error', 'Email atau Password tidak sesuai');
            }
        }
        return view('layout.autentikasi');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:customers,email',
                'password' => 'required|min:8|confirmed',
            ];
            $messages = [
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Masukkan email yang valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Masukkan Password',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Password dan konfirmasi password harus sesuai',
            ];
            $this->validate($request, $rules, $messages);

            Customer::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->route('customer.login')->with('success', 'Akun berhasil terdaftar. Silakan login.');
        }
        return view('layout.autentikasi');
    }

    public function logout(Request $request)
    {
        Auth::guard('customers')->logout();
        return redirect('/');
    }

    public function home()
    {
        return view('layout.home');
    }

    public function booking($roomId)
    {
        $room = Room::findOrFail($roomId);

        return view('layout.booking', compact('room'));
    }
}
