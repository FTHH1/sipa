<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\AlatMusik;
use Illuminate\Support\Facades\DB;

class Pengembalian extends Component
{
    public $editId;
    public $jumlah;
    public $status;

    public $isEdit = false;

    protected $rules = [
        'jumlah' => 'required|numeric|min:1',
        'status' => 'required'
    ];

    /* ===================== */
    /* TAMPILKAN DATA */
    /* ===================== */
    public function render()
    {
        return view('livewire.admin.pengembalian', [
            'pengembalians' => Peminjaman::with(['user','alat'])
                ->where('status', 'dikembalikan')
                ->latest()
                ->get(),
        ]);
    }

    /* ===================== */
    /* EDIT */
    /* ===================== */
    public function edit($id)
    {
        $data = Peminjaman::findOrFail($id);

        $this->editId = $id;
        $this->jumlah = $data->jumlah;
        $this->status = $data->status;

        $this->isEdit = true;
    }

    /* ===================== */
    /* UPDATE */
    /* ===================== */
    public function update()
    {
        $this->validate();

        Peminjaman::where('id', $this->editId)
            ->update([
                'jumlah' => $this->jumlah,
                'status' => $this->status,
            ]);

        session()->flash('success', 'Data pengembalian berhasil diupdate');

        $this->resetForm();
    }

    /* ===================== */
    /* DELETE */
    /* ===================== */
    public function delete($id)
    {
        DB::transaction(function () use ($id) {

            $pinjam = Peminjaman::with('alat')->findOrFail($id);

            // Kurangi stok lagi kalau hapus histori
            if ($pinjam->alat) {
                $pinjam->alat->decrement('stok', $pinjam->jumlah);
            }

            $pinjam->delete();
        });

        session()->flash('success', 'Data pengembalian dihapus');
    }

    /* ===================== */
    /* RESET */
    /* ===================== */
    public function resetForm()
    {
        $this->editId = null;
        $this->jumlah = null;
        $this->status = null;

        $this->isEdit = false;
    }
}
