<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AlatMusik;

class Peminjaman extends Model
{
    use HasFactory;

    //  NAMA TABEL
    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'alat_musik_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda',
        'catatan',
    ];

    // RELASI USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI ALAT
    public function alat()
    {
        return $this->belongsTo(AlatMusik::class,);
    }
}
