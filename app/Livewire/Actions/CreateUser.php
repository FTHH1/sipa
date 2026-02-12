<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Models\User;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public string $role = 'peminjam'; // 👈 ROLE ADA DI SINI

    public function save()
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ]);
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
