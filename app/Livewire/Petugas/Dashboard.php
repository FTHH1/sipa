<?php

namespace App\Livewire\Petugas;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\User;

class Dashboard extends Component
{
    public function render()
    {
        $total = Peminjaman::count();
        $kembali = Peminjaman::where('status','dikembalikan')->count();

        return view('livewire.petugas.dashboard',[

            'total_user' => User::count(),

            'sedang_pinjam' => Peminjaman::where('status','dipinjam')->count(),

            'persentase' => $total > 0
                ? round(($kembali / $total) * 100)
                : 0,

            'peminjamans' => Peminjaman::latest()->take(10)->get(),
        ]);
    }

    public function setujui($id)
    {
        Peminjaman::findOrFail($id)->update([
            'status' => 'dipinjam',
        ]);
    }

    public function kembalikan($id)
    {
        Peminjaman::findOrFail($id)->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()
        ]);
    }
}
