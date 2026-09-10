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
        Schema::create('studentlist', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100);
            $table->string('email', 80);
            $table->string('password', 100);
            $table->string('gender');
            $table->string('department');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentlist');
    }
};
