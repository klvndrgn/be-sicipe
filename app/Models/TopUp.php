<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUp extends Model
{
    use HasFactory;

    protected $table = 'top_up';
    protected $primaryKey = 'id_top_up';
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna', 'jumlah_top_up', 'status_top_up', 'tanggal_top_up'
    ];
}
