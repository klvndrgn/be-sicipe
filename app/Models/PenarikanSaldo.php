<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanSaldo extends Model
{
    use HasFactory;

    protected $table = 'penarikan_saldo';
    protected $primaryKey = 'id_penarikan_saldo';
    public $timestamps = false;
    
    protected $fillable = [
        'id_pengguna', 'jumlah_penarikan', 'status_penarikan', 'tanggal_penarikan' 
    ];
}
