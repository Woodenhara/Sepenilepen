<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    DetailPenjualan,
    Pelanggan,
    Penjualan,
    Produk,
};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PenjualanController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Penjualan::class);
        $penjualans = Penjualan::with('pelanggan')->get();
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $this->authorize('create', Penjualan::class);
        $produks = Produk::all();
        return view('penjualan.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'nullable|string',
            'NomorTelepon' => 'nullable|string|max:15',
            'TanggalPenjualan' => 'required|date',
            'produk.*.id_produk' => 'required|exists:produks,id',
            'produk.*.JumlahProduk' => 'required|integer|min:1',
        ]);

        $pelanggan = Pelanggan::create([
            'NamaPelanggan' => $request->NamaPelanggan,
            'Alamat' => $request->Alamat,
            'NomorTelepon' => $request->NomorTelepon,
        ]);

        $penjualan = Penjualan::create([
            'id_pelanggan' => $pelanggan->id,
            'TanggalPenjualan' => $request->TanggalPenjualan,
            'TotalHarga' => 0,
        ]);

        $totalHarga = 0;

        foreach ($request->produk as $produkData) {
            $produk = Produk::findOrFail($produkData['id_produk']);
            $subtotal = $produk->Harga * $produkData['JumlahProduk'];

            DetailPenjualan::create([
                'id_penjualan' => $penjualan->id,
                'id_produk' => $produk->id,
                'JumlahProduk' => $produkData['JumlahProduk'],
                'SubTotal' => $subtotal,
            ]);

            $totalHarga += $subtotal;

            $produk->update(['Stok' => $produk->Stok - $produkData['JumlahProduk']]);
        }

        $penjualan->update(['TotalHarga' => $totalHarga]);

        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'details.produk'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        $this->authorize('update', $penjualan);
        $penjualan->load(['details', 'pelanggan']);
        $produks = Produk::all();
        return view('penjualan.edit', compact('penjualan', 'produks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'Alamat' => 'nullable|string',
            'NomorTelepon' => 'nullable|string|max:15',
            'TanggalPenjualan' => 'required|date',
            'produk.*.id_produk' => 'required|exists:produks,id',
            'produk.*.JumlahProduk' => 'required|integer|min:1',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        $pelanggan = $penjualan->pelanggan;
        $pelanggan->update([
            'NamaPelanggan' => $request->NamaPelanggan,
            'Alamat' => $request->Alamat,
            'NomorTelepon' => $request->NomorTelepon,
        ]);

        foreach ($penjualan->details as $detail) {
            $produk = Produk::findOrFail($detail->id_produk);
            $produk->update(['Stok' => $produk->Stok + $detail->JumlahProduk]);
            $detail->delete();
        }

        $totalHarga = 0;
        foreach ($request->produk as $produkData) {
            $produk = Produk::findOrFail($produkData['id_produk']);
            $subtotal = $produk->Harga * $produkData['JumlahProduk'];

            DetailPenjualan::create([
                'id_penjualan' => $penjualan->id,
                'id_produk' => $produk->id,
                'JumlahProduk' => $produkData['JumlahProduk'],
                'SubTotal' => $subtotal,
            ]);

            $totalHarga += $subtotal;

            $produk->update(['Stok' => $produk->Stok - $produkData['JumlahProduk']]);
        }

        $penjualan->update([
            'TanggalPenjualan' => $request->TanggalPenjualan,
            'TotalHarga' => $totalHarga,
        ]);

        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil diperbarui.');
    }


    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);
        $penjualan->delete();
        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function dashboard()
    {
        $penjualan = Penjualan::with(['pelanggan', 'details.produk'])->get();
        $totalPenjualan = Penjualan::sum('TotalHarga');
        $totalProduk = Produk::count();
        $totalPelanggan = Pelanggan::count();
        $produks = Produk::all();

        return view('dashboard', compact('penjualan', 'totalPenjualan', 'totalProduk', 'totalPelanggan', 'produks'));
    }
}
