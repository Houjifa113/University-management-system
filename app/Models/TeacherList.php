<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class teacherlist extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'role_id' => 'integer',
        ];
    }

    /**
     * Get the single role assigned to this teacher.
     */
    public function userRole(): BelongsTo
    {
        return $this->belongsTo(user_role::class, 'role_id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(Classlist::class, 'teacher_id');
    }
}
