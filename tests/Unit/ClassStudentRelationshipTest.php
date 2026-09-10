<?php

use App\Models\Classlist;
use App\Models\studentlist;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

uses(TestCase::class);

test('classes and students use a many-to-many relationship', function () {
    $classStudents = (new Classlist)->students();
    $studentClasses = (new studentlist)->classes();

    expect($classStudents)
        ->toBeInstanceOf(BelongsToMany::class)
        ->getTable()->toBe('class_student')
        ->and($studentClasses)
        ->toBeInstanceOf(BelongsToMany::class)
        ->getTable()->toBe('class_student');
});
