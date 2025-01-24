@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <h3>Edit Produk</h3>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="NamaProduk">Nama Produk</label>
                        <input type="text" name="NamaProduk" id="NamaProduk" class="form-control"
                            value="{{ $produk->NamaProduk }}" required>
                    </div>
                    <div class="form-group">
                        <label for="Harga">Harga</label>
                        <input type="number" name="Harga" id="Harga" class="form-control"
                            value="{{ $produk->Harga }}" required>
                    </div>
                    <div class="form-group">
                        <label for="Stok">Stok</label>
                        <input type="number" name="Stok" id="Stok" class="form-control"
                            value="{{ $produk->Stok }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
