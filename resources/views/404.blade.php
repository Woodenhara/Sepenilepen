@extends('layouts.app')

@section('title', '404 - Not Found')

@section('content')
<div class="text-center mt-5">
    <h1 class="error-title">404</h1>
    <p>Halaman yang Anda cari tidak ditemukan.</p>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
</div>
@endsection
