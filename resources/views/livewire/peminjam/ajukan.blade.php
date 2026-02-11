    <div class="px-4 py-7">

        <div class="w-full max-w-3xl mx-auto bg-white rounded-xl border p-8">

            {{-- Judul --}}
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">
                Ajukan Peminjaman
            </h2>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- LEFT : INFO ALAT --}}
                <div class="space-y-5">

                    {{-- Gambar --}}
                    <div
                        class="w-full h-56 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden border">

                        @if($alat->gambar)
                            <img src="{{ asset('storage/'.$alat->gambar) }}"
                                class="w-full h-full object-contain">
                        @else
                            <span class="text-gray-400">No Image</span>
                        @endif

                    </div>


                    {{-- Detail --}}
                    <div class="space-y-2">

                        <h3 class="text-2xl font-semibold text-gray-800">
                            {{ $alat->nama }}
                        </h3>

                        <p class="text-gray-600">
                            <span class="font-medium">Kategori:</span>
                            {{ $alat->kategori->nama ?? '-' }}
                        </p>

                        <p class="text-gray-600">
                            <span class="font-medium">Merk:</span>
                            {{ $alat->merk ?? '-' }}
                        </p>

                        <p class="text-gray-600">
                            <span class="font-medium">Kondisi:</span>
                            {{ $alat->kondisi ?? '-' }}
                        </p>

                        <p class="text-gray-600">
                            <span class="font-medium">Stok:</span>
                            {{ $alat->stok }}
                        </p>


                        {{-- Status --}}
                        <span
                            class="inline-block mt-2 px-4 py-1 rounded-full text-sm font-medium
                            {{ $alat->stok > 0
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700' }}">

                            {{ $alat->stok > 0 ? 'Tersedia' : 'Habis' }}

                        </span>

                    </div>

                </div>



                {{-- RIGHT : FORM --}}
                <div>

                    @if($alat->stok > 0)

                    {{-- Alert sukses --}}
                        @if (session()->has('success'))
                        <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">
                            {{ session('success') }}
                        </div>
                        @endif


                    <form wire:submit.prevent="submit" class="space-y-6">

                        {{-- Tgl Pinjam --}}
                    <div>
                        <label class="font-semibold text-sm">Tanggal Pinjam</label>

                        <input type="date"
                            wire:model.defer="tanggal_pinjam"
                            class="w-full max-w-xs border rounded-lg px-3 py-2 mt-1
                            @error('tanggal_pinjam') border-red-500 @enderror">

                        @error('tanggal_pinjam')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>



                        {{-- Tgl Kembali --}}
                        <div>
                            <label class="font-semibold text-sm">Tanggal Kembali</label>

                            <input type="date"
                                wire:model.defer="tanggal_kembali"
                                class="w-full max-w-xs border rounded-lg px-3 py-2 mt-1
                                @error('tanggal_kembali') border-red-500 @enderror">

                            @error('tanggal_kembali')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah Pinjam --}}
                                <div>
                                    <label class="font-semibold text-sm">Jumlah Pinjam</label>

                                    <input type="number"
                                        min="1"
                                        max="{{ $alat->stok }}"
                                        wire:model.defer="jumlah"
                                        class="w-full max-w-xs border rounded-lg px-3 py-2 mt-1
                                        
                                        @error('jumlah') border-red-500 @enderror"
                                        placeholder="Masukkan jumlah">

                                    <small class="text-gray-500">
                                        Maksimal: {{ $alat->stok }}
                                    </small>

                                    @error('jumlah')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                            {{-- Catatan / Tujuan Peminjaman --}}
                                    <div class="mt-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Catatan / Tujuan Peminjaman
                                        </label>

                                        <textarea
                                            wire:model.defer="catatan"
                                            rows="3"
                                            placeholder="Contoh: Digunakan untuk latihan band acara kampus"
                                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                        ></textarea>

                                        @error('catatan')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>



                        {{-- Tombol --}}
                    <div class="pt-4 flex justify-start">
                                        <button type="submit"
                                                    class="px-6 bg-blue-600 text-black py-3 rounded-xl
                                                        font-semibold text-base
                                                        hover:bg-blue-700 hover:shadow-xl
                                                        transition duration-300">

                                Ajukan Peminjaman

                            </button>

                        </div>

                    </form>

                    @else

                        <div
                            class="bg-red-100 text-red-700 p-4 rounded-lg text-center font-medium">

                            Stok habis, tidak bisa dipinjam

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>
