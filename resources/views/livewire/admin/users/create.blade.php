<div>
    <h2 class="text-lg font-semibold mb-4">Tambah User</h2>

    <form wire:submit.prevent="save" class="space-y-4">

        <div>
            <label>Nama</label>
            <input type="text" wire:model.defer="name" class="w-full border p-2">
        </div>

        <div>
            <label>Email</label>
            <input type="email" wire:model.defer="email" class="w-full border p-2">
        </div>

        <div>
            <label>Password</label>
            <input type="password" wire:model.defer="password" class="w-full border p-2">
        </div>

        <div>
            <label>Role</label>
            <select wire:model.defer="role" class="w-full border p-2">
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
                <option value="peminjam">Peminjam</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">
            Simpan
        </button>

    </form>
</div>
