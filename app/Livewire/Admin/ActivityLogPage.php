<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ActivityLog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Activity Log')]
class ActivityLogPage extends Component
{
    public $role = '';
    public $date = '';

    public function render()
    {
        $logs = ActivityLog::with('user')
            ->when($this->role, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('role', $this->role);
                });
            })
            ->when($this->date, function ($query) {
                $query->whereDate('created_at', $this->date);
            })
            ->latest()
            ->get();

        return view('livewire.admin.activity-log-page', [
            'logs' => $logs,
        ]);
    }
}
