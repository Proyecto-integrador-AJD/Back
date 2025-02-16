<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Patient, Relationship, Prefix, Contact};
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zone>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*
        'name',
        'lastName',
        'email',
        'prefix',
        'phone',
        'patientId',
        'relationship',
        */

        return [
            'name' => $this->faker->name,
            'lastName' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->numberBetween(600000000, 699999999),
            'prefix' => Prefix::all()->random()->prefix,
            'patientId' => Patient::all()->random()->id,
            'relationship' => Relationship::all()->random()->name,
        ];
    }
}
