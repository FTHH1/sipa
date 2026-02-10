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


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


            {{-- FORM --}}
            <flux:card>

                <flux:heading size="sm" class="mb-4">
                    {{ $isEdit ? 'Edit Peminjaman' : 'Tambah Peminjaman' }}
                </flux:heading>


                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">


                    {{-- USER --}}
                    <div>
                        <label class="block text-sm mb-1">Peminjam</label>

                        <select
                            wire:model="user_id"
                            class="w-full border rounded p-2"
                        >
                            <option value="">-- Pilih User --</option>

                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- ALAT --}}
                    <div>
                        <label class="block text-sm mb-1">Alat Musik</label>

                        <select
                            wire:model="alat_musik_id"
                            class="w-full border rounded p-2"
                        >
                            <option value="">-- Pilih Alat --</option>

                            @foreach($alats as $alat)
                                <option value="{{ $alat->id }}">
                                    {{ $alat->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- JUMLAH --}}
                    <div>
                        <label class="block text-sm mb-1">Jumlah</label>

                        <flux:input
                            type="number"
                            wire:model="jumlah"
                        />
                    </div>


                    {{-- TANGGAL PINJAM --}}
                    <div>
                        <label class="block text-sm mb-1">Tanggal Pinjam</label>

                        <flux:input
                            type="date"
                            wire:model="tanggal_pinjam"
                        />
                    </div>


                    {{-- TANGGAL KEMBALI --}}
                    <div>
                        <label class="block text-sm mb-1">Tanggal Kembali</label>

                        <flux:input
                            type="date"
                            wire:model="tanggal_kembali"
                        />
                    </div>


                  {{-- STATUS --}}
                    <div>
                        <label class="block text-sm mb-1">Status</label>

                        <select
                            wire:model="status"
                            class="w-full border rounded p-2"
                        >
                            <option value="dipinjam">Dipinjam</option>
                            <option value="dikembalikan">Dikembalikan</option>
                        </select>
                    </div>



                    {{-- BUTTON --}}
                    <div class="flex gap-2">

                        <flux:button type="submit">
                            {{ $isEdit ? 'Update' : 'Simpan' }}
                        </flux:button>


                        @if($isEdit)
                            <flux:button
                                variant="outline"
                                type="button"
                                wire:click="resetForm"
                            >
                                Batal
                            </flux:button>
                        @endif

                    </div>

                </form>

            </flux:card>


            {{-- TABLE --}}
            <flux:card>

                <flux:heading size="sm" class="mb-4">
                    Data Peminjaman
                </flux:heading>


                <div class="overflow-x-auto">

                    <table class="w-full text-sm border">

                        <thead class="bg-zinc-100">
                            <tr>
                                <th class="p-2">No</th>
                                <th class="p-2">User</th>
                                <th class="p-2">Alat</th>
                                <th class="p-2">Jumlah</th>
                                <th class="p-2">Pinjam</th>
                                <th class="p-2">Kembali</th>
                                <th class="p-2">Status</th>
                                <th class="p-2">Denda</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>


                        <tbody>

                            @forelse($peminjamans as $item)

                                <tr class="border-t text-center">

                                    <td class="p-2">{{ $loop->iteration }}</td>

                                    <td class="p-2">
                                        {{ $item->user->name ?? '-' }}
                                    </td>

                                    <td class="p-2">
                                        {{ $item->alat->nama ?? '-' }}
                                    </td>

                                    <td class="p-2">{{ $item->jumlah }}</td>

                                    <td class="p-2">{{ $item->tanggal_pinjam }}</td>

                                    <td class="p-2">{{ $item->tanggal_kembali }}</td>

                                    <td class="p-2">{{ $item->status }}</td>
                                    <td class="p-2 text-red-600 font-semibold">
                                            Rp {{ number_format($item->denda,0,',','.') }}
                                        </td>



                                    <td class="p-2 space-x-1">

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
                                    <td colspan="8" class="p-4 text-center text-zinc-500">
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

</div>
