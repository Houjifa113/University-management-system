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

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function administrators(): HasMany
    {
        return $this->hasMany(Admin::class, 'role_id');
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(TeacherList::class, 'role_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(StudentList::class, 'role_id');
    }
}
