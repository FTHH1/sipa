<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
              @if($role === 'admin')
        @include('dashboard')
             @elseif($role === 'petugas')
        @include('dashboard.partials.petugas')
             @elseif($role === 'peminjam')
        @include('dashboard.partials.peminjam')
             @endif
</div>