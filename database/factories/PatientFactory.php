<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Patient, Zone, User, Prefix};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            /*
            name": "Joan",
            "lastName": "Garcia",
            "birthDate": "1950-06-15",
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
            "dni": "12345678A",
            "healthCardNumber": "CAT123456789",
            "phone": {
                "prefix": "34",
                "number": "666123456"
            },
            "email": "joan.garcia@example.com",
            "zoneId": 1,
            "situationPersonalFamily": "Viu sol, rep visites del seu fill cada cap de setmana.",
            "healthSituation": "Hipertensió, medicació diària, risc de caigudes.",
            "housingSituation": {
                "type": "Pis",
                "status": "Bona conservació",
                "numberOfRooms": 4,
                "location": "Centre ciutat"
            },
            "personalAutonomy": "Necessita ajuda per activitats domèstiques.",
            "economicSituation": "Pensió mínima, sense copagament.",
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

            'name' => $this->faker->name(),
            'lastName' => $this->faker->lastName(),
            'userId' => User::where('role', 'operator')->get()->random()->id,
            'birthDate' => $this->faker->dateTimeBetween('-80 years', '-40 years')->format('Y-m-d'),
            'addressStreet' => $this->faker->streetName(),
            'addressNumber' => $this->faker->buildingNumber(),
            'addressFloor' => $this->faker->randomElement(['1r', '2n', '3r', '4t', '5è']),
            'addressDoor' => $this->faker->randomElement(['1a', '2a', '3a', '4a', '5a']),
            'addressPostalCode' => $this->faker->numerify('#####'),
            'addressCity' => $this->faker->city(),
            'addressProvince' => $this->faker->state(),
            'addressCountry' => $this->faker->country(),
            'dni' => $this->faker->unique()->numerify('#########A'),
            'healthCardNumber' => $this->faker->unique()->bothify('???#########'),
            'prefixId' => Prefix::all()->random()->id,
            'phone' => $this->faker->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail(),
            'zoneId' => Zone::all()->random()->id,
            'situationPersonalFamily' => $this->faker->sentence(),
            'healthSituation' => $this->faker->sentence(),
            'housingSituationType' => $this->faker->randomElement(['Pis', 'Casa', 'Xalet', 'Apartament', 'Estudi']),
            'housingSituationStatus' => $this->faker->randomElement(['Bona conservació', 'Molt bona conservació', 'Necessita reformes', 'Molt bona ubicació', 'Molt bona orientació']),
            'housingSituationNumberOfRooms' => $this->faker->numberBetween(1, 10),
            'housingSituationLocation' => $this->faker->randomElement(['Centre ciutat', 'Perifèria', 'Muntanya', 'Mar', 'Camp']),
            'personalAutonomy' => $this->faker->sentence(),
            'economicSituation' => $this->faker->sentence(),
        ];
    }
}
