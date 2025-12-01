<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect ke halaman login Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google setelah login
     */
    public function handleGoogleCallback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // 1. Cari user berdasarkan google_id
            $user = User::where('google_id', $googleUser->getId())->first();

            // 2. Jika belum ada, cek berdasarkan email
            if (! $user) {
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    // Email sudah ada, link ke akun yang ada
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar'    => $googleUser->getAvatar(),
                    ]);
                } else {
                    // 3. Jika benar-benar user baru, buat akun baru
                    $user = User::create([
                        'name'      => $googleUser->getName(),
                        'email'     => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar'    => $googleUser->getAvatar(),
                        'role'      => 'user',
                        'password'  => null,
                    ]);

                    // Kirim email verifikasi ke user baru
                    $user->sendEmailVerificationNotification();
                }
            }

            // Login user
            Auth::login($user);

            // Jika email belum terverifikasi, arahkan ke halaman verifikasi
            if (! $user->hasVerifiedEmail()) {
                return redirect()->route('verification.notice');
            }

            // Jika sudah terverifikasi, lanjut ke halaman yang diminta/dasbor
            return redirect()->intended('/');

        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}
