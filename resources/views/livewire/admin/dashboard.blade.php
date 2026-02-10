<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold">Data Petugas</h1>
        <p class="text-sm text-gray-500">
            Ringkasan sistem peminjaman alat musik
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border p-4">
            <p class="text-sm text-gray-500">Total User</p>
            <p class="text-2xl font-bold">{{ $totalUser }}</p>
        </div>

        <div class="bg-white rounded-xl border p-4">
            <p class="text-sm text-gray-500">User Sedang Meminjam</p>
            <p class="text-2xl font-bold">{{ $userMeminjam }}</p>
        </div>

        <div class="bg-white rounded-xl border p-4">
            <p class="text-sm text-gray-500">Persentase Pengembalian</p>
            <p class="text-2xl font-bold">{{ $persentasePengembalian }}%</p>
        </div>
    </div>
</div>
