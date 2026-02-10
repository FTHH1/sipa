<div>

    <h2 class="text-xl font-bold mb-4">Kelola Alat Musik</h2>

    @if (session()->has('success'))
        <div class="bg-green-200 p-2 mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM --}}
    <div class="border p-4 mb-5 rounded">

        <h3 class="font-semibold mb-3">Tambah / Edit Alat</h3>

        <input type="text" wire:model="nama"
            placeholder="Nama Alat"
            class="w-full border p-2 mb-2">

        <select wire:model="kategori_id"
            class="w-full border p-2 mb-2">

            <option value="">-- Pilih Kategori --</option>

            @foreach ($kategori as $k)
                <option value="{{ $k->id }}">
                    {{ $k->nama }}
                </option>
            @endforeach
        </select>

        <input type="text" wire:model="merk"
            placeholder="Merk"
            class="w-full border p-2 mb-2">

        <input type="number" wire:model="stok"
            placeholder="Stok"
            class="w-full border p-2 mb-2">

        <input type="text" wire:model="kondisi"
            placeholder="Kondisi"
            class="w-full border p-2 mb-2">

        <textarea wire:model="deskripsi"
            placeholder="Deskripsi"
            class="w-full border p-2 mb-3"></textarea>

        <button wire:click="simpan"
            class="bg-blue-500 text-white px-4 py-2 rounded">
            Simpan
        </button>

        <button wire:click="resetForm"
            class="bg-gray-400 text-white px-4 py-2 rounded">
            Batal
        </button>

    </div>


    {{-- TABEL --}}
    <table class="w-full border">

        <thead class="bg-gray-200">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Kategori</th>
                <th class="border p-2">Merk</th>
                <th class="border p-2">Stok</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($alat as $a)
                <tr>
                    <td class="border p-2">{{ $loop->iteration }}</td>
                    <td class="border p-2">{{ $a->nama }}</td>
                    <td class="border p-2">
                        {{ $a->kategori->nama ?? '-' }}
                    </td>
                    <td class="border p-2">{{ $a->merk }}</td>
                    <td class="border p-2">{{ $a->stok }}</td>

                    <td class="border p-2">

                        <button wire:click="edit({{ $a->id }})"
                            class="bg-yellow-400 px-2 rounded">
                            Edit
                        </button>

                        <button wire:click="hapus({{ $a->id }})"
                            class="bg-red-500 text-white px-2 rounded"
                            onclick="return confirm('Hapus?')">
                            Hapus
                        </button>

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

</div>
