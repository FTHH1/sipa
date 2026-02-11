<?php

namespace App\Livewire\Peminjam;

use Livewire\Component;
use App\Models\AlatMusik;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class Ajukan extends Component
{
    public $alat;
    public $tanggal_pinjam;
    public $tanggal_kembali;
    public $jumlah = 1;
    public $catatan;

    protected $rules = [
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
         'catatan'          => 'required|min:3',
        'jumlah'           => 'required|integer|min:1',
    ];

    protected $messages = [
        'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi',
        'tanggal_kembali.required' => 'Tanggal kembali wajib diisi',
        'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam',
    ];

    public function mount($id)
    {
        $this->alat = AlatMusik::findOrFail($id);
    }

    public function submit()
{
    // VALIDASI
    $this->validate();

    DB::transaction(function () {

        // Lock data alat biar aman
        $alat = AlatMusik::where('id', $this->alat->id)
                        ->lockForUpdate()
                        ->first();

        // Cek stok lagi (biar realtime)
        if ($this->jumlah > $alat->stok) {
            $this->addError('jumlah', 'Jumlah melebihi stok tersedia');
            return;
        }

        // SIMPAN PEMINJAMAN
        Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $alat->id,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'jumlah' => $this->jumlah,
            'catatan' => $this->catatan,
            'status' => 'pending',
        ]);


    });

    // NOTIFIKASI
    session()->flash('success', 'Pengajuan berhasil dikirim!');

    return redirect()->route('peminjam.dashboard');
}

    public function render()
    {
        return view('livewire.peminjam.ajukan');
    }
}
