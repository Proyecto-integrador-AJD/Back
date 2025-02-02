<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\{PrefixPhone, Language};

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        /*
        "id": 2,
            "role": "operador",
            "name": "Pere",
            "lastName": "Garcia",
            "email": "peregar@gmail.com",
            "phone": {
                "prefix": "34",
                "number": "666777888"
            },
            "zoneIds": [2],
            "language": ["Català"],
            "contactIds": [2],
            "dateHire": "2023-01-01",
            "dateTermination": "2025-01-01"
        */
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('operador');
            $table->string('lastName');
            $table->string('prefix')->default(PrefixPhone::SPAIN);
            $table->integer('phone');

            
            $table->json('language');

            $table->date('dateHire');
            $table->date('dateTermination')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('lastName');
            $table->dropColumn('prefix');
            $table->dropColumn('phone');
            $table->dropColumn('language');
            $table->dropColumn('dateHire');
            $table->dropColumn('dateTermination');
        });
    }
};
