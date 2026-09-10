<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('admin')->whereNull('role')->orWhere('role', '')->update(['role' => 'admin']);
        DB::table('teacherlists')->whereNull('role')->orWhere('role', '')->update(['role' => 'teacher']);
        DB::table('studentlists')->whereNull('role')->orWhere('role', '')->update(['role' => 'student']);

        DB::table('admin')->select(['id', 'password'])->orderBy('id')->eachById(function (object $admin): void {
            if (! Hash::isHashed($admin->password)) {
                DB::table('admin')->where('id', $admin->id)->update([
                    'password' => Hash::make($admin->password),
                ]);
            }
        });

        DB::table('studentlists')->select(['id', 'password'])->orderBy('id')->eachById(function (object $student): void {
            if (! Hash::isHashed($student->password)) {
                DB::table('studentlists')->where('id', $student->id)->update([
                    'password' => Hash::make($student->password),
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Existing account roles and password hashes must remain intact on rollback.
    }
};
