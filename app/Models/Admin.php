<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class adminProfile extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'role_id' => 'integer',
        ];
    }

    /**
     * Get the single role assigned to this administrator.
     */
    public function userRole(): BelongsTo
    {
        return $this->belongsTo(user_role::class, 'role_id');
    }
}
