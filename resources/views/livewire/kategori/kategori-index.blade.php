<div>

<flux:card class="max-w-6xl mx-auto space-y-6">

    {{-- HEADER --}}
    <flux:heading size="lg">
        Kategori Alat Musik
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
                {{ $isEdit ? 'Edit Kategori' : 'Tambah Kategori' }}
            </flux:heading>


            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-4">


                {{-- NAMA --}}
                <div>
                    <label class="block text-sm mb-1">Nama</label>

                    <flux:input
                        wire:model="nama"
                        placeholder="Masukkan nama kategori"
                    />

                    @error('nama')
                        <p class="text-sm text-red-500 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- DESKRIPSI --}}
                <div>
                    <label class="block text-sm mb-1">Deskripsi</label>

                    <flux:textarea
                        wire:model="deskripsi"
                        placeholder="Deskripsi kategori"
                        rows="3"
                    />
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
                Data Kategori
            </flux:heading>


            <div class="overflow-x-auto">

                <table class="w-full text-sm border border-zinc-200">

                    <thead class="bg-zinc-100 dark:bg-zinc-800">
                        <tr>
                            <th class="px-3 py-2">No</th>
                            <th class="px-3 py-2">Nama</th>
                            <th class="px-3 py-2">Deskripsi</th>
                            <th class="px-3 py-2">Aksi</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($kategoris as $item)

                            <tr class="border-t">

                                <td class="px-3 py-2 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-3 py-2">
                                    {{ $item->nama }}
                                </td>

                                <td class="px-3 py-2">
                                    {{ $item->deskripsi }}
                                </td>

                                <td class="px-3 py-2 text-center space-x-2">


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
                                <td colspan="4" class="py-6 text-center text-zinc-500">
                                    Data kategori masih kosong
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
