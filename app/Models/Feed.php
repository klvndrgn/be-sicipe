<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pengguna',
        'id_resep',
        'foto_feeds',
        'komentar',
        'deskripsi_feeds',
        'nama_pengguna',
        'nama_resep',
        'tanggal_feeds'
    ];

    protected $table = 'feeds';
    protected $primaryKey = 'id_feeds';
    public $timestamps = false;
    
}
