<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'created_at',
    ];

    // Karena tabel tidak punya updated_at
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
