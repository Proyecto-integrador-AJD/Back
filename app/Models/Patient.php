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
        'prefixId',
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

    public function prefixs()
    {
        return $this->belongsTo(Prefix::class, 'prefixId');
    }
}
