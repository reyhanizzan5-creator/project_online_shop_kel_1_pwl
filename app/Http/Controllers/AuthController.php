<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['username' => 'Username atau password yang Anda masukkan salah.'])
                ->onlyInput('username');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('pelanggan.dashboard');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'no_hp' => ['required', 'string', 'max:20', 'unique:pelanggans,no_hp'],
            'kode_pos' => ['required', 'string', 'max:10'],
            'alamat' => ['required', 'string', 'max:1000'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, strip, dan garis bawah (tanpa spasi).',
            'username.unique' => 'Username ini sudah digunakan, silakan pilih username lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.unique' => 'Nomor HP ini sudah terdaftar.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $pelanggan = Pelanggan::daftarkanAkun($data);

        Auth::login($pelanggan->user);
        $request->session()->regenerate();

        return redirect()->route('pelanggan.dashboard')
            ->with('success', 'Selamat datang, ' . $pelanggan->nama . '! Akun Anda berhasil dibuat.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
