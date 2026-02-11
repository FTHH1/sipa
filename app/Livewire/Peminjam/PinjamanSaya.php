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

            $pinjam = Peminjaman::where('id', $id)
                ->where('user_id', auth()->id())
                ->where('status', 'dipinjam')
                ->firstOrFail();

            // Update status
            $pinjam->update([
                'status' => 'dikembalikan',
            ]);

            // Tambah stok alat
            $alat = AlatMusik::find($pinjam->alat_id);

            if ($alat) {
                $alat->increment('stok', $pinjam->jumlah);
            }
        });

        session()->flash('success', 'Alat berhasil dikembalikan');
    }

    public function render()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.peminjam.pinjaman-saya', [
            'peminjamans' => $peminjamans
        ]);
    }
}
