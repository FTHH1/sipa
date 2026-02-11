<?php

namespace App\Livewire\Peminjam;

use Livewire\Component;
use App\Models\Peminjaman;

class PinjamanSaya extends Component
{
    public function render()
    {
        $pinjaman = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.peminjam.pinjaman-saya', [
            'pinjaman' => $pinjaman
        ]);
    }
}
