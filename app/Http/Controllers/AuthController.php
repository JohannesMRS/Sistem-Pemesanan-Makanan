<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        // Gunakan huruf kecil 'role' sesuai attributes Oracle tadi
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user()->role);
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {


        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi, Partner!',
            'password.required' => 'Password jangan lupa diisi ya.',
        ]);

        // Gunakan 'username' kecil sesuai attributes Oracle tadi
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // return redirect('/admin/dashboard');

            // Redirect pakai role (huruf kecil sesuai temuan)
            return $this->redirectBasedOnRole(Auth::user()->role);
        }

        return back()->withErrors([
            'loginError' => 'Gagal login. Cek apakah password sudah di-hash atau username benar.',
        ])->withInput();
    }

    private function redirectBasedOnRole($role)
    {
        // Paksa ke Uppercase agar aman dicocokkan
        $roleUpper = strtoupper($role);

        switch ($roleUpper) {
            case 'ADMIN':
                return redirect()->intended('/admin/dashboard');
            case 'KASIR':
                return redirect()->intended('/kasir/PointOfSales');
            default:
                // Jika lari ke sini, berarti login sukses tapi role tidak dikenali
                return redirect()->intended('/admin/dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout!');
    }
}
