<?php

namespace App\Livewire\Peminjam;

use Livewire\Component;
use App\Models\AlatMusik;

class DaftarAlatMusik extends Component
{

   protected $listeners = [
        'stokUpdated' => '$refresh'
    ];

    public function render()
    {
          $alatMusik = AlatMusik::with('kategori')->get();

        return view('livewire.peminjam.daftar-alat-musik', [
        'alatMusik' => $alatMusik
    ]);

    }
}
