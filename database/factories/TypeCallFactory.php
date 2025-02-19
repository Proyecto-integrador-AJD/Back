<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeCall>
 */
class TypeCallFactory extends Factory
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
            'incoming' => $this->faker->boolean(),
        ];
    }
}
