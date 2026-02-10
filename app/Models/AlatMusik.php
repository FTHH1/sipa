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
        'deskripsi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
