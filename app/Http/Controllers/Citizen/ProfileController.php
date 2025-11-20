<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Menampilkan form ubah password.
     */
    public function editPassword()
    {
        return view('citizen.profile.password');
    }

    /**
     * Memproses perubahan password.
     */
    public function updatePassword(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed', // 'confirmed' akan mengecek field 'new_password_confirmation'
        ], [
            'new_password.min' => 'Password baru minimal 6 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        // 2. Cek apakah password lama benar
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama yang Anda masukkan salah.']);
        }

        // 3. Update Password
        $user->password = Hash::make($request->new_password);
        $user->save(); // Simpan ke tabel_users

        return Redirect::route('warga.dashboard')->with('success', 'Password berhasil diubah! Silakan gunakan password baru saat login berikutnya.');
    }
}