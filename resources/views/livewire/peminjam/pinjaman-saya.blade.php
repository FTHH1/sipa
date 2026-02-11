<div class="px-6 py-6">

    <div class="max-w-5xl mx-auto bg-white rounded-xl border p-6">

        {{-- Judul --}}
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            📦 Pinjaman Saya
        </h2>


        @if($pinjaman->count() == 0)

            <div class="text-center text-gray-500 py-10">
                Belum ada peminjaman
            </div>

        @else

        <div class="overflow-x-auto">

            <table class="w-full border-collapse">

                <thead>
                    <tr class="bg-gray-100 text-left text-sm">

                        <th class="p-3 border">Alat</th>
                        <th class="p-3 border">Tgl Pinjam</th>
                        <th class="p-3 border">Tgl Kembali</th>
                        <th class="p-3 border">Jumlah</th>
                        <th class="p-3 border text-center">Status</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach($pinjaman as $item)

                    <tr class="hover:bg-gray-50">

                        <td class="p-3 border font-medium">
                            {{ $item->alat->nama ?? '-' }}
                        </td>

                        <td class="p-3 border">
                            {{ $item->tanggal_pinjam }}
                        </td>

                        <td class="p-3 border">
                            {{ $item->tanggal_kembali }}
                        </td>

                        <td class="p-3 border text-center">
                            {{ $item->jumlah ?? 1 }}
                        </td>

                        <td class="p-3 border text-center">

                            @if($item->status == 'menunggu')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">
                                    Menunggu
                                </span>

                            @elseif($item->status == 'dipinjam')
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">
                                    Dipinjam
                                </span>

                            @elseif($item->status == 'dikembalikan')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                    Selesai
                                </span>
                            @endif

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        @endif

    </div>

</div>
