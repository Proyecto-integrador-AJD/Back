<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubTypeCall>
 */
class SubTypeCallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'spanishName' => $this->faker->word(),
            'valencianName' => $this->faker->word(),
            'typecall_id' => Typecall::inRandomOrder()->first()->id,
        ];
    }
}
