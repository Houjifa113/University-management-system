<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropUnique(['teacher_id']);
            $table->foreign('teacher_id')
                ->references('id')
                ->on('teacherlists')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->unique('teacher_id');
            $table->foreign('teacher_id')
                ->references('id')
                ->on('teacherlists')
                ->nullOnDelete();
        });
    }
};
