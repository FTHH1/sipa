<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">
        Daftar Alat Musik
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach($alatMusik as $alat)

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4
                        hover:shadow-md transition duration-200">

             //

                {{-- Nama --}}
                <h3 class="font-bold text-lg">
                    {{ $alat->nama }}
                </h3>

                {{-- Kategori --}}
                <p class="text-sm text-gray-500">
                    {{ $alat->kategori->nama ?? '-' }}
                </p>

                {{-- Merk --}}
                <p class="mt-1 text-sm text-gray-600">
                    <span class="font-semibold">Merk:</span>
                    {{ $alat->merk ?? '-' }}
                </p>

                {{-- Kondisi --}}
                <p class="text-sm text-gray-600">
                    <span class="font-semibold">Kondisi:</span>

                    @if($alat->kondisi === 'baik')
                        <span class="text-green-600 font-medium">Baik</span>
                    @elseif($alat->kondisi === 'rusak ringan')
                        <span class="text-yellow-600 font-medium">Rusak Ringan</span>
                    @elseif($alat->kondisi === 'rusak berat')
                        <span class="text-red-600 font-medium">Rusak Berat</span>
                    @else
                        <span>-</span>
                    @endif
                </p>

                {{-- Stok --}}
                <p class="mt-2 text-sm font-semibold">
                    Stok: {{ $alat->stok }}
                </p>

                {{-- Status --}}
                <span class="inline-block mt-1 px-2 py-1 rounded text-xs
                    {{ $alat->stok > 0
                        ? 'bg-green-100 text-green-700'
                        : 'bg-red-100 text-red-700' }}">
                    {{ $alat->stok > 0 ? 'Tersedia' : 'Habis' }}
                </span>

                {{-- Button --}}
                @if($alat->stok > 0)
                    <a href="{{ route('peminjam.ajukan', $alat->id) }}"
                        class="block text-center mt-4 bg-blue-600 text-black py-2 rounded-lg
                                hover:bg-blue-700
                                hover:shadow-lg
                                hover:-translate-y-0.5
                                transition-all duration-200">
                            Pinjam
                        </a>
                @endif

            </div>

        @endforeach

    </div>

</div>
