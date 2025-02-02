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
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patientId')->constrained('patients');
            $table->string('type');
            $table->string('subType');
            $table->string('description');
            $table->date('startDate');
            $table->boolean('isRecurring');
            $table->enum ('recurrenceType', ['daily', 'weekly', 'monthly', 'yearly']);
            $table->integer('recurrence');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
