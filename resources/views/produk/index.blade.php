@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Produk</h4>
                    <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk.index') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Produk..."
                                   value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            @if(request('search'))
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Reset</a>
                            @endif
                        </div>
                    </form>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produks as $produk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $produk->NamaProduk }}</td>
                                <td>Rp {{ number_format($produk->Harga, 0, ',', '.') }}</td>
                                <td>{{ $produk->Stok }}</td>
                                <td>
                                    <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Produk tidak ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
