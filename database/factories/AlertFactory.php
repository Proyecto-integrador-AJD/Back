<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Alert, Patient, RecurrenceType, AlertType};
use App\Enums\Alerts\{TypeAndSubtipe};

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
        $type = $this->faker->randomElement(TypeAndSubtipe::getValues());
        $isRecurring = $this->faker->boolean;
        return [
            'patientId' => Patient::all()->random()->id,
            'type' => AlertType::all()->random()->name,
            'subType' => $type->value,
            'description' => $this->faker->sentence,
            'startDate' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d H:i:s'),
            'isRecurring' => $isRecurring,
            'recurrenceType' => ($isRecurring) ? RecurrenceType::all()->random()->name : null,
            'recurrence' => ($isRecurring) ? $this->faker->numberBetween(1, 10) : null,
        ];
    }
}
