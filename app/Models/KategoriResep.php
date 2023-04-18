<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriResep extends Model
{
    use HasFactory;
    protected $table = 'kategori_resep';

    protected $fillable = [
        'id_kategori_resep',
        'nama_kategori_resep',
        'foto_kategori_resep',
    ];
}
