<div class="space-y-6">

    @props([
    'title',
    'total_user',
    'sedang_pinjam',
    'persentase'
])


    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold text-zinc-800 dark:text-white">
            {{ $title }}
        </h1>

        <p class="text-sm text-zinc-500">
            Ringkasan sistem peminjaman alat musik
        </p>
    </div>


    {{-- STAT --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-white dark:bg-zinc-900 p-4 rounded shadow">
            <p class="text-sm text-zinc-500">Total User</p>
            <p class="text-2xl font-bold">
                {{ $total_user ?? 0 }}
            </p>
        </div>

        <div class="bg-white dark:bg-zinc-900 p-4 rounded shadow">
            <p class="text-sm text-zinc-500">User Sedang Meminjam</p>
            <p class="text-2xl font-bold">
                {{ $sedang_pinjam ?? 0 }}
            </p>
        </div>

        <div class="bg-white dark:bg-zinc-900 p-4 rounded shadow">
            <p class="text-sm text-zinc-500">Persentase Pengembalian</p>
            <p class="text-2xl font-bold">
                {{ $persentase ?? 0 }}%
            </p>
        </div>

    </div>


    {{-- CONTENT --}}
    <div>
        {{ $slot }}
    </div>

</div>
