<div class="space-y-4">
    <flux:heading size="lg">Activity Log</flux:heading>

    {{-- FILTER --}}
    <flux:card class="flex gap-4">
        <div>
            <label class="text-sm">Filter Role</label>
            <select wire:model="role" class="border rounded px-3 py-2">
                <option value="">Semua</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
                <option value="peminjam">Peminjam</option>
            </select>
        </div>

        <div>
            <label class="text-sm">Tanggal</label>
            <input
                type="date"
                wire:model="date"
                class="border rounded px-3 py-2"
            />
        </div>
    </flux:card>

    {{-- TABLE --}}
    <flux:card>
        <table class="w-full text-center">
            <thead class="border-b">
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Aksi</th>
                    <th>Deskripsi</th>
                    <th>Waktu</th>
                </tr>
            </thead>

            <tbody>
                @forelse($logs as $log)
                    <tr class="border-b">
                        <td>{{ $log->user->name ?? '-' }}</td>
                        <td>{{ ucfirst($log->user->role ?? '-') }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-gray-500">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </flux:card>
</div>
