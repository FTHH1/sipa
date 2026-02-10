<x-layouts::app.sidebar :title="'Edit Alat Musik'">

    <flux:card class="max-w-xl space-y-6">

        <flux:heading size="lg">
            Edit Alat Musik
        </flux:heading>

        <form
            method="POST"
            action="{{ route('alat-musik.update', $alatMusik) }}"
            class="space-y-4"
        >
            @csrf
            @method('PUT')

            <flux:input
                label="Kode"
                :value="$alatMusik->kode"
                disabled
            />

            <flux:input
                name="nama"
                label="Nama Alat Musik"
                :value="$alatMusik->nama"
                required
            />

            <flux:input
                name="jenis"
                label="Jenis"
                :value="$alatMusik->jenis"
                required
            />

            <flux:input
                name="merk"
                label="Merk"
                :value="$alatMusik->merk"
            />

            <flux:input
                name="stok"
                type="number"
                label="Stok"
                :value="$alatMusik->stok"
                required
            />

            <flux:select
                name="kondisi"
                label="Kondisi"
            >
                <option value="bagus" @selected($alatMusik->kondisi === 'bagus')>
                    Bagus
                </option>
                <option value="rusak" @selected($alatMusik->kondisi === 'rusak')>
                    Rusak
                </option>
                <option value="perbaikan" @selected($alatMusik->kondisi === 'perbaikan')>
                    Perbaikan
                </option>
            </flux:select>

            <flux:textarea
                name="deskripsi"
                label="Deskripsi"
            >{{ $alatMusik->deskripsi }}</flux:textarea>

            <div class="flex gap-2">
                <flux:button type="submit">
                    Update
                </flux:button>

                <flux:button
                    variant="outline"
                    :href="route('alat-musik.index')"
                    wire:navigate
                >
                    Kembali
                </flux:button>
            </div>

        </form>

    </flux:card>

</x-layouts::app.sidebar>
