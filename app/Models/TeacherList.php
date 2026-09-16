<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TeacherList extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'teacher_lists';

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
