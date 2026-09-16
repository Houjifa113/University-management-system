<?php

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('studentlists')
            ->select(['id', 'temporary_password'])
            ->whereNotNull('temporary_password')
            ->orderBy('id')
            ->eachById(function (object $student): void {
                try {
                    $temporaryPassword = Crypt::decryptString($student->temporary_password);
                } catch (DecryptException) {
                    return;
                }

                DB::table('studentlists')
                    ->where('id', $student->id)
                    ->update(['temporary_password' => $temporaryPassword]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Plain-text passwords cannot be safely re-encrypted without changing the application model cast.
    }
};
