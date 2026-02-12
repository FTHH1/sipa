<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AlatMusik;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'alat_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'jumlah',
        'catatan',
        'status',
    ];

    // RELASI USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI ALAT (INI YANG BIKIN "-" HILANG)
    public function alat()
    {
        return $this->belongsTo(AlatMusik::class, 'alat_id');
    }


            public function getStatusLabelAttribute()
        {
            return ucwords(str_replace('_', ' ', $this->status));
        }
}
