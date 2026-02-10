<div class="space-y-4">

    <flux:heading size="lg">
        Activity Log
    </flux:heading>

    {{-- FILTER --}}
    <flux:card class="flex flex-wrap gap-4">

        <div class="flex flex-col gap-1">
            <label class="text-sm font-medium">Filter Role</label>
            <select
                wire:model="role"
                class="border rounded px-3 py-2 text-sm"
            >
                <option value="">Semua</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
                <option value="peminjam">Peminjam</option>
            </select>
        </div>

        <div class="flex flex-col gap-1">
            <label class="text-sm font-medium">Tanggal</label>
            <input
                type="date"
                wire:model="date"
                class="border rounded px-3 py-2 text-sm"
            />
        </div>

    </flux:card>

    {{-- TABLE --}}
    <flux:card class="overflow-x-auto">

        <table class="w-full text-sm text-left border border-zinc-200">
            <thead class="bg-zinc-100 dark:bg-zinc-800">
                <tr>
                    <th class="px-3 py-2">User</th>
                    <th class="px-3 py-2">Role</th>
                    <th class="px-3 py-2">Aksi</th>
                    <th class="px-3 py-2">Deskripsi</th>
                    <th class="px-3 py-2">Waktu</th>
                </tr>
            </thead>

            <tbody>
                @forelse($logs as $log)
                    <tr class="border-t">
                        <td class="px-3 py-2">{{ $log->user->name ?? '-' }}</td>
                        <td class="px-3 py-2 capitalize">{{ $log->user->role ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $log->action }}</td>
                        <td class="px-3 py-2">{{ $log->description }}</td>
                        <td class="px-3 py-2">{{ $log->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-zinc-500">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </flux:card>

</div>
