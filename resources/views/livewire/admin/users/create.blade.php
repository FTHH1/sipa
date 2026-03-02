<form wire:submit.prevent="save" class="space-y-4">

    <div>
        <label>Nama</label>
        <input type="text" wire:model.defer="name" class="w-full border p-2 rounded">
    </div>

    <div>
        <label>Email</label>
        <input type="email" wire:model.defer="email" class="w-full border p-2 rounded">
    </div>

    {{-- NO HP --}}
    <div>
        <label class="block font-medium mb-1">No Handphone *</label>
        <input
            type="text"
            wire:model.defer="no_hp"
            class="w-full border p-2 rounded"
            placeholder="08xxxxxxxxxx"
            autocomplete="tel"
            required
        >
        @error('no_hp')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    {{-- ALAMAT --}}
    <div>
        <label class="block font-medium mb-1">Alamat *</label>
        <input
            type="text"
            wire:model.defer="alamat"
            class="w-full border p-2 rounded"
            placeholder="Isikan Alamat Mu Disini"
            autocomplete="street-address"
            required
        >
        @error('alamat')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label>Password</label>
        <input type="password" wire:model.defer="password" class="w-full border p-2 rounded">
    </div>

    <div>
        <label>Role</label>
        <select wire:model.defer="role" class="w-full border p-2 rounded">
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
            <option value="peminjam">Peminjam</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700 cursor-pointer transition">
        Simpan
    </button>

</form>
