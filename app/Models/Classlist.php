<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classlist extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'class_name',
        'Teacher_Name',
        'teacher_id',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(teacherlist::class, 'teacher_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(studentlist::class, 'class_student', 'class_id', 'student_id')
            ->withTimestamps();
    }
}
