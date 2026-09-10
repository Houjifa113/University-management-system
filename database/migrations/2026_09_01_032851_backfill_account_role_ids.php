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
        $roleIds = DB::table('user_roles')->pluck('id', 'Role');

        DB::table('admin')->where('role', 'admin')->update(['role_id' => $roleIds['admin']]);
        DB::table('teacherlists')->where('role', 'teacher')->update(['role_id' => $roleIds['teacher']]);
        DB::table('studentlists')->where('role', 'student')->update(['role_id' => $roleIds['student']]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('admin')->update(['role_id' => null]);
        DB::table('teacherlists')->update(['role_id' => null]);
        DB::table('studentlists')->update(['role_id' => null]);
    }
};
