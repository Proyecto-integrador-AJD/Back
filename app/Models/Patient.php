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

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zoneId');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'patientId');
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class, 'patientId');
    }
}
