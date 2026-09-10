<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class user_role extends Model
{
    // IDs from the user_roles table.
    public const ADMIN_ID = 1;

    public const TEACHER_ID = 2;

    public const STUDENT_ID = 3;

    /**
     * Get all users assigned to this role.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }

    /**
     * Get all administrators assigned to this role.
     */
    public function administrators(): HasMany
    {
        return $this->hasMany(adminProfile::class, 'role_id');
    }

    /**
     * Get all teachers assigned to this role.
     */
    public function teachers(): HasMany
    {
        return $this->hasMany(teacherlist::class, 'role_id');
    }

    /**
     * Get all students assigned to this role.
     */
    public function students(): HasMany
    {
        return $this->hasMany(studentlist::class, 'role_id');
    }
}
