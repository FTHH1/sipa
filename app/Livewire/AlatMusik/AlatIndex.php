<?php

namespace App\Livewire\AlatMusik;

use Livewire\Component;
use App\Models\AlatMusik;
use App\Models\Kategori;

class AlatIndex extends Component
{
    public $nama, $kategori_id, $merk, $stok, $kondisi, $deskripsi;
    public $alatId;

    public function resetForm()
    {
        $this->reset([
            'nama',
            'kategori_id',
            'merk',
            'stok',
            'kondisi',
            'deskripsi',
            'alatId'
        ]);
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'merk' => 'required',
            'stok' => 'required|numeric',
        ]);

        AlatMusik::updateOrCreate(
            ['id' => $this->alatId],
            [
                'nama' => $this->nama,
                'kategori_id' => $this->kategori_id,
                'merk' => $this->merk,
                'stok' => $this->stok,
                'kondisi' => $this->kondisi,
                'deskripsi' => $this->deskripsi,
            ]
        );

        session()->flash('success', 'Data berhasil disimpan');

        $this->resetForm();
    }

    public function edit($id)
    {
        $alat = AlatMusik::findOrFail($id);

        $this->alatId = $alat->id;
        $this->nama = $alat->nama;
        $this->kategori_id = $alat->kategori_id;
        $this->merk = $alat->merk;
        $this->stok = $alat->stok;
        $this->kondisi = $alat->kondisi;
        $this->deskripsi = $alat->deskripsi;
    }

    public function hapus($id)
    {
        AlatMusik::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.alat-musik.alat-index', [
            'alat' => AlatMusik::with('kategori')->get(),
            'kategori' => Kategori::all(),
        ]);
    }
}
