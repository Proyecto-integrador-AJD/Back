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
            $table->integer('addressPostalCode');
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
            $table->enum('prefix', array_column(PrefixPhone::cases(), 'value'))
                  ->default(PrefixPhone::SPAIN->value);
            $table->integer('phone');
            
            //! Email
            $table->string('email')->unique();

            //! Foreing Key Zona
            // $table->unsignedBigInteger('zoneId');
            
            //! Sitauion
            /*
            "situationPersonalFamily": "Viu sol, rep visites del seu fill cada cap de setmana.",
            "healthSituation": "Hipertensió, medicació diària, risc de caigudes.",
            "housingSituation": {
                "type": "Pis",
                "status": "Bona conservació",
                "numberOfRooms": 4,
                "location": "Centre ciutat"
            },
            */
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
            /*
            "personalAutonomy": "Necessita ajuda per activitats domèstiques.",
            "economicSituation": "Pensió mínima, sense copagament.",
            */
            $table->string('personalAutonomy');
            $table->string('economicSituation');
            
            //! Emergency Contacts
            //! Relacion con contacto de emergencia con una tabla intermedia
            /*
            "emergencyContacts": [
                {
                    "name": "Pere",
                    "lastName": "Garcia",
                    "phone": {
                        "prefix": "34",
                        "number": "677889900"
                    },
                    "relationship": "Fill"
                }
            ]
            */

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
