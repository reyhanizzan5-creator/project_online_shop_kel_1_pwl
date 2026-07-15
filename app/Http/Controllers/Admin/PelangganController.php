<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $pelanggans = Pelanggan::with('user')
            ->withCount(['transaksis as jumlah_transaksi' => fn ($query) => $query->where('status', '!=', 'keranjang')])
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->cari . '%')
                    ->orWhereHas('user', fn ($q) => $q->where('username', 'like', '%' . $request->cari . '%'));
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'no_hp' => ['required', 'string', 'max:20', 'unique:pelanggans,no_hp'],
            'kode_pos' => ['required', 'string', 'max:10'],
            'alamat' => ['required', 'string', 'max:1000'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.alpha_dash' => 'Username hanya boleh huruf, angka, strip, dan garis bawah.',
            'username.unique' => 'Username ini sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.unique' => 'Nomor HP ini sudah terdaftar.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        Pelanggan::daftarkanAkun($data);

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20', 'unique:pelanggans,no_hp,' . $pelanggan->id],
            'kode_pos' => ['required', 'string', 'max:10'],
            'alamat' => ['required', 'string', 'max:1000'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.unique' => 'Nomor HP ini sudah terdaftar.',
            'kode_pos.required' => 'Kode pos wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        $pelanggan->update($data);

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $punyaRiwayat = $pelanggan->transaksis()->where('status', '!=', 'keranjang')->exists();

        if ($punyaRiwayat) {
            return back()->with('error', 'Pelanggan "' . $pelanggan->nama . '" tidak dapat dihapus karena memiliki riwayat transaksi.');
        }

        if ($pelanggan->user) {
            $pelanggan->user->delete();
        } else {
            $pelanggan->delete();
        }

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }
}
