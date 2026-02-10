<div class="space-y-4">
    <flux:heading size="lg">Manajemen User</flux:heading>

    <flux:card>
        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b bg-zinc-100 dark:bg-zinc-800">
                    <th class="px-4 py-3 text-center text-sm font-semibold">Nama</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Email</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Role</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr class="border-b hover:bg-zinc-50 dark:hover:bg-zinc-700 transition">
                        <td class="px-4 py-3 text-center">
                            {{ $user->name }}
                        </td>

                        <td class="px-4 py-3 text-center text-sm text-zinc-600 dark:text-zinc-300">
                            {{ $user->email }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($user->role === 'admin') bg-red-100 text-red-700
                                @elseif($user->role === 'petugas') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700
                                @endif
                            ">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-center">
                            <a
                                href="{{ route('admin.users.edit', $user) }}"
                                class="text-Grey-600 hover:underline font-medium"
                            >
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </flux:card>
       <flux:sidebar.item
        icon="user-plus"
        :href="route('admin.users.create')"
        :current="request()->routeIs('admin.users.create')"
        wire:navigate
    >
        Tambah User
    </flux:sidebar.item>

</div>


