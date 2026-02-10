<div>
    <flux:heading size="lg">Manajemen User</flux:heading>

    <flux:card class="mt-4">
        <table class="w-full">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <a
                                href="{{ route('admin.users.edit', $user) }}"
                                class="text-blue-600 hover:underline"
                            >
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </flux:card>
</div>
