<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index(Request $request)
    {
       $barangs = Barang::with('kategori')
            ->cari($request->cari)
            ->when($request->filled('kategori_id'), fn ($query) => $query->where('kategori_id', $request->kategori_id))
            ->orderBy('nama_barang')
            ->paginate(10)
            ->withQueryString();

        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('admin.barang.index', compact('barangs', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('admin.barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->simpanGambar($request);
        }

        Barang::create($data);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('admin.barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, Barang $barang)
    {
        $data = $this->validasi($request);

        if ($request->hasFile('gambar')) {
            $this->hapusGambar($barang->gambar);
            $data['gambar'] = $this->simpanGambar($request);
        }

        $barang->update($data);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Barang $barang){
        $sudahPernahDipesan = $barang->keranjangs()
            ->whereHas('transaksi', fn ($query) => $query->where('status', '!=', 'keranjang'))
            ->exists();

        if ($sudahPernahDipesan) {
            return back()->with('error', 'Produk "' . $barang->nama_barang . '" tidak dapat dihapus karena sudah pernah dipesan pelanggan. Riwayat transaksi harus tetap utuh.');
        }

        $barang->keranjangs()->delete();
        $this->hapusGambar($barang->gambar);
        $barang->delete();

        return redirect()->route('admin.barang.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    private function validasi(Request $request){
        return $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'nama_barang.required' => 'Nama produk wajib diisi.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.integer' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok tidak boleh negatif.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);
    }

    private function simpanGambar(Request $request){
        $file = $request->file('gambar');
        $namaFile = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('images/barang'), $namaFile);

        return $namaFile;
    }

    private function hapusGambar(?string $namaFile){
        if ($namaFile && file_exists(public_path('images/barang/' . $namaFile))) {
            @unlink(public_path('images/barang/' . $namaFile));
        }
    }
}
