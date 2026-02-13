<div class="bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">
        Monitoring Pengembalian
    </h2>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
            {{ session('success') }}
        </div>
    @endif


    {{-- ================= FORM EDIT ================= --}}
    @if($isEdit)

        <div class="mb-6 p-4 border rounded bg-gray-50">

            <h3 class="font-semibold mb-3">Edit Pengembalian</h3>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="text-sm">Jumlah</label>
                    <input type="number"
                        wire:model="jumlah"
                        class="w-full border rounded px-2 py-1">
                </div>

                <div>
                    <label class="text-sm">Status</label>
                    <select wire:model="status"
                        class="w-full border rounded px-2 py-1">

                        <option value="dikembalikan">Dikembalikan</option>
                        <option value="dipinjam">Dipinjam</option>

                    </select>
                </div>

            </div>

            <div class="mt-4 space-x-2">

                <button
                    wire:click="update"
                    class="bg-blue-600 text-black px-4 py-1 rounded">

                    Update
                </button>

                <button
                    wire:click="resetForm"
                    class="bg-gray-400 px-4 py-1 rounded">

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
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Aksi</th>
            </tr>

        </thead>

        <tbody>

        @forelse($pengembalians as $item)

            <tr class="text-center border-t">

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

                <td class="p-2 text-green-600 font-semibold">
                    Selesai
                </td>

                <td class="p-2">
                    {{ $item->updated_at->format('d-m-Y') }}
                </td>

                <td class="p-2 text-center">

                        <div class="flex justify-center gap-2">

                            {{-- EDIT --}}
                            <button
                                wire:click="edit({{ $item->id }})"
                                class="px-3 py-1 text-xs rounded-md border
                                    border-gray-300 bg-white text-gray-700
                                    hover:bg-gray-100 transition">

                                Edit
                            </button>


                            {{-- HAPUS --}}
                            <button
                                wire:click="delete({{ $item->id }})"
                                onclick="return confirm('Hapus data ini?')"
                                class="px-3 py-1 text-xs rounded-md
                                    bg-red-500 text-white
                                    hover:bg-red-600 transition">

                                Hapus
                            </button>

                        </div>

                    </td>


            </tr>

        @empty

            <tr>
                <td colspan="7" class="p-4 text-center text-gray-500">
                    Belum ada pengembalian
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>
