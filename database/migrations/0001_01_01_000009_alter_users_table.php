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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('role')->default('operador');
            $table->string('lastName');
            $table->string('prefix')->default(PrefixPhone::SPAIN);
            $table->integer('phone');

            
            // $table->json('language');
            $table->string('language');

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
            $table->dropColumn('username');
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
