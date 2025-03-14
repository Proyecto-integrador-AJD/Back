<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear admintrator
        User::create([
            'name' => 'Admin',
            'lastName' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admintrator',
            'prefix' => '+34',
            'phone' => 666777888,
            'dateHire' => '2025-01-01',

        ]);
        User::create([
            'name' => 'AdminMalo',
            'lastName' => 'Admin',
            'username' => 'adminMalo',
            'email' => 'adminMalo@example.com',
            'password' => Hash::make('password'),
            'role' => 'operator',
            'prefix' => '+34',
            'phone' => 666777888,
            'dateHire' => '2025-01-01',

        ]);
        User::create([
            'name' => 'AdminParaBorrar',
            'lastName' => 'AdminParaBorrar',
            'username' => 'AdminParaBorrar',
            'email' => 'AdminParaBorrar@example.com',
            'password' => Hash::make('password'),
            'role' => 'admintrator',
            'prefix' => '+34',
            'phone' => 666777888,
            'dateHire' => '2025-01-01',

        ]);
        // Crear 30 árbitros
        User::factory()->count(5)->create();
    }
}
