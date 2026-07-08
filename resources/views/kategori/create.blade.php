
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Tambah Kategori</h2>
            <p class="text-gray-500 text-sm">Buat kategori baru untuk produk atau artikel Anda.</p>
        </div>

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama_kategori" class="block text-gray-700 text-sm font-semibold mb-2">Nama Kategori</label>
                <input 
                    type="text" 
                    id="nama_kategori" 
                    name="nama_kategori" 
                    value="{{ old('nama_kategori') }}" 
                    class="w-full px-3 py-2 border @error('nama_kategori') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Contoh: Elektronik, Pakaian, Makanan"
                >

                @error('nama_kategori')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('kategori.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 px-4 rounded transition duration-200 text-sm">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-200 text-sm">
                    Simpan Kategori
                </button>
            </div>
        </form>

    </div>

</body>
</html>
