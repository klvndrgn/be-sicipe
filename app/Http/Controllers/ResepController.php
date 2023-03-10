<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;

class ResepController extends Controller
{
    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'id_pengguna' => 'required',
        'nama_kategori_resep' => 'required',
        'nama_resep' => 'required',
        'harga_resep' => 'required',
        'bahan_dan_alat' => 'required',
        'cara_kerja' => 'required',
        'level' => 'required',
        'durasi_masak' => 'required',
        'jumlah_kalori' => 'required',
        'deskripsi_resep' => 'required',
        'foto_resep' => 'required'
    ]);

    $resep = Resep::create($validatedData);

    return response()->json([
        'message' => 'Resep berhasil ditambahkan',
        'data' => $resep
    ]);
    }

    public function index()
    {
        $reseps = Resep::all();

        return response()->json([
            'message' => 'Berhasil menampilkan semua resep',
            'data' => $reseps
        ]);
    }

    public function getTopRecipeId()
    {
        $recipe = Resep::select('id_resep')
                    ->orderByDesc('id_resep')
                    ->first();
        
                    if (!$recipe) {
                        return response()->json([
                            'message' => 'Tidak ada resep yang ditemukan',
                            'data' => [
                                'id_resep' => 1
                            ]
                        ]);
                    } else {
                        return response()->json([
                            'message' => 'Berhasil menampilkan semua resep',
                            'data' => $recipe
                        ]);
                    }
                    
    }
    

    public function showbasedkategori($nama_kategori_resep)
    {

    $reseps = Resep::where('nama_kategori_resep', $nama_kategori_resep)->get();

    return response()->json([
        'message' => 'Berhasil menampilkan resep berdasarkan kategori ' . $nama_kategori_resep,
        'data' => $reseps
    ]);
    }

    public function showresepsaya($id_pengguna)
    {
        $resep = Resep::where('id_pengguna', $id_pengguna)->get();

        if ($resep) {
            return response()->json([
                'message' => 'Berhasil menampilkan resep',
                'data' => $resep
            ]);
        } else {
            return response()->json([
                'message' => 'Resep tidak ditemukan'
            ], 404);
        }
    }

    public function show($id)
    {
        $resep = Resep::where('id_resep', $id)->first();

        if ($resep) {
            return response()->json([
                'message' => 'Berhasil menampilkan resep',
                'data' => $resep
            ]);
        } else {
            return response()->json([
                'message' => 'Resep tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
    $validatedData = $request->validate([
        'id_pengguna' => 'required',
        'id_kategori_resep' => 'required',
        'nama_kategori_resep' => 'required',
        'nama_resep' => 'required',
        'harga_resep' => 'required',
        'bahan_dan_alat' => 'required',
        'cara_kerja' => 'required',
        'durasi_masak' => 'required',
        'jumlah_kalori' => 'required',
        'deskripsi_resep' => 'required',
        'foto_resep' => 'required'
    ]);

    $resep = Resep::find($id);

    if ($resep) {
        $resep->update($validatedData);

        return response()->json([
            'message' => 'Resep berhasil diperbarui',
            'data' => $resep
        ]);
    } else {
        return response()->json([
            'message' => 'Resep tidak ditemukan'
        ], 404);
    }
    }

    public function destroy($id)
    {
    $resep = Resep::where('id_resep', $id);

    if ($resep) {
        $resep->delete();

        return response()->json([
            'message' => 'Resep berhasil dihapus'
        ]);
    } else {
        return response()->json([
            'message' => 'Resep tidak ditemukan'
        ], 404);
    }
    }

}
