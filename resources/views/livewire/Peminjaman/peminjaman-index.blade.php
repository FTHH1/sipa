    <div>

        <flux:card class="max-w-6xl mx-auto space-y-6">

            {{-- JUDUL --}}
            <flux:heading size="lg">
                Data Peminjaman
            </flux:heading>


            {{-- ALERT --}}
            @if (session()->has('success'))
                <flux:card class="bg-green-50 text-green-700 p-3">
                    {{ session('success') }}
                </flux:card>
            @endif


            <div class="grid grid-cols-1 gap-6">

                {{-- TABLE --}}
                        <flux:card class="w-full">

                            <div class="w-full overflow-x-auto">

                                <table class="w-full text-sm ">

                                    <thead class="bg-zinc-100">
                                        <tr>
                                            <th class="p-3 text-left">No</th>
                                            <th class="p-3 text-left">User</th>
                                            <th class="p-3 text-left">Alat</th>
                                            <th class="p-3 text-center">Jumlah</th>
                                            <th class="p-3 text-center">Pinjam</th>
                                            <th class="p-3 text-center">Kembali</th>
                                            <th class="p-3 text-center">Status</th>
                                            <th class="p-3 text-center">Denda</th>
                                            <th class="p-3 text-center">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($peminjamans as $item)

                                        <tr class="border-t">

                                            <td class="p-3">{{ $loop->iteration }}</td>

                                            <td class="p-3">
                                                {{ $item->user->name ?? '-' }}
                                            </td>

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

                                            <td class="p-3 text-center font-semibold">
                                                {{ ucfirst($item->status) }}
                                            </td>

                                            <td class="p-3 text-center text-red-600">
                                                Rp {{ number_format($item->denda,0,',','.') }}
                                            </td>

                                            <td class="p-3 text-center space-x-1">

                                                <flux:button
                                                    size="sm"
                                                    variant="outline"
                                                    wire:click="edit({{ $item->id }})"
                                                >
                                                    Edit
                                                </flux:button>

                                                <flux:button
                                                    size="sm"
                                                    variant="danger"
                                                    wire:click="delete({{ $item->id }})"
                                                    onclick="return confirm('Hapus data?')"
                                                >
                                                    Hapus
                                                </flux:button>

                                            </td>

                                        </tr>

                                        @empty

                                        <tr>
                                            <td colspan="9" class="p-6 text-center text-zinc-500">
                                                Data kosong
                                            </td>
                                        </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </flux:card>


            </div>

        </flux:card>


                {{-- ================= --}}
{{-- DATA PENGEMBALIAN --}}
{{-- ================= --}}

<flux:card class="mt-10 w-full">

    <flux:heading size="sm" class="mb-4">
        Monitoring Pengembalian
    </flux:heading>

    <div class="overflow-x-auto">

        <table class="w-full text-sm border">

            <thead class="bg-zinc-100">

                <tr>
                    <th class="p-2">No</th>
                    <th class="p-2">User</th>
                    <th class="p-2">Alat</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Tanggal</th>
                </tr>

            </thead>

            <tbody>

            @forelse($pengembalians as $item)

                <tr class="border-t text-center">

                    <td class="p-2">{{ $loop->iteration }}</td>

                    <td class="p-2">
                        {{ $item->user->name ?? '-' }}
                    </td>

                    <td class="p-2">
                        {{ $item->alat->nama ?? '-' }}
                    </td>

                    <td class="p-2">
                        {{ $item->jumlah }}
                    </td>

                    <td class="p-2 font-semibold">

                        @if($item->status == 'minta_kembali')
                            <span class="text-orange-600">
                                Menunggu Verifikasi
                            </span>
                        @elseif($item->status == 'dikembalikan')
                            <span class="text-green-600">
                                Selesai
                            </span>
                        @endif

                    </td>

                    <td class="p-2">
                        {{ $item->updated_at->format('d-m-Y') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6"
                        class="p-4 text-center text-gray-500">

                        Belum ada pengembalian

                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</flux:card>

</div>
