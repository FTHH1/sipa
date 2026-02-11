<?php

namespace App\Livewire\Peminjam;

use Livewire\Component;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $total;
    public $aktif;
    public $selesai;
    public $totalDenda;

    public function mount()
    {
        $userId = Auth::id();

        $this->total = Peminjaman::where('user_id', $userId)->count();

        $this->aktif = Peminjaman::where('user_id', $userId)
                        ->where('status', 'dipinjam')
                        ->count();

        $this->selesai = Peminjaman::where('user_id', $userId)
                        ->where('status', 'selesai')
                        ->count();

        $this->totalDenda = Peminjaman::where('user_id', $userId)
                        ->sum('denda');
    }

    public function render()
    {
        return view('livewire.peminjam.dashboard');
    }
}
