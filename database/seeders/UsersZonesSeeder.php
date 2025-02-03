<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, Zone};

class UsersZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        Schema::create('users_zones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users');
            $table->foreignId('zoneId')->constrained('zones');
            $table->timestamps();
        });
         */
        $users = User::all();
        $zones = Zone::all();

        foreach ($users as $user) {
            $user->zones()->attach($zones->random(rand(1, 3))->pluck('id')->toArray());
        }


    }
}
