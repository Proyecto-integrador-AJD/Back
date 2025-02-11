<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prefix;

class PrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        case SPAIN = '+34';
    case PORTUGAL = '+351';
    case FRANCE = '+33';
    case ANDORRA = '+376';
    case GIBRALTAR = '+350';
    case ITALY = '+39';
    case MOROCCO = '+212';

    public function country(): string
    {
        return match ($this) {
            self::SPAIN => 'España',
            self::PORTUGAL => 'Portugal',
            self::FRANCE => 'Francia',
            self::ANDORRA => 'Andorra',
            self::GIBRALTAR => 'Gibraltar',
            self::ITALY => 'Italia',
            self::MOROCCO => 'Marruecos',
        };
    }
        */
    
        $prefixes = [
            ['prefix' => '+34', 'country' => 'España'],
            ['prefix' => '+351', 'country' => 'Portugal'],
            ['prefix' => '+33', 'country' => 'Francia'],
            ['prefix' => '+376', 'country' => 'Andorra'],
            ['prefix' => '+350', 'country' => 'Gibraltar'],
            ['prefix' => '+39', 'country' => 'Italia'],
            ['prefix' => '+212', 'country' => 'Marruecos'],
        ];

        foreach ($prefixes as $prefix) {
            Prefix::create($prefix);
        }
    
    }
}
