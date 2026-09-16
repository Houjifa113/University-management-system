<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class studentlist extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'role_id' => 'integer',
        ];
    }

    /**
     * Get the single role assigned to this student.
     */
    public function userRole(): BelongsTo
    {
        return $this->belongsTo(user_role::class, 'role_id');
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Classlist::class, 'class_student', 'student_id', 'class_id')
            ->withTimestamps();
    }
}
