<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Edit User')]
class EditUser extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function save()
    {
        $this->user->save();

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
    