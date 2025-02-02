<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Alert, Patient};
use App\Enums\Alerts\typeAndSubtipe;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alert>
 */
class AlertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(typeAndSubtipe::getValues());
        return [
            'patientId' => Patient::all()->random()->id,
            'type' => $type->getCategory(),
            'subType' => $type->value,
            'description' => $this->faker->sentence,
            'startDate' => $this->faker->date,
            'isRecurring' => $this->faker->boolean,
            'recurrenceType' => $this->faker->randomElement(['daily', 'weekly', 'monthly', 'yearly']),
            'recurrence' => $this->faker->numberBetween(1, 10),
        ];
    }
}
