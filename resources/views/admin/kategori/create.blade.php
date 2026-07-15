@extends('layout.admin')

@section('title', 'Tambah Kategori')
@section('breadcrumb', 'Kategori / Tambah Baru')

@section('content')
    <div class="card" style="max-width:520px;">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.kategori.store') }}">
                @csrf

                <div class="form-group">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror"
                           value="{{ old('nama_kategori') }}" placeholder="Contoh: Elektronik" autofocus required>
                    @error('nama_kategori') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="flex gap-sm" style="margin-top:20px;">
                    <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
