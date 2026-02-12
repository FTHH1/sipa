<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ActivityLog;
use Livewire\WithPagination;

class ActivityLogPage extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

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
            ->latest('created_at')
            ->paginate(15); // GANTI INI

        return view('livewire.admin.activity-log-page', [
            'logs' => $logs,
        ])->layout('layouts.app.sidebar', [
            'title' => 'Activity Log',
        ]);
    }
}
