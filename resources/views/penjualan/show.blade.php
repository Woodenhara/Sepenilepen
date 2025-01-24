@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
<div class="page-heading">
    <h3>Detail Penjualan</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5>Data Pelanggan</h5>
            <p>Nama: {{ $penjualan->pelanggan->NamaPelanggan }}</p>
            <p>Alamat: {{ $penjualan->pelanggan->Alamat }}</p>
            <p>Nomor Telepon: {{ $penjualan->pelanggan->NomorTelepon }}</p>

            <h5>Data Penjualan</h5>
            <p>Tanggal: {{ $penjualan->TanggalPenjualan }}</p>
            <p>Total Harga: {{ number_format($penjualan->TotalHarga, 2) }}</p>

            <h5>Detail Produk</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penjualan->details as $detail)
                    <tr>
                        <td>{{ $detail->produk->NamaProduk }}</td>
                        <td>{{ number_format($detail->produk->Harga, 2) }}</td>
                        <td>{{ $detail->JumlahProduk }}</td>
                        <td>{{ number_format($detail->SubTotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</section>
@endsection
