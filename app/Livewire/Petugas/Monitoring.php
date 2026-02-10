<?php

namespace App\Livewire\Petugas;

use Livewire\Component;
use App\Models\Peminjaman;

class Monitoring extends Component
{
    public function setujui($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->update([
            'status' => 'disetujui'
        ]);

        session()->flash('success', 'Peminjaman disetujui');
    }

    public function tolak($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->update([
            'status' => 'ditolak'
        ]);

        session()->flash('error', 'Peminjaman ditolak');
    }

    public function render()
    {
        return view('livewire.petugas.monitoring', [
            'peminjamans' => Peminjaman::with(['user','alat'])
                ->where('status', 'pending')
                ->latest()
                ->get()
        ]);
    }
}
