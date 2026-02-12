<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">
        Pinjaman Saya
    </h2>

    {{-- Alert --}}
    @if (session()->has('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-xl border">

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left">Alat</th>
                    <th class="p-3">Jumlah</th>
                    <th class="p-3">Tgl Pinjam</th>
                    <th class="p-3">Tgl Kembali</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($peminjamans as $item)

                <tr class="border-t">

                    <td class="p-3">
                        {{ $item->alat->nama ?? '-' }}
                    </td>

                    <td class="p-3 text-center">
                        {{ $item->jumlah }}
                    </td>

                    <td class="p-3 text-center">
                        {{ $item->tanggal_pinjam }}
                    </td>

                    <td class="p-3 text-center">
                        {{ $item->tanggal_kembali }}
                    </td>

                    <td class="p-3 text-center">

                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold

                            @if($item->status == 'pending')
                                bg-yellow-100 text-yellow-700
                            @elseif($item->status == 'disetujui')
                                bg-blue-100 text-blue-700
                            @elseif($item->status == 'dipinjam')
                                bg-green-100 text-green-700
                            @elseif($item->status == 'dikembalikan')
                                bg-gray-200 text-gray-700
                            @else
                                bg-red-100 text-red-700
                            @endif
                            "
                        >
                            {{ ucfirst($item->status) }}

                        </span>

                    </td>

                    <td class="p-3 text-center">

                                {{-- Jika sedang dipinjam --}}
                                @if($item->status == 'dipinjam')

                                    <button
                                        wire:click="kembalikan({{ $item->id }})"
                                        onclick="confirm('Ajukan pengembalian?') || event.stopImmediatePropagation()"
                                        class="px-4 py-1 bg-red-600 text-black rounded hover:bg-red-700"
                                    >
                                        Ajukan Pengembalian
                                    </button>

                                {{-- Jika sudah minta kembali --}}
                                @elseif($item->status == 'minta_kembali')

                                    <span class="text-yellow-600 text-sm font-semibold">
                                        Menunggu Verifikasi
                                    </span>

                                @else
                                    -
                                @endif

                            </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">
                        Belum ada pinjaman
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
