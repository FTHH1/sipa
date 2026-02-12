<?php

namespace App\Livewire\Petugas;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\AlatMusik;
use Illuminate\Support\Facades\DB;


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

public function pinjamkan($id)
{
    $pinjam = Peminjaman::findOrFail($id);

    if ($pinjam->status !== 'disetujui') {
        session()->flash('error', 'Status tidak valid');
        return;
    }

    $pinjam->update([
        'status' => 'dipinjam'
    ]);

    // LOG
    \Log::info('Peminjaman dipinjamkan', [
        'user' => auth()->user()->name,
        'alat' => $pinjam->alat->nama ?? '-',
    ]);

    session()->flash('success', 'Barang berhasil dipinjamkan');
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
                                ->whereIn('status', [
                                    'pending',
                                    'disetujui',
                                    'minta_kembali'
                                ])
                                ->latest()
                                ->get()
                        ]);
                    }


            public function terimaPengembalian($id)
{
    DB::transaction(function () use ($id) {

        $pinjam = Peminjaman::with('alat')
            ->where('id', $id)
            ->where('status', 'minta_kembali')
            ->firstOrFail();

        // Update status
        $pinjam->update([
            'status' => 'dikembalikan'
        ]);

        // Tambah stok
        if ($pinjam->alat) {
            $pinjam->alat->increment('stok', $pinjam->jumlah);
        }

        \Log::info('Pengembalian disetujui', [
            'user' => auth()->user()->name,
            'alat' => $pinjam->alat->nama ?? '-',
        ]);
    });

    session()->flash('success', 'Pengembalian berhasil diverifikasi.');
}

}
