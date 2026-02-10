<?php

use App\Models\ActivityLog;

function log_activity($action, $description)
{
    ActivityLog::create([
        'user_id' => auth()->id,
        'action' => $action,
        'description' => $description,
        'created_at' => now(),
    ]);
}
