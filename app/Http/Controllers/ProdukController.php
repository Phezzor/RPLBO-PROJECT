<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // === LIST PRODUK ===
    public function index()
    {
        $produk = Produk::all()->map(function ($item) {
            $item->harga_format = 'Rp. ' . number_format($item->harga, 0, ',', '.');
            return $item;
        });

        return response()->json([
            'message' => 'Daftar produk',
            'data' => $produk
        ]);
    }

    // === DETAIL PRODUK ===
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->harga_format = 'Rp. ' . number_format($produk->harga, 0, ',', '.');

        return response()->json([
            'message' => 'Detail produk',
            'data' => $produk
        ]);
    }

    // === CREATE PRODUK (kepala_gudang saja) ===
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|integer',
            'kategori' => 'required',
            'status' => 'in:active,inactive',
            'deskripsi' => 'nullable|string'
        ]);

        $data = $request->all();
        $data['status'] = $request->status ?? 'active'; // default

        $produk = Produk::create($data);
        $produk->harga_format = 'Rp. ' . number_format($produk->harga, 0, ',', '.');

        return response()->json([
            'message' => 'Produk berhasil dibuat',
            'data' => $produk
        ], 201);
    }

    // === UPDATE PRODUK ===
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'status' => 'in:active,inactive'
        ]);

        $produk->update($request->all());
        $produk->harga_format = 'Rp. ' . number_format($produk->harga, 0, ',', '.');

        return response()->json([
            'message' => 'Produk berhasil diperbarui',
            'data' => $produk
        ]);
    }

    // === DELETE PRODUK ===
    public function destroy($id)
    {
        Produk::destroy($id);

        return response()->json(['message' => 'Produk dihapus']);
    }

    // === UPDATE STATUS SAJA ===
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        $produk = Produk::findOrFail($id);
        $produk->status = $request->status;
        $produk->save();

        return response()->json([
            'message' => 'Status produk diperbarui',
            'data' => $produk
        ]);
    }
}
