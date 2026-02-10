<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\ActivityLog;



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
        $this->validate([
            'user.name'  => 'required|string|max:255',
            'user.email' => 'required|email',
            'user.role'  => 'required|in:admin,petugas,peminjam',
        ]);

        $this->user->save();    
        
         ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'update_user',
        'description' => 'Mengubah data user: ' . $this->user->email,
        'created_at' => now(),
    ]);
        session()->flash('success', 'User berhasil diperbarui.');

        return redirect()->route('admin.users.index');
    }

 public function delete()
{
    $currentUser = Auth::user();

    if ($currentUser && $currentUser->id === $this->user->id) {
        session()->flash('error', 'Tidak bisa menghapus akun sendiri.');
        return;
    }

    $this->user->delete();

     ActivityLog::create([
        'user_id' => $currentUser->id,
        'action' => 'delete_user',
        'description' => 'Menghapus user: ' . $this->user->email,
        'created_at' => now(), 
         ]);

    session()->flash('success', 'User berhasil dihapus.');

    return redirect()->route('admin.users.index');
}

}
