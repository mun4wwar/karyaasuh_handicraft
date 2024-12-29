<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Fungsi untuk logout
    public function logout(Request $request)
    {
        Auth::logout(); // Menghapus sesi pengguna
        $request->session()->invalidate(); // Menghapus data sesi
        $request->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect('/'); // Kembali ke halaman landing
    }
}
