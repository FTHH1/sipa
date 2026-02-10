<?php

namespace App\Http\Controllers;

use App\Models\AlatMusik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlatMusikController extends Controller
{
 public function index()
{
    $alatMusik = AlatMusik::latest()->get();

    return view('alat_musik.index', compact('alatMusik'));
}

    public function create()
    {
        return view('alat_musik.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jenis' => 'required|string|max:50',
            'merk' => 'nullable|string|max:50',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|in:bagus,rusak,perbaikan',
            'deskripsi' => 'nullable|string',
        ]);

        do {
            $kode = $this->generateKode();
        } while (AlatMusik::where('kode', $kode)->exists());

        $validated['kode'] = $kode;

        AlatMusik::create($validated);

        return redirect()
            ->route('alat-musik.index')
            ->with('success', 'Alat musik berhasil ditambahkan');
    }

    public function edit(AlatMusik $alatMusik)
    {
        return view('alat_musik.edit', compact('alatMusik'));
    }

    public function update(Request $request, AlatMusik $alatMusik)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jenis' => 'required|string|max:50',
            'merk' => 'nullable|string|max:50',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|in:bagus,rusak,perbaikan',
            'deskripsi' => 'nullable|string',
        ]);

        $alatMusik->update($validated);

        return redirect()
            ->route('alat-musik.index')
            ->with('success', 'Alat musik berhasil diperbarui');
    }

    public function destroy(AlatMusik $alatMusik)
    {
        $alatMusik->delete();

        return redirect()
            ->route('alat-musik.index')
            ->with('success', 'Alat musik berhasil dihapus');
    }

    private function generateKode(): string
    {
        $year = now()->year;

        $last = AlatMusik::whereYear('created_at', $year)
            ->where('kode', 'like', "AM-$year-%")
            ->orderByDesc('id')
            ->first();

        $number = $last
            ? ((int) substr($last->kode, -4)) + 1
            : 1;

        return sprintf('AM-%s-%04d', $year, $number);
    }

    public function show($id)
{
    $alatMusik = AlatMusik::findOrFail($id);

    $stokBagus = DB::table('alat_musik_unit')
        ->where('alat_musik_id', $alatMusik->id)
        ->where('kondisi', 'bagus')
        ->where('status', 'tersedia')
        ->count();

    return view('alat_musik.show', compact('alatMusik', 'stokBagus'));
}

}
