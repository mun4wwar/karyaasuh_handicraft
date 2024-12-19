<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;

class BahanBakuController extends Controller
{
    // Tampilkan daftar bahan baku
    public function index()
    {
        $bahan_baku = BahanBaku::all();
        return view('admin.bahan_baku', compact('bahan_baku'));
    }

    // Form tambah bahan baku
    public function create()
    {
        return view('admin.add_bahanBaku');
    }

    // Simpan bahan baku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'jumlah_bahan' => 'required|integer|min:1',
            'satuan' => 'required|in:gram,meter,kilogram,kodi',
            'harga_bahan' => 'required|numeric|min:0',
        ]);

        BahanBaku::create($validated);

        return redirect()->route('bahan.index')->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    // Form edit bahan baku
    public function edit($id_bahanbaku)
    {
        $bahan = BahanBaku::findOrFail($id_bahanbaku);
        return view('admin.edit_bahan', compact('bahan'));
    }

    // Update bahan baku
    public function update(Request $request, $id_bahanbaku)
    {
        $validated = $request->validate([
            'nama_bahan' => 'required|string|max:255',
            'jumlah_bahan' => 'required|integer|min:1',
            'satuan' => 'required|in:gram,meter,kilogram,kodi',
            'harga_bahan' => 'required|numeric|min:0',
        ]);

        $bahan = BahanBaku::findOrFail($id_bahanbaku);
        $bahan->update($validated);

        return redirect()->route('bahan.index')->with('success', 'Bahan baku berhasil diperbarui.');
    }

    // Hapus bahan baku
    public function destroy($id_bahanbaku)
    {
        $bahan = BahanBaku::findOrFail($id_bahanbaku);
        $bahan->delete();

        return redirect()->route('bahan.index')->with('success', 'Bahan baku berhasil dihapus.');
    }
}
