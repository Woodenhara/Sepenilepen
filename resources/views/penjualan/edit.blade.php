@extends('layouts.app')

@section('title', 'Edit Penjualan')

@section('content')
<div class="page-heading">
    <h3>Edit Penjualan</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <h5>Data Pelanggan</h5>
                <div class="form-group">
                    <label for="NamaPelanggan">Nama Pelanggan</label>
                    <input type="text" name="NamaPelanggan" id="NamaPelanggan" class="form-control"
                        value="{{ $penjualan->pelanggan->NamaPelanggan }}" required>
                </div>
                <div class="form-group">
                    <label for="Alamat">Alamat</label>
                    <input type="text" name="Alamat" id="Alamat" class="form-control"
                        value="{{ $penjualan->pelanggan->Alamat }}">
                </div>
                <div class="form-group">
                    <label for="NomorTelepon">Nomor Telepon</label>
                    <input type="text" name="NomorTelepon" id="NomorTelepon" class="form-control"
                        value="{{ $penjualan->pelanggan->NomorTelepon }}">
                </div>

                <h5>Data Penjualan</h5>
                <div class="form-group">
                    <label for="TanggalPenjualan">Tanggal Penjualan</label>
                    <input type="date" name="TanggalPenjualan" id="TanggalPenjualan" class="form-control"
                        value="{{ $penjualan->TanggalPenjualan }}" required>
                </div>

                <h5>Detail Penjualan</h5>
                <div id="produk-wrapper">
                    @foreach ($penjualan->details as $index => $detail)
                    <div class="form-group produk-row mt-3">
                        <label for="id_produk">Produk</label>
                        <select name="produk[{{ $index }}][id_produk]" class="form-control produk-select" onchange="updateHarga(this)">
                            <option value="" disabled>Pilih Produk</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id }}"
                                    data-harga="{{ $produk->Harga }}"
                                    data-stok="{{ $produk->Stok }}"
                                    {{ $detail->id_produk == $produk->id ? 'selected' : '' }}>
                                    {{ $produk->NamaProduk }} (Stok: {{ $produk->Stok }})
                                </option>
                            @endforeach
                        </select>
                        <label for="JumlahProduk">Jumlah</label>
                        <input type="number" name="produk[{{ $index }}][JumlahProduk]" class="form-control jumlah-input"
                            oninput="updateSubtotal(this)" value="{{ $detail->JumlahProduk }}" min="1" required>
                        <label for="HargaSementara">Harga Produk</label>
                        <input type="text" class="form-control harga-sementara" readonly
                            value="{{ $detail->produk->Harga }}">
                        <label for="Subtotal">Subtotal</label>
                        <input type="text" class="form-control subtotal" readonly
                            value="{{ $detail->SubTotal }}">
                    </div>
                    @endforeach
                </div>

                <button type="button" id="add-produk" class="btn btn-secondary mt-3">Tambah Produk</button>

                <div class="form-group mt-3">
                    <label for="TotalHarga">Total Harga</label>
                    <input type="text" id="total-harga" class="form-control" readonly
                        value="{{ $penjualan->TotalHarga }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    let produkIndex = 1;

    document.getElementById('add-produk').addEventListener('click', () => {
        const wrapper = document.getElementById('produk-wrapper');
        const newProduk = `
            <div class="form-group produk-row mt-3">
                <label for="id_produk">Produk</label>
                <select name="produk[${produkIndex}][id_produk]" class="form-control produk-select" onchange="updateHarga(this)">
                    <option value="" disabled selected>Pilih Produk</option>
                    @foreach ($produks as $produk)
                        <option value="{{ $produk->id }}" data-harga="{{ $produk->Harga }}">
                            {{ $produk->NamaProduk }}
                        </option>
                    @endforeach
                </select>
                <label for="JumlahProduk">Jumlah</label>
                <input type="number" name="produk[${produkIndex}][JumlahProduk]" class="form-control jumlah-input"
                       oninput="updateSubtotal(this)" min="1" required>
                <label for="HargaSementara">Harga Sementara</label>
                <input type="text" class="form-control harga-sementara" readonly>
                <label for="Subtotal">Subtotal</label>
                <input type="text" class="form-control subtotal" readonly>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', newProduk);
        produkIndex++;
    });

    function updateHarga(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');
        const stok = selectedOption.getAttribute('data-stok');
        const row = selectElement.closest('.produk-row');
        const hargaSementaraInput = row.querySelector('.harga-sementara');
        const jumlahInput = row.querySelector('.jumlah-input');

        hargaSementaraInput.value = harga;
        stokTersediaInput.value = stok;

        if (jumlahInput.value) {
            updateSubtotal(jumlahInput);
        }
    }

    function updateSubtotal(jumlahInput) {
        const row = jumlahInput.closest('.produk-row');
        const hargaSementaraInput = row.querySelector('.harga-sementara').value || 0;
        const subtotalInput = row.querySelector('.subtotal');

        const subtotal = hargaSementaraInput * jumlahInput.value;
        subtotalInput.value = subtotal;

        updateTotalHarga();
    }

    function updateTotalHarga() {
        const subtotalInputs = document.querySelectorAll('.subtotal');
        let totalHarga = 0;

        subtotalInputs.forEach(input => {
            totalHarga += parseFloat(input.value) || 0;
        });

        document.getElementById('total-harga').value = totalHarga;
    }
</script>
@endpush
@endsection
