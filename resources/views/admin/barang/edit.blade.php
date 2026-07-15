@extends('layout.admin')

@section('title', 'Ubah Produk')
@section('breadcrumb', 'Produk / Ubah')

@section('content')
    <div class="card" style="max-width:680px;">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.barang.update', $barang) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.barang._form')
            </form>
        </div>
    </div>
@endsection
