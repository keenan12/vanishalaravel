<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// Pastikan Anda telah membuat Mailable ini
use App\Mail\ContactMessageMail; 

class ContactController extends Controller
{
    // Target email perusahaan Anda
    const COMPANY_EMAIL = 'masakamu62@gmail.com'; 

    public function send(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // 2. Kirim Email
        try {
            // Gunakan class Mailable yang akan kita buat
            Mail::to(self::COMPANY_EMAIL)->send(new ContactMessageMail($validated));

            // Jika berhasil
            return redirect()->back()->with('success', 'Pesan Anda telah berhasil terkirim. Kami akan segera merespon!');
            
        } catch (\Exception $e) {
            // Jika gagal (perlu konfigurasi .env untuk mail)
            // Log::error($e->getMessage()); // Jika perlu debugging
            return redirect()->back()->with('error', 'Pesan gagal dikirim. Silakan coba lagi nanti atau hubungi melalui telepon.');
        }
    }
}