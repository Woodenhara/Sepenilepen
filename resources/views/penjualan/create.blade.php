@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')
<div class="page-heading">
    <h3>Tambah Penjualan</h3>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('penjualan.store') }}" method="POST">
                @csrf
                <h5>Data Pelanggan</h5>
                <div class="form-group">
                    <label for="NamaPelanggan">Nama Pelanggan</label>
                    <input type="text" name="NamaPelanggan" id="NamaPelanggan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="Alamat">Alamat</label>
                    <input type="text" name="Alamat" id="Alamat" class="form-control">
                </div>
                <div class="form-group">
                    <label for="NomorTelepon">Nomor Telepon</label>
                    <input type="text" name="NomorTelepon" id="NomorTelepon" class="form-control">
                </div>

                <h5>Data Penjualan</h5>
                <div class="form-group">
                    <label for="TanggalPenjualan">Tanggal Penjualan</label>
                    <input type="date" name="TanggalPenjualan" id="TanggalPenjualan" class="form-control" required>
                </div>

                <h5>Detail Penjualan</h5>
                <div id="produk-wrapper">
                    <div class="form-group produk-row">
                        <label for="id_produk">Produk</label>
                        <select name="produk[0][id_produk]" class="form-control produk-select" onchange="updateHarga(this)">
                            <option value="" disabled selected>Pilih Produk</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id }}" data-harga="{{ $produk->Harga }}" data-stok="{{ $produk->Stok }}"
                                    @if($produk->Stok == 0) disabled @endif>
                                    {{ $produk->NamaProduk }} @if($produk->Stok == 0) (Stok Habis) @else (Stok: {{ $produk->Stok }}) @endif
                                </option>
                            @endforeach
                        </select>
                        <label for="JumlahProduk">Jumlah</label>
                        <input type="number" name="produk[0][JumlahProduk]" class="form-control jumlah-input"
                               oninput="updateSubtotal(this)" min="1" required>
                        <label for="HargaSementara">Harga Produk</label>
                        <input type="text" class="form-control harga-sementara" readonly>
                        <label for="Subtotal">Subtotal</label>
                        <input type="text" class="form-control subtotal" readonly>
                        <label for="Pajak">Pajak (11%)</label>
                        <input type="text" class="form-control pajak" readonly>
                    </div>
                </div>

                <button type="button" id="add-produk" class="btn btn-secondary mt-3">Tambah Produk</button>

                <div class="form-group mt-3">
                    <label for="TotalHarga">Total Harga</label>
                    <input type="text" id="total-harga" class="form-control" readonly>
                </div>
                <div class="form-group mt-3">
                    <label for="TotalPajak">Total Pajak</label>
                    <input type="text" id="total-pajak" class="form-control" readonly>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
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
                        <option value="{{ $produk->id }}" data-harga="{{ $produk->Harga }}" data-stok="{{ $produk->Stok }}"
                            @if($produk->Stok == 0) disabled @endif>
                            {{ $produk->NamaProduk }} @if($produk->Stok == 0) (Stok Habis) @else (Stok: {{ $produk->Stok }}) @endif
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
                <label for="Pajak">Pajak (11%)</label>
                <input type="text" class="form-control pajak" readonly>
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
        const pajakInput = row.querySelector('.pajak');

        const subtotal = hargaSementaraInput * jumlahInput.value;
        subtotalInput.value = subtotal;

        const pajak = subtotal * 0.11;
        pajakInput.value = pajak.toFixed(2);

        updateTotalHarga();
    }

    function updateTotalHarga() {
        const subtotalInputs = document.querySelectorAll('.subtotal');
        const pajakInputs = document.querySelectorAll('.pajak');
        let totalHarga = 0;
        let totalPajak = 0;

        subtotalInputs.forEach(input => {
            totalHarga += parseFloat(input.value) || 0;
        });

        pajakInputs.forEach(input => {
            totalPajak += parseFloat(input.value) || 0;
        });

        document.getElementById('total-harga').value = totalHarga.toFixed(2);
        document.getElementById('total-pajak').value = totalPajak.toFixed(2);
    }
</script>
@endpush
@endsection
