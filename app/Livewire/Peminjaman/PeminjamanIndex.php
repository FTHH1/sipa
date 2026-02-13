<?php

namespace App\Livewire\Peminjaman;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\AlatMusik;
use Illuminate\Support\Facades\DB;

class PeminjamanIndex extends Component
{
    public $peminjamanId;

    public $user_id;
    public $alat_id;
    public $jumlah;
    public $tanggal_pinjam;
    public $tanggal_kembali;
    public $status = 'pending';

    public $isEdit = false;


    protected $rules = [
        'user_id' => 'required',
        'alat_id' => 'required',
        'jumlah' => 'required|numeric|min:1',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'status' => 'required',
    ];


    /* ======================= */
    /* TAMPILKAN DATA */
    /* ======================= */
    public function render()
    {
        return view('livewire.peminjaman.peminjaman-index', [

            'peminjamans' => Peminjaman::with(['user','alat'])
                ->latest()
                ->get(),

            'users' => User::where('role','peminjam')->get(),

            'alats' => AlatMusik::all(),
        ]);
    }


    /* ======================= */
    /* RESET FORM */
    /* ======================= */
    public function resetForm()
    {
        $this->peminjamanId = null;

        $this->user_id = '';
        $this->alat_id = '';
        $this->jumlah = '';
        $this->tanggal_pinjam = '';
        $this->tanggal_kembali = '';
        $this->status = 'pending';

        $this->isEdit = false;
    }


    /* ======================= */
    /* CREATE */
    /* ======================= */
    public function store()
    {
        $this->validate();

        Peminjaman::create([
            'user_id' => $this->user_id,
            'alat_id' => $this->alat_id,
            'jumlah' => $this->jumlah,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status' => 'pending',
        ]);

        session()->flash('success','Peminjaman berhasil ditambahkan');

        $this->resetForm();
    }


    /* ======================= */
    /* EDIT */
    /* ======================= */
    public function edit($id)
    {
        $data = Peminjaman::findOrFail($id);

        $this->peminjamanId = $id;

        $this->user_id = $data->user_id;
        $this->alat_id = $data->alat_id;
        $this->jumlah = $data->jumlah;
        $this->tanggal_pinjam = $data->tanggal_pinjam;
        $this->tanggal_kembali = $data->tanggal_kembali;
        $this->status = $data->status;

        $this->isEdit = true;
    }


    /* ======================= */
    /* UPDATE */
    /* ======================= */
    public function update()
{
    $this->validate([
        'user_id' => 'required',
        'alat_id' => 'required',
        'jumlah' => 'required|numeric|min:1',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'status' => 'required',
    ]);

    Peminjaman::where('id', $this->peminjamanId)
        ->update([
            'user_id' => $this->user_id,
            'alat_id' => $this->alat_id,
            'jumlah' => $this->jumlah,
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status' => $this->status,
        ]);

    session()->flash('success','Peminjaman berhasil diupdate');

    $this->resetForm();
}

    /* ======================= */
    /* DELETE */
    /* ======================= */
    public function delete($id)
    {
        DB::transaction(function () use ($id) {

            $pinjam = Peminjaman::with('alat')->findOrFail($id);

            // Kembalikan stok kalau masih dipinjam
            if ($pinjam->status == 'dipinjam') {
                $pinjam->alat->increment('stok', $pinjam->jumlah);
            }

            $pinjam->delete();
        });

        session()->flash('success','Data peminjaman dihapus');
    }
}
