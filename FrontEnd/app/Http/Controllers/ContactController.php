<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('layout.contact', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Your message has been sent successfully!');
    }

    public function showMessage()
    {
        $messages = Contact::all(); // Ambil semua pesan
        return view('admin.message.index', compact('messages'));
    }

    public function reply(Request $request, $id)
    {
        // Validasi input pesan balasan
        $request->validate([
            'reply_message' => 'required|string|max:255',
        ]);

        // Temukan pesan berdasarkan ID
        $message = Contact::findOrFail($id);

        // Simpan pesan balasan
        $reply = new Contact();
        $reply->name = 'Admin'; // Atur pengirim pesan sebagai 'Admin'
        $reply->email = 'admin@example.com'; // Ganti dengan email admin yang sesuai
        $reply->message = $request->reply_message;
        $reply->parent_id = $message->id; // Atur ID pesan asli sebagai parent_id
        $reply->save();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Pesan balasan berhasil dikirim!');
    }
}
