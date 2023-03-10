<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;
    protected $table = 'resep';
    protected $fillable = [
        'id_pengguna',
        'nama_kategori_resep',
        'nama_resep',
        'harga_resep',
        'bahan_dan_alat',
        'cara_kerja',
        'level',
        'durasi_masak',
        'jumlah_kalori',
        'deskripsi_resep',
        'foto_resep'
    ];
}
