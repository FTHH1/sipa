<div>
    <input type="text" wire:model="name" placeholder="Name">
    <input type="email" wire:model="email" placeholder="Email">
    <input type="password" wire:model="password" placeholder="Password">

        <select wire:model="role">
            <option value="peminjam">Peminjam</option>
            <option value="petugas">Petugas</option>
            <option value="admin">Admin</option>
        </select>

    <button wire:click="save">Simpan</button>
</div>
