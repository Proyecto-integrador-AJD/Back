<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Equip;
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
            'phone' => 666777888,
            'dateHire' => '2025-01-01',

        ]);

        // Crear 30 árbitros
        User::factory()->count(30)->create();
    }
}
