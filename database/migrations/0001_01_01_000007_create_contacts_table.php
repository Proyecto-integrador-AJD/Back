<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\PrefixPhone;
use App\Enums\Contat\Relationship;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            
            $table->string('name');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->enum('prefix', array_column(PrefixPhone::cases(), 'value'))
                ->default(PrefixPhone::SPAIN->value);
            $table->integer('phone');

            // Foreing Key Patient
            $table->unsignedBigInteger('patientId');
            $table->enum('relationship', array_column(Relationship::cases(), 'value'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
