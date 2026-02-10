<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Peminjaman;

class Petugas extends Component
{
    public function render()
    {
        return view('livewire.dashboard.petugas', [
            'totalDipinjam' => Peminjaman::where('status','dipinjam')->count(),

            'totalTelat' => Peminjaman::where('status','dipinjam')
                ->where('tanggal_kembali','<', now())
                ->count(),

            'totalMenunggu' => Peminjaman::where('status','menunggu')->count(),

            'terbaru' => Peminjaman::latest()
                ->take(5)
                ->get(),
        ]);
    }
}
