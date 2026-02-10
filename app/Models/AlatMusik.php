<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatMusik extends Model
{
    protected $table = 'alat_musik';

    protected $fillable = [
        'kode',
        'nama',
        'jenis',
        'merk',
        'stok',
        'kondisi',
        'deskripsi',
    ];
}
