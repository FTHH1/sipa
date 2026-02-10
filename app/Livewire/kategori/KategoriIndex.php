<?php

namespace App\Livewire\Kategori;

use Livewire\Component;
use App\Models\Kategori;
use Livewire\Attributes\Layout;

#[Layout('layouts.app.sidebar')]
class KategoriIndex extends Component
{
    public $kategoriId;
    public $nama;
    public $deskripsi;
    public $isEdit = false;

    protected $rules = [
        'nama' => 'required|string|max:100',
        'deskripsi' => 'nullable|string',
    ];

    public function render()
    {
        return view('livewire.kategori.kategori-index', [
            'kategoris' => Kategori::latest()->get(),
        ]);
    }

    public function resetForm()
    {
        $this->kategoriId = null;
        $this->nama = '';
        $this->deskripsi = '';
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();

        Kategori::create([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('success', 'Kategori berhasil ditambahkan');

        $this->resetForm();
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        $this->kategoriId = $kategori->id;
        $this->nama = $kategori->nama;
        $this->deskripsi = $kategori->deskripsi;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        Kategori::where('id', $this->kategoriId)
            ->update([
                'nama' => $this->nama,
                'deskripsi' => $this->deskripsi,
            ]);

        session()->flash('success', 'Kategori berhasil diupdate');

        $this->resetForm();
    }

    public function delete($id)
    {
        Kategori::findOrFail($id)->delete();

        session()->flash('success', 'Kategori berhasil dihapus');
    }
}
