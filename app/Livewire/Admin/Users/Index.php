<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Manajemen User')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.users.index', [
            'users' => User::all(),
        ]);
    }
}
