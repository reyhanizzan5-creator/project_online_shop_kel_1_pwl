@extends('layout.admin')

@section('title', 'Tambah Produk')
@section('breadcrumb', 'Produk / Tambah Baru')

@section('content')
    <div class="card" style="max-width:680px;">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.barang.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.barang._form')
            </form>
        </div>
    </div>
@endsection
