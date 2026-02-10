<x-layouts::app.sidebar :title="'Alat Musik'">

    <flux:card class="space-y-4">

        <div class="flex items-center justify-between">
            <flux:heading size="lg">
                Data Alat Musik
            </flux:heading>

            <flux:button
                :href="route('alat-musik.create')"
                icon="plus"
                wire:navigate
            >
                Tambah
            </flux:button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-zinc-200">
                <thead class="bg-zinc-100 dark:bg-zinc-800">
                    <tr>
                        <th class="px-3 py-2 text-left">Kode</th>
                        <th class="px-3 py-2 text-left">Nama</th>
                        <th class="px-3 py-2 text-left">Merk</th>
                        <th class="px-3 py-2 text-left">Jenis</th>
                        <th class="px-3 py-2 text-left">Stok</th>
                        <th class="px-3 py-2 text-left">Kondisi</th>
                        <th class="px-3 py-2 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($alatMusik as $item)
                        <tr class="border-t">
                            <td class="px-3 py-2">{{ $item->kode }}</td>
                            <td class="px-3 py-2">{{ $item->nama }}</td>
                            <td class="px-3 py-2">
                                {{ $item->merk ?? '-' }}
                            </td>
                            <td class="px-3 py-2">{{ $item->jenis }}</td>
                            <td class="px-3 py-2">{{ $item->stok }}</td>
                            <td class="px-3 py-2 capitalize">{{ $item->kondisi }}</td>
                            <td class="px-3 py-2 text-center space-x-2">

                                <flux:button
                                    size="sm"
                                    variant="outline"
                                    :href="route('alat-musik.edit', $item)"
                                    wire:navigate
                                >
                                    Edit
                                </flux:button>

                                <form
                                    action="{{ route('alat-musik.destroy', $item) }}"
                                    method="POST"
                                    class="inline"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <flux:button
                                        size="sm"
                                        variant="danger"
                                        type="submit"
                                        onclick="return confirm('Hapus data ini?')"
                                    >
                                        Hapus
                                    </flux:button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-6 text-center text-zinc-500">
                                Data alat musik masih kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </flux:card>

</x-layouts::app.sidebar>
