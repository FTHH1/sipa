<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Peminjaman;


class Dashboard extends Component
{
    public $totalUser;
    public $userMeminjam;
    public $persentasePengembalian;

    public function mount()
    {
        $this->totalUser = User::count();

        $this->userMeminjam = Peminjaman::where('status', 'dipinjam')
            ->distinct('user_id')
            ->count('user_id');

        $total = Peminjaman::count();
        $kembali = Peminjaman::where('status', 'dikembalikan')->count();

        $this->persentasePengembalian = $total > 0
            ? round(($kembali / $total) * 100, 1)
            : 0;
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
             ->layout('layouts.app.sidebar');
    }
}
