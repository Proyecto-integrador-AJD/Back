<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Call;
use App\Enums\Calls\Outcoming\TypeAndSubtipe as OutcomingTypeAndSubtipe;
use App\Enums\Calls\Incoming\TypeAndSubtipe as IncomingTypeAndSubtipe;

class CallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Call::create([
            'date' => '2021-01-01 00:00:00',
            'patientId' => 1,
            'userId' => 1,
            'incoming' => true,
            'type' => IncomingTypeAndSubtipe::HEALTH_EMERGENCIES->getCategory()->value,
            'subType' => IncomingTypeAndSubtipe::HEALTH_EMERGENCIES,
            'alertId' => 1,
            'duration' => 60,
            'description' => 'Test call',
        ]);

        Call::factory(10)->create();
    }
}
