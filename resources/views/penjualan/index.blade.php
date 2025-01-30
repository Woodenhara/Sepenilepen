@extends('layouts.app')

@section('title', 'Daftar Penjualan')

@section('content')
<div class="page-heading">
    <h3>Daftar Penjualan</h3>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section class="section">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Penjualan</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualans as $penjualan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penjualan->pelanggan->NamaPelanggan }}</td>
                        <td>{{ $penjualan->TanggalPenjualan }}</td>
                        <td>{{ number_format($penjualan->TotalHarga, 2) }}</td>
                        <td>
                            <a href="{{ route('penjualan.show', $penjualan->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
