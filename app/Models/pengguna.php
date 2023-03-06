<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class pengguna extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $guarded =[
        'id_pengguna',
    ];

    protected $table="pengguna";

    protected  $primaryKey = 'id_pengguna';

    public $timestamps=false;
}
