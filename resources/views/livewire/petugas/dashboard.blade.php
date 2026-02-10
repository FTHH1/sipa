<x-layouts.petugas
    title="Data Petugas"
    :total_user="$total_user"
    :sedang_pinjam="$sedang_pinjam"
    :persentase="$persentase"
>

    {{-- TABEL --}}
    <div class="bg-white p-4 rounded shadow">

        <h2 class="font-bold mb-3">
            Peminjaman Terbaru
        </h2>

        <table class="w-full border">

            <tr class="bg-gray-100">
                <th class="p-2 border">User</th>
                <th class="p-2 border">Alat</th>
                <th class="p-2 border">Status</th>
            </tr>

            @foreach($peminjamans as $p)

            <tr>
                <td class="p-2 border">
                    {{ $p->user->name ?? '-' }}
                </td>

                <td class="p-2 border">
                    {{ $p->alat->nama ?? '-' }}
                </td>

                <td class="p-2 border">
                    {{ $p->status }}
                </td>
            </tr>

            @endforeach

        </table>

    </div>

</x-layouts.petugas>
