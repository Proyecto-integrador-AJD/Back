<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Alert, Patient};
use App\Enums\Alerts\{TypeAndSubtipe, RecurrenceType};

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
            'type' => $type->getCategory()->value,
            'subType' => $type->value,
            'description' => $this->faker->sentence,
            'startDate' => $this->faker->datetime,
            'isRecurring' => $isRecurring,
            'recurrenceType' => ($isRecurring) ? $this->faker->randomElement(RecurrenceType::getValues()) : null,
            'recurrence' => ($isRecurring) ? $this->faker->numberBetween(1, 10) : null,
        ];
    }
}
