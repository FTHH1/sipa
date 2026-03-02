<?php

namespace App\Livewire\Peminjam;


use Carbon\Carbon;
use Livewire\Component;
use App\Models\AlatMusik;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Ajukan extends Component
{
    public $alat;
    public $tanggal_pinjam;
    public $tanggal_kembali;
    public $jumlah = 1;
    public $catatan;

    protected $rules = [
        'tanggal_pinjam'   => 'required|date',
        'catatan'          => 'required|min:3',
        'jumlah'           => 'required|integer|min:1',
    ];

    protected $messages = [
        'tanggal_pinjam.required'  => 'Tanggal pinjam wajib diisi',
        'catatan.required' => 'Catatan wajib diisi',
    ];

    public function mount($id)
    {
        $this->alat = AlatMusik::findOrFail($id);
    }

    public function updatedTanggalPinjam()
{
    if ($this->tanggal_pinjam) {
        $this->tanggal_kembali = Carbon::parse($this->tanggal_pinjam)
            ->addDays(7)
            ->format('Y-m-d');
    }
}

    public function submit()
    {

        // VALIDASI
        $this->validate();

        // CEK STOK
        if ($this->jumlah > $this->alat->stok) {
            $this->addError('jumlah', 'Jumlah melebihi stok tersedia');
            return;
        }

        DB::transaction(function () {

            // SIMPAN PEMINJAMAN
            Peminjaman::create([
                'user_id'        => auth()->id(),
                'alat_id'        => $this->alat->id,
                'tanggal_pinjam'=> $this->tanggal_pinjam,
                'tanggal_kembali'=> Carbon::parse($this->tanggal_pinjam)->addDays(7),
                'jumlah'         => $this->jumlah,
                'catatan'        => $this->catatan,
                'status'         => 'pending',
            ]);

            // KURANGI STOK
            $this->alat->decrement('stok', $this->jumlah);

            logActivity(
                    'Ajukan Peminjaman',
                    'Mengajukan alat: '.$this->alat->nama
                );

        }); // ← WAJIB ADA (penutup transaction)

        session()->flash('success', 'Pengajuan berhasil dikirim!');

        return redirect()->route('peminjam.dashboard');
    }

    public function render()
    {
        return view('livewire.peminjam.ajukan');
    }
}
