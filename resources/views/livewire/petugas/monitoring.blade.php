<div class="bg-white p-4 rounded shadow">

    <h2 class="font-bold mb-4 text-lg">
        Monitoring Peminjaman
    </h2>

    {{-- ALERT --}}
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- ================= TABLE PEMINJAMAN ================= --}}
    <table class="w-full border text-sm mb-8">

        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">User</th>
                <th class="p-2 border">Alat</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse ($peminjamans->whereIn('status',['pending','disetujui']) as $p)

            <tr>
                <td class="p-2 border">{{ $p->user->name }}</td>
                <td class="p-2 border">{{ $p->alat->nama ?? '-' }}</td>
                <td class="p-2 border">{{ $p->created_at->format('d-m-Y') }}</td>

                <td class="p-2 border text-center">
                    <span class="font-semibold text-blue-600">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>

                <td class="p-2 border text-center space-x-2">

                    {{-- SETUJUI --}}
                    @if($p->status == 'pending')
                        <button
                            wire:click="setujui({{ $p->id }})"
                            class="px-2 py-1 bg-green-600 text-black rounded text-xs"
                        >
                            Setujui
                        </button>

                        <button
                            wire:click="tolak({{ $p->id }})"
                            class="px-2 py-1 bg-red-600 text-black rounded text-xs"
                        >
                            Tolak
                        </button>
                    @endif


                    {{-- PINJAMKAN --}}
                    @if($p->status == 'disetujui')
                        <button
                            wire:click="pinjamkan({{ $p->id }})"
                            class="px-2 py-1 bg-blue-600 text-black rounded text-xs"
                        >
                            Pinjamkan
                        </button>
                    @endif

                </td>
            </tr>

        @empty
            <tr>
                <td colspan="5" class="text-center p-4 text-gray-500">
                    Tidak ada data
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>



    {{-- ================= MONITORING PENGEMBALIAN ================= --}}
    <h2 class="font-bold mb-4 text-lg">
        Monitoring Pengembalian
    </h2>


    <table class="w-full border text-sm">

        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">User</th>
                <th class="p-2 border">Alat</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse ($peminjamans->where('status','minta_kembali') as $p)

            <tr>

                <td class="p-2 border">{{ $p->user->name }}</td>
                <td class="p-2 border">{{ $p->alat->nama ?? '-' }}</td>
                <td class="p-2 border">{{ $p->updated_at->format('d-m-Y') }}</td>

                <td class="p-2 border text-center">
                    <span class="font-semibold text-orange-600">
                        Minta Kembali
                    </span>
                </td>

                <td class="p-2 border text-center">

                    <button
                        wire:click="terimaPengembalian({{ $p->id }})"
                        class="px-3 py-1 bg-orange-600 text-black rounded text-xs hover:bg-orange-700"
                    >
                        Terima Kembali
                    </button>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" class="text-center p-4 text-gray-500">
                    Tidak ada pengembalian
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>
