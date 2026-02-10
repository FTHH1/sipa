<?php

namespace App\Livewire\Petugas;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\User;

class Laporan extends Component
{
   public function render()
{
    // Ambil data + relasi
    $peminjamans = Peminjaman::with(['user','alat'])
        ->latest()
        ->get();

    // Total user
    $total_user = User::count();

    // Sedang pinjam
    $sedang_pinjam = Peminjaman::where('status', 'dipinjam')->count();

    // Total peminjaman
    $total = Peminjaman::count();

    // Persentase (hindari /0)
    $persentase = $total > 0
        ? round(($sedang_pinjam / $total) * 100, 1)
        : 0;

    return view('livewire.petugas.laporan', compact(
        'total_user',
        'sedang_pinjam',
        'persentase',
        'peminjamans'
    ));
}

}
