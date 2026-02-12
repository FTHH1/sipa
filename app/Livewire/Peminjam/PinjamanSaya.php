<?php

namespace App\Livewire\Peminjam;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\AlatMusik;
use Illuminate\Support\Facades\DB;

class PinjamanSaya extends Component
{
    public function kembalikan($id)
{



    DB::transaction(function () use ($id) {

        $pinjam = Peminjaman::with('alat')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'dipinjam')
            ->firstOrFail();

        // Ubah status jadi minta_kembali
        $pinjam->update([
            'status' => 'minta_kembali',
        ]);


        \Log::info('User mengajukan pengembalian', [
            'user' => auth()->user()->name,
            'alat' => $pinjam->alat->nama ?? '-',
        ]);
    });

    session()->flash('success', 'Permintaan pengembalian dikirim');
}

    public function ajukanKembali($id)
{


    $pinjam = Peminjaman::where('id', $id)
        ->where('user_id', auth()->id())
        ->where('status', 'dipinjam')
        ->firstOrFail();

    $pinjam->update([
        'status' => 'minta_kembali'
    ]);

    \Log::info('Pengajuan pengembalian', [
        'user' => auth()->user()->name,
        'alat' => $pinjam->alat->nama ?? '-',
    ]);

    session()->flash('success', 'Pengembalian diajukan, tunggu persetujuan petugas.');
}



   public function render()
            {
                return view('livewire.peminjam.pinjaman-saya', [
                    'peminjamans' => Peminjaman::with('alat')
                        ->where('user_id', auth()->id())
                        ->latest()
                        ->get()
                ]);
            }
}
