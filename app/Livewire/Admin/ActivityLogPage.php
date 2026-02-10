<?php

namespace App\Livewire\Admin;

use Livewire\Component; // ← INI YANG HILANG
use App\Models\ActivityLog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Activity Log')]
class ActivityLogPage extends Component
{
    public function render()
    {
        return view('livewire.admin.activity-log-page', [
            'logs' => ActivityLog::with('user')->latest()->get(),
        ]);
    }
}
