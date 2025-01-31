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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            
            //! Nombre y Apellido
            $table->string('name');
            $table->string('lastName');


            //! Fecha de Nacimiento
            $table->date('birthDate');

            //! Direccion
            /*
                "address": {
                    "street": "Carrer Major",
                    "number": "12",
                    "floor": "3r",
                    "door": "2a",
                    "postalCode": "08001",
                    "city": "Barcelona",
                    "province": "Barcelona",
                    "country": "Espanya"
                },
            */
            $table->string('addressStreet');
            $table->integer('addressNumber');
            $table->string('addressFloor');
            $table->string('addressDoor');
            $table->integer('addressPostalCode');
            $table->string('addressCity');
            $table->string('addressProvince');
            $table->string('addressCountry');
            

            //! DNI
            $table->string('dni')->unique();
            $table->string('healthCardNumber')->unique();

            //! Telefono
            $table->integer('prefix');
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
            $table->string('situationPersonalFamily');
            $table->string('healthSituation');
            $table->string('housingSituationType');
            $table->string('housingSituationStatus');
            $table->integer('housingSituationNumberOfRooms');
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
