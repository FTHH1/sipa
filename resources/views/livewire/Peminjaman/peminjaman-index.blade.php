<div class="bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">
        Monitoring Peminjaman
    </h2>


    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif


    {{-- ================= FORM EDIT ================= --}}
      @if($isEdit)

<div class="border rounded p-4 mb-4">

    <h3 class="font-bold mb-3">Edit Peminjaman</h3>

    <div class="grid grid-cols-3 gap-3">

        <div>
            <label>Peminjam</label>
            <select wire:model="user_id" class="w-full border rounded p-2">
                <option value="">-- Pilih --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Alat</label>
            <select wire:model="alat_id" class="w-full border rounded p-2">
                <option value="">-- Pilih --</option>
                @foreach($alats as $a)
                    <option value="{{ $a->id }}">{{ $a->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Jumlah</label>
            <input type="number" wire:model="jumlah"
                class="w-full border rounded p-2">
        </div>

        <div>
            <label>Tgl Pinjam</label>
            <input type="date" wire:model="tanggal_pinjam"
                class="w-full border rounded p-2">
        </div>

        <div>
            <label>Status</label>
            <select wire:model="status" class="w-full border rounded p-2">
                <option value="pending">Pending</option>
                <option value="dipinjam">Dipinjam</option>
                <option value="dikembalikan">Dikembalikan</option>
            </select>
        </div>

    </div>

    <div class="mt-3 flex gap-2">

        <button wire:click="update"
            class="bg-blue-600 text-black px-4 py-2 rounded">
            Update
        </button>

        <button wire:click="resetForm"
            class="bg-gray-500 text-black px-4 py-2 rounded">
            Batal
        </button>

    </div>

</div>

@endif



    {{-- ================= TABLE ================= --}}
    <table class="w-full border text-sm">

        <thead class="bg-gray-100">

            <tr>
                <th class="p-2 border">No</th>
                <th class="p-2 border">User</th>
                <th class="p-2 border">Alat</th>
                <th class="p-2 border">Jumlah</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>

        </thead>


        <tbody>

        @forelse($peminjamans as $p)

            <tr class="text-center border-t">

                <td class="p-2">{{ $loop->iteration }}</td>

                <td class="p-2">{{ $p->user->name ?? '-' }}</td>

                <td class="p-2">{{ $p->alat->nama ?? '-' }}</td>

                <td class="p-2">{{ $p->jumlah }}</td>

                <td class="p-2">
                    {{ $p->tanggal_pinjam }} <br>
                </td>

                <td class="p-2 font-semibold">

                    @if($p->status == 'pending')
                        <span class="text-orange-500">Pending</span>
                    @elseif($p->status == 'dipinjam')
                        <span class="text-blue-600">Dipinjam</span>
                    @elseif($p->status == 'dikembalikan')
                        <span class="text-green-600">Dikembalikan</span>
                    @elseif($p->status == 'ditolak')
                        <span class="text-red-600">Ditolak</span>
                    @endif

                </td>


                {{-- AKSI --}}
                <td class="p-2">

                    <div class="flex justify-center gap-2">

                        <button
                            wire:click="edit({{ $p->id }})"
                            class="px-3 py-1 text-xs rounded-md border
                                bg-white  shadow-sm">

                            Edit
                        </button>


                        <button
                            wire:click="delete({{ $p->id }})"
                            onclick="return confirm('Hapus data ini?')"
                            class="px-3 py-1 text-xs rounded-md
                                bg-red-500 text-black shadow-sm">

                            Hapus
                        </button>

                    </div>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7"
                    class="p-4 text-center text-gray-500">

                    Belum ada peminjaman
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>
