<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriResep;

class KategoriResepController extends Controller
{
    public function store(Request $request)
    {
    $kategoriResep = new KategoriResep;
    $kategoriResep->nama_kategori_resep = $request->nama_kategori_resep;
    $kategoriResep->foto_kategori_resep = $request->foto_kategori_resep;
    $kategoriResep->save();

    return response()->json([
        'success' => true,
        'message' => 'Kategori Resep berhasil ditambahkan.',
        'data' => $kategoriResep
    ]);
    }
    public function index()
    {
    $kategoriResep = KategoriResep::all();

    return response()->json([
        'success' => true,
        'data' => $kategoriResep
    ]);
    }

    public function show(KategoriResep $kategoriResep)
    {
    return response()->json([
        'success' => true,
        'data' => $kategoriResep
    ]);
    }
    public function update(Request $request, KategoriResep $kategoriResep)
    {
    $kategoriResep->nama_kategori_resep = $request->nama_kategori_resep;
    $kategoriResep->foto_kategori_resep = $request->foto_kategori_resep;
    $kategoriResep->save();

    return response()->json([
        'success' => true,
        'message' => 'Kategori Resep berhasil diubah.',
        'data' => $kategoriResep
    ]);
    }
    public function destroy(KategoriResep $kategoriResep)
    {
    $kategoriResep->delete();

    return response()->json([
        'success' => true,
        'message' => 'Kategori Resep berhasil dihapus.'
    ]);
    }
}
