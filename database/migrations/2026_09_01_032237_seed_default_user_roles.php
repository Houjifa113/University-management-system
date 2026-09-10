<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('user_roles')->insert([
            ['Role' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['Role' => 'teacher', 'created_at' => now(), 'updated_at' => now()],
            ['Role' => 'student', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('user_roles')
            ->whereIn('Role', ['admin', 'teacher', 'student'])
            ->delete();
    }
};
