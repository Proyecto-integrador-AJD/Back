<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PrefixPhone;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            
            //! Nombre y Apellido
            $table->string('name');
            $table->string('lastName');

            $table->foreignId('userId')->nullable()->constrained('users')->onDelete('cascade');

            //! Fecha de Nacimiento
            $table->date('birthDate');

            //! Direccion
            // Tipo de direccion
            $table->string('addressStreet');
            // Numero de direccion
            $table->integer('addressNumber');
            // Piso de direccion
            $table->string('addressFloor');
            // Puerta de direccion
            $table->string('addressDoor');
            // Codigo Postal
            $table->string('addressPostalCode');
            // Ciudad
            $table->string('addressCity');
            // Provincia
            $table->string('addressProvince');
            // Pais
            $table->string('addressCountry');
            

            //! DNI
            $table->string('dni')->unique();
            $table->string('healthCardNumber')->unique();

            //! Telefono
            $table->string('prefix');
            $table->integer('phone');
            
            //! Email
            $table->string('email')->unique();

            //! Idioma
            $table->string('language');

            //! Foreing Key Zona
            $table->foreignId('zoneId')->constrained('zones')->onDelete('cascade');
                        
            //! Sitauion
            // Situacion Personal y Familiar
            $table->string('situationPersonalFamily');
            // Situacion de Salud
            $table->string('healthSituation');
            // Situacion de Vivienda
            $table->string('housingSituationType');
            // Situacion de Vivienda
            $table->string('housingSituationStatus');
            // Situacion de Vivienda
            $table->integer('housingSituationNumberOfRooms');
            // Situacion de Vivienda
            $table->string('housingSituationLocation');

            //! Economic Situation
            $table->string('personalAutonomy');
            $table->string('economicSituation');
            
            //! Emergency Contacts
            //! Relacion con contacto de emergencia en la tabla de Contacts


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
