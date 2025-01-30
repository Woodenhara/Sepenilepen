<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProdukController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $this->authorize('viewAny', Produk::class);

        $query = Produk::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('NamaProduk', 'like', '%' . $request->search . '%');
        }

        $produks = $query->get();

        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        $this->authorize('create', Produk::class);
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NamaProduk' => 'required|string|max:255',
            'Harga' => 'required|numeric|min:0',
            'Stok' => 'required|integer|min:0',
        ]);

        Produk::create([
            'NamaProduk' => $request->NamaProduk,
            'Harga' => $request->Harga,
            'Stok' => $request->Stok,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NamaProduk' => 'required|string|max:255',
            'Harga' => 'required|numeric|min:0',
            'Stok' => 'required|integer|min:0',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
