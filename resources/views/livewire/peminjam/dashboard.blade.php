<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        Dashboard Peminjam
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        {{-- Total --}}
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500">Total Peminjaman</h3>
            <p class="text-3xl font-bold">{{ $total }}</p>
        </div>

        {{-- Aktif --}}
        <div class="bg-blue-100 p-4 rounded shadow">
            <h3 class="text-gray-600">Sedang Dipinjam</h3>
            <p class="text-3xl font-bold">{{ $aktif }}</p>
        </div>

        {{-- Selesai --}}
        <div class="bg-green-100 p-4 rounded shadow">
            <h3 class="text-gray-600">Selesai</h3>
            <p class="text-3xl font-bold">{{ $selesai }}</p>
        </div>

        {{-- Denda --}}
        <div class="bg-red-100 p-4 rounded shadow">
            <h3 class="text-gray-600">Total Denda</h3>
            <p class="text-3xl font-bold">
                Rp {{ number_format($totalDenda) }}
            </p>
        </div>

    </div>

</div>
