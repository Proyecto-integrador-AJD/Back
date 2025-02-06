<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Call, User, Patient, Alert};
use App\Enums\Calls\Incoming\TypeAndSubtipe as IncomingTypeAndSubtipe;
use App\Enums\Calls\Outcoming\TypeAndSubtipe as OutcomingTypeAndSubtipe;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Call>
 */
class CallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*
        Call::create([
            'date' => '2021-01-01 00:00:00',
            'patientId' => 1,
            'userId' => 1,
            'incoming' => true,
            'type' => IncomingTypeAndSubtipe::HEALTH_EMERGENCIES->getCategory(),
            'subType' => IncomingTypeAndSubtipe::HEALTH_EMERGENCIES,
            'alertId' => 1,
            'duration' => 60,
            'description' => 'Test call',
        ]);
        */

        $subtipe = $this->faker->randomElement(IncomingTypeAndSubtipe::getValues());
        return [
            'date' => '2021-01-01 00:00:00',
            'patientId' => Patient::all()->random()->id,
            'userId' => User::where('role', 'operator')->get()->random()->id,
            'incoming' => true,
            'type' => $subtipe->getCategory()->value,
            'subType' => $subtipe->value,
            'alertId' => Alert::all()->random()->id,
            'duration' => $this->faker->numberBetween(1, 60),
            'description' => 'Test call',
        ];
    }
}
