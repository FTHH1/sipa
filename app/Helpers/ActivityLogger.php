<?php

use App\Models\ActivityLog;

if (! function_exists('logActivity')) {

    function logActivity(string $action, string $description = null): void
    {
        if (! auth()->check()) {
            return;
        }

        ActivityLog::create([
            'user_id'     => auth()->id(),
            'action'      => $action,
            'description' => $description,
            'created_at'  => now(),
        ]);
    }
}
