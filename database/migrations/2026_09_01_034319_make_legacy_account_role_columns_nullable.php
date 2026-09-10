<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->string('role')->nullable()->change();
        });

        Schema::table('teacherlists', function (Blueprint $table) {
            $table->string('role')->nullable()->change();
        });

        Schema::table('studentlists', function (Blueprint $table) {
            $table->string('role')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // The legacy role values are no longer written by the application.
        // Keeping these columns nullable makes rollback safe for newly created accounts.
    }
};
