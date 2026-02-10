<x-layouts.petugas
    title="Laporan Peminjaman"
    :total_user="$total_user"
    :sedang_pinjam="$sedang_pinjam"
    :persentase="$persentase"
>

<div class="bg-white p-4 rounded shadow">

    <div class="flex justify-between mb-4">

        <h2 class="font-bold">
            Data Laporan
        </h2>

        <a href="{{ route('laporan.cetak') }}"
           class="px-3 py-2 bg-red-600 text-black rounded text-sm">

            Cetak PDF
        </a>

    </div>

    <table class="w-full border">

        <tr class="bg-gray-100">
            <th class="p-2 border">User</th>
            <th class="p-2 border">Alat</th>
            <th class="p-2 border">Status</th>
            <th class="p-2 border">Tanggal</th>
        </tr>

        @foreach($peminjamans as $p)

        <tr>

            <td class="p-2 border">{{ $p->user->name ?? '-'}}</td>
            <td class="p-2 border">{{ $p->alat->nama ?? '-'}}</td>
            <td class="p-2 border">{{ $p->status }}</td>
            <td class="p-2 border">{{ $p->created_at->format('d-m-Y') }}</td>

        </tr>

        @endforeach

    </table>

</div>

</x-layouts.petugas>
