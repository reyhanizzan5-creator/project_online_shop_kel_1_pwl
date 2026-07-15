<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function edit()
    {
        $pelanggan = Auth::user()->pelanggan;

        return view('pelanggan.profil.edit', compact('pelanggan'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        /** @var \App\Models\Pelanggan $pelanggan */
        $pelanggan = $user->pelanggan;

        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20', 'unique:pelanggans,no_hp,' . $pelanggan->id],
            'kode_pos' => ['required', 'string', 'max:10'],
            'alamat' => ['required', 'string', 'max:1000'],
            'password_baru' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.unique' => 'Nomor HP ini sudah digunakan akun lain.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'password_baru.min' => 'Password baru minimal 6 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password baru tidak sama.',
        ]);

        $pelanggan->update([
            'nama' => $data['nama'],
            'no_hp' => $data['no_hp'],
            'kode_pos' => $data['kode_pos'],
            'alamat' => $data['alamat'],
        ]);

        $user->update(['name' => $data['nama']]);

        if (! empty($data['password_baru'])) {
            $user->update(['password' => Hash::make($data['password_baru'])]);
        }

        return redirect()->route('pelanggan.profil.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
