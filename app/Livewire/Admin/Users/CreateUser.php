<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $role = 'peminjam';

    protected $rules = [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role'     => 'required|in:admin,petugas,peminjam',
    ];

    public function save()
    {
        $this->validate();

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'role'     => $this->role,
        ]);

        session()->flash('success', 'User berhasil ditambahkan');

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.admin.users.create');
    }
}
