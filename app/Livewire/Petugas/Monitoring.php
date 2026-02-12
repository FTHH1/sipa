<?php

namespace App\Livewire\Petugas;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\AlatMusik;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class Monitoring extends Component
{
    /* ================= SETUJUI & PINJAM ================= */

    public function setujui($id)
    {
        DB::transaction(function () use ($id) {

            $pinjam = Peminjaman::findOrFail($id);
            $alat   = AlatMusik::findOrFail($pinjam->alat_id);

            // Validasi status
            if ($pinjam->status !== 'pending') {
                throw new \Exception('Status tidak valid');
            }

            // Cek stok
            if ($alat->stok < $pinjam->jumlah) {
                throw new \Exception('Stok tidak mencukupi');
            }

            // Kurangi stok
            $alat->decrement('stok', $pinjam->jumlah);

            // Update status
            $pinjam->update([
                'status' => 'dipinjam'
            ]);

            // Log
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Setujui & Pinjamkan',
                'description' => 'Menyetujui dan meminjamkan: '.$alat->nama,
            ]);
        });

        session()->flash('success', 'Peminjaman disetujui & langsung dipinjamkan');
    }


    /* ================= TOLAK ================= */

    public function tolak($id)
    {
        $pinjam = Peminjaman::findOrFail($id);

        $pinjam->update([
            'status' => 'ditolak'
        ]);

        logActivity(
            'Tolak Peminjaman',
            'Menolak peminjaman ID '.$id
        );

        session()->flash('error', 'Peminjaman ditolak');
    }


    /* ================= TERIMA PENGEMBALIAN ================= */
public function terimaPengembalian($id)
{
    DB::transaction(function () use ($id) {

        $pinjam = Peminjaman::with('alat')
            ->where('id', $id)
            ->where('status', 'minta_kembali')
            ->firstOrFail();


        // ✅ Tambah stok kembali
        if ($pinjam->alat) {
            $pinjam->alat->increment('stok', $pinjam->jumlah);
        }

        // ✅ Update status
        $pinjam->update([
            'status' => 'dikembalikan'
        ]);

        // ✅ Log
        logActivity(
            'Terima Pengembalian',
            'Menerima pengembalian: '.$pinjam->alat->nama
        );


    });

    session()->flash('success', 'Pengembalian berhasil diverifikasi');

       $this->dispatch('stokUpdated');
}



    /* ================= RENDER ================= */

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

        $this->dispatch('stok-updated');
    }
}
