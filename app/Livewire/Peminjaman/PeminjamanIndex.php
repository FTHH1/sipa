<?php

namespace App\Livewire\Peminjaman;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\AlatMusik;

class PeminjamanIndex extends Component
{
    public $peminjamanId;
    public $denda = 0;
    public $user_id;
    public $alat_musik_id;
    public $jumlah;
    public $tanggal_pinjam;
    public $tanggal_kembali;
    public $status = 'dipinjam';

    // 🔴 INI YANG TADI KURANG
    public $isEdit = false;


    protected $rules = [
        'user_id' => 'required',
        'alat_musik_id' => 'required',
        'jumlah' => 'required|numeric|min:1',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'status' => 'required',
    ];


    public function render()
    {
        return view('livewire.peminjaman.peminjaman-index', [
            'peminjamans' => Peminjaman::latest()->get(),
            'users' => User::all(),
            'alats' => AlatMusik::all(),
        ]);
    }


    public function resetForm()
    {
        $this->peminjamanId = null;

        $this->user_id = '';
        $this->alat_musik_id = '';
        $this->jumlah = '';
        $this->tanggal_pinjam = '';
        $this->tanggal_kembali = '';
        $this->status = 'dipinjam';
        $this->denda = 0;

        // 🔴 RESET MODE EDIT
        $this->isEdit = false;
    }


    public function store()
{
    $this->validate();

    $denda = $this->hitungDenda(); // ⬅️ HITUNG DENDA

    Peminjaman::create([
        'user_id' => $this->user_id,
        'alat_musik_id' => $this->alat_musik_id,
        'jumlah' => $this->jumlah,
        'tanggal_pinjam' => $this->tanggal_pinjam,
        'tanggal_kembali' => $this->tanggal_kembali,
        'status' => $this->status,
        'denda' => $denda, // ⬅️ SIMPAN DENDA
    ]);

    session()->flash('success', 'Data berhasil disimpan');

    $this->resetForm();
}



    public function edit($id)
    {
        $data = Peminjaman::findOrFail($id);

        $this->peminjamanId = $data->id;

        $this->user_id = $data->user_id;
        $this->alat_musik_id = $data->alat_musik_id;
        $this->jumlah = $data->jumlah;
        $this->tanggal_pinjam = $data->tanggal_pinjam;
        $this->tanggal_kembali = $data->tanggal_kembali;
        $this->status = $data->status;

        // 🔴 AKTIFKAN MODE EDIT
        $this->isEdit = true;
    }


    public function update()
{
    $this->validate();

    $denda = $this->hitungDenda(); // ⬅️ HITUNG LAGI

    Peminjaman::where('id', $this->peminjamanId)
        ->update([
            'user_id' => $this->user_id,
            'alat_musik_id' => $this->alat_musik_id,
            'jumlah' => $this->jumlah,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status' => $this->status,
            'denda' => $denda, // ⬅️ UPDATE DENDA
        ]);

    session()->flash('success', 'Peminjaman berhasil diupdate');

    $this->resetForm();
}



    public function delete($id)
    {
        Peminjaman::findOrFail($id)->delete();

        session()->flash('success', 'Peminjaman berhasil dihapus');
    }

private function hitungDenda()
{
    // Hanya hitung kalau sudah dikembalikan
    if ($this->status != 'dikembalikan') {
        return 0;
    }

    if (!$this->tanggal_kembali) {
        return 0;
    }

    $batasKembali = \Carbon\Carbon::parse($this->tanggal_kembali);
    $tanggalBalik = \Carbon\Carbon::now(); // dianggap hari dikembalikan

    // Kalau tidak telat
    if ($tanggalBalik->lte($batasKembali)) {
        return 0;
    }

    // Hitung hari telat
    $hariTelat = $tanggalBalik->diffInDays($batasKembali);

    // Per 7 hari = 1 minggu
    $mingguTelat = ceil($hariTelat / 7);

    // Tarif per minggu
    $tarif = 10000;

    return $mingguTelat * $tarif;
}



public function updatedStatus()
{
    $this->denda = $this->hitungDenda();
}


}
