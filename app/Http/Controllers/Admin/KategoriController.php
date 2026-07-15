<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::withCount('barang')
            ->when($request->filled('cari'), fn ($query) => $query->where('nama_kategori', 'like', '%' . $request->cari . '%'))
            ->orderBy('nama_kategori')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:kategoris,nama_kategori'],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        Kategori::create($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255', 'unique:kategoris,nama_kategori,' . $kategori->id],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->barang()->exists()) {
            return back()->with('error', 'Kategori "' . $kategori->nama_kategori . '" tidak dapat dihapus karena masih memiliki produk di dalamnya. Pindahkan atau hapus produk tersebut terlebih dahulu.');
        }

        try {
            $kategori->delete();
        } catch (QueryException) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh data lain.');
        }

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
