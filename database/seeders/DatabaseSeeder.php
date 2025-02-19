<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            ZoneSeeder::class,
            PrefixSeeder::class,
            AlertTypeSeeder::class,
            AlertSubtypeSeeder::class,
            AlertSubtypeSeeder::class,
            LanguageSeeder::class,
            UserSeeder::class,
            RelationshipSeeder::class,
            RecurrenceTypeSeeder::class,
            UsersZonesSeeder::class,
            PatientSeeder::class,
            ContactSeeder::class,
            AlertSeeder::class,
            CallSeeder::class,
            TypeCallSeeder::class,
            SubTypeCallSeeder::class,
        ]);
    }
}
