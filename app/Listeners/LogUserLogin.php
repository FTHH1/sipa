<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\ActivityLog;

class LogUserLogin
{
    public function handle(Login $event): void
    {
        ActivityLog::create([
            'user_id' => $event->user->id,
            'action' => 'login',
            'description' => 'User login',
            'created_at' => now(),
        ]);
    }
}
