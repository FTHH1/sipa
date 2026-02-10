<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\ActivityLog;

class LogUserLogout
{
    public function handle(Logout $event): void
    {
        if (!$event->user) return;

        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => 'logout',
            'description' => 'User logout',
            'created_at' => now(),
        ]);
    }
}
