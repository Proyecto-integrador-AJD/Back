<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'lastName',
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
}
