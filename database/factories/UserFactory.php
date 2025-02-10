<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Prefix;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*
        {
                    "id": 1,
                    "role": "admin",
                    "name": "Anna",
                    "lastName": "Martínez",
                    "email": "anna.martinez@example.com",
                    "phone": {
                        "prefix": "34",
                        "number": "666777888"
                    },
                    "zoneIds": [1],
                    "language": ["Català"],
                    "contactIds": [1],
                    "dateHire": "2023-01-01",
                    "dateTermination": null,
                    "username": "admin_anna",
                    "passwordHash": "hashed_password"
                },
        */

        return [
            'name' => $this->faker->name(),
            'lastName' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'prefixId' => Prefix::all()->random()->id,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'operator', // Valor por defecto
            'phone' => $this->faker->numerify('#########'),
            'dateHire' => $this->faker->date(),
        ];
    }

    /**
     * Indica que el correo no está verificado.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
