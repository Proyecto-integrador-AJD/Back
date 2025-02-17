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
        Schema::create('subtypecall', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('spanishName');
            $table->string('valencianName');
            $table->boolean('incoming');
            $table->foreignId('typecall_id')->constrained('typecall');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtypecall');
    }
};
