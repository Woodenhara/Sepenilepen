@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body text-center">
                    <h6>Total Penjualan</h6>
                    <h4 class="font-weight-bold text-primary">Rp {{ number_format($totalPenjualan, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body text-center">
                    <h6>Total Produk</h6>
                    <h4 class="font-weight-bold text-success">{{ $totalProduk }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body text-center">
                    <h6>Total Pelanggan</h6>
                    <h4 class="font-weight-bold text-info">{{ $totalPelanggan }}</h4>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mt-5">Daftar Produk</h4>
    <div class="row">
        @foreach ($produks as $produk)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="font-weight-bold">{{ $produk->NamaProduk }}</h5>
                    <p>Stok: <span class="badge bg-primary">{{ $produk->Stok }}</span></p>
                    <p>Harga: Rp {{ number_format($produk->Harga, 2) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
