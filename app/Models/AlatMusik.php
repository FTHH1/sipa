<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class AlatMusik extends Model
{
    protected $fillable = [
    'kode',
    'nama',
    'kategori_id',
    'merk',
    'stok',
    'kondisi',
    'deskripsi',
];


public function peminjamans()
{
    return $this->hasMany(peminjamans::class, 'alat_id');
}


        public function kategori()
        {
            return $this->belongsTo(Kategori::class);
        }
}
