<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function cetak()
    {
        $peminjamans = Peminjaman::with(['user','alat'])
            ->latest()
            ->get();

        $pdf = Pdf::loadView('pdf.laporan', [
            'peminjamans' => $peminjamans
        ]);

        return $pdf->download('laporan-peminjaman.pdf');
    }
}
