<?php

namespace App\Livewire\Peminjam;

use Livewire\Component;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $total;
    public $aktif;
    public $selesai;
    public $totalDenda;

  public function mount()
{
    $userId = auth()->id();

    // Total semua peminjaman
    $this->total = Peminjaman::where('user_id', $userId)->count();

    // Sedang dipinjam (yang belum dikembalikan)
    $this->aktif = Peminjaman::where('user_id', $userId)
        ->where('status', '!=', 'dikembalikan')
        ->count();

    // Selesai / Dikembalikan
    $this->selesai = Peminjaman::where('user_id', $userId)
        ->where('status', 'dikembalikan')
        ->count();

    // Total denda
    $totalDenda = Peminjaman::where('user_id', auth()->id())
    ->sum(DB::raw('GREATEST(denda,0)'));

}


    public function render()
    {
        return view('livewire.peminjam.dashboard');
    }
}
