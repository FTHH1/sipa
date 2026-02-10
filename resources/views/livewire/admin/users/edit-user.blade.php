<div>
    <flux:card class="max-w-xl">
        <h2 class="text-lg font-semibold mb-4">Edit User</h2>

        <form wire:submit.prevent="save" class="space-y-4">

            <div>
                <label class="text-sm font-medium">Nama</label>
                <input
                    type="text"
                    wire:model.defer="user.name"
                    class="w-full border rounded px-3 py-2"
                />
            </div>

            <div>
                <label class="text-sm font-medium">Email</label>
                <input
                    type="email"
                    wire:model.defer="user.email"
                    class="w-full border rounded px-3 py-2"
                />
            </div>

            <div>
                <label class="text-sm font-medium">Role</label>
                <select
                    wire:model.defer="user.role"
                    class="w-full border rounded px-3 py-2"
                >
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="peminjam">Peminjam</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700"
                >
                    Simpan
                </button>

                <button
                    type="button"
                    onclick="confirm('Yakin hapus user ini?') || event.stopImmediatePropagation()"
                    wire:click="delete"
                    class="px-4 py-2 bg-red-600 text-black rounded hover:bg-red-700"
                >
                    Hapus
                </button>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                >
                    Batal
                </a>
            </div>

        </form>
    </flux:card>
</div>
