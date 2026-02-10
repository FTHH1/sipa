<div wire:poll.5s class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

    <div class="rounded-xl border p-4">
        <p class="text-sm text-zinc-500">Total Alat</p>
        <p class="text-2xl font-bold">{{ $totalAlat }}</p>
    </div>

    <div class="rounded-xl border p-4">
        <p class="text-sm text-zinc-500">Total User</p>
        <p class="text-2xl font-bold">{{ $totalUser }}</p>
    </div>

    <div class="rounded-xl border p-4">
        <p class="text-sm text-zinc-500">Peminjaman Aktif</p>
        <p class="text-2xl font-bold">{{ $peminjamanAktif }}</p>
    </div>

    <div class="rounded-xl border p-4">
        <p class="text-sm text-zinc-500">Pengembalian Hari Ini</p>
        <p class="text-2xl font-bold">{{ $pengembalianHariIni }}</p>
    </div>

</div>
