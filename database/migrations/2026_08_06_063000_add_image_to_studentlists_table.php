<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('studentlists', 'image')) {
            return;
        }

        Schema::table('studentlists', function (Blueprint $table): void {
            $table->string('image')->nullable()->after('department');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('studentlists', 'image')) {
            return;
        }

        Schema::table('studentlists', function (Blueprint $table): void {
            $table->dropColumn('image');
        });
    }
};
