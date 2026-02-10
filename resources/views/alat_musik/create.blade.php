<x-layouts::app.sidebar :title="'Tambah Alat Musik'">

    <flux:card class="max-w-xl space-y-6">

        <flux:heading size="lg">
            Tambah Alat Musik
        </flux:heading>

        <form
            method="POST"
            action="{{ route('alat-musik.store') }}"
            class="space-y-4"
        >
            @csrf

            <flux:input
                name="nama"
                label="Nama Alat Musik"
                required
            />

            <flux:input
                name="jenis"
                label="Jenis Alat Musik"
                required
            />

            <flux:input
                name="merk"
                label="Merk"
            />

            <flux:input
                name="stok"
                type="number"
                label="Stok"
                required
            />

            <flux:select
                name="kondisi"
                label="Kondisi"
            >
                <option value="bagus">Bagus</option>
                <option value="rusak">Rusak</option>
                <option value="perbaikan">Perbaikan</option>
            </flux:select>

            <flux:textarea
                name="deskripsi"
                label="Deskripsi"
            />

            <div class="flex gap-2">
                <flux:button type="submit">
                    Simpan
                </flux:button>

                <flux:button
                    variant="outline"
                    :href="route('alat-musik.index')"
                    wire:navigate
                >
                    Batal
                </flux:button>
            </div>

        </form>

    </flux:card>

</x-layouts::app.sidebar>
