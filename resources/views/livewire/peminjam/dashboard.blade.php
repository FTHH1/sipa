<div class="w-full">

    <h1 class="text-2xl font-bold mb-6">
        Dashboard Peminjam
    </h1>

    {{-- GRID --}}
    <div class="w-full grid gap-6"
         style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">

        <!-- Total -->
        <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">

            <p class="text-sm text-gray-500">
                Total Peminjaman
            </p>

            <p class="text-3xl font-bold mt-2">
                {{ $total }}
            </p>

        </div>


        <!-- Aktif -->
        <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">

            <p class="text-sm text-gray-500">
                Sedang Dipinjam
            </p>

            <p class="text-3xl font-bold mt-2">
                {{ $aktif }}
            </p>

        </div>


        <!-- Selesai -->
        <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">

            <p class="text-sm text-gray-500">
                Selesai
            </p>

            <p class="text-3xl font-bold mt-2">
                {{ $selesai }}
            </p>

        </div>


        <!-- Denda -->
        <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">

            <p class="text-sm text-gray-500">
                Total Denda
            </p>

            <p class="text-3xl font-bold mt-2">
                Rp {{ number_format($totalDenda) }}
            </p>

        </div>

    </div>

</div>
