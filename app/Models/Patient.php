<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\{Language};
use App\Casts\CsvToArrayCast;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'lastName',
        'userId',
        'birthDate',
        'addressStreet',
        'addressNumber',
        'addressFloor',
        'addressDoor',
        'addressPostalCode',
        'addressCity',
        'addressProvince',
        'addressCountry',
        'dni',
        'healthCardNumber',
        'prefix',
        'phone',
        'language',
        'email',
        'zoneId',
        'situationPersonalFamily',
        'healthSituation',
        'housingSituationType',
        'housingSituationStatus',
        'housingSituationNumberOfRooms',
        'housingSituationLocation',
        'personalAutonomy',
        'economicSituation',
    ];


    protected function casts(): array
    {
        return [
            'language' => CsvToArrayCast::class,
        ];
    }

    protected $attributes = [
    'language' => Language::SPANISH->value . ',' . Language::CATALAN->value,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zoneId');
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'patientId');
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class, 'patientId');
    }

    public function calls()
    {
        return $this->hasMany(Call::class, 'patientId');
    }
}
