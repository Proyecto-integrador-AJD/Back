<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\{Language};
use App\Casts\CsvToArrayCast;

/**
 * @OA\Schema(
 *     schema="Patient",
 *     description="Esquema del modelo Paciente",
 *     @OA\Property(property="id", type="integer", description="ID del paciente"),
 *     @OA\Property(property="name", type="string", description="Nombre del paciente"),
 *     @OA\Property(property="lastName", type="string", description="Apellido del paciente"),
 *     @OA\Property(property="userId", type="integer", description="ID del usuario asociado al paciente"),
 *     @OA\Property(property="birthDate", type="string", format="date", description="Fecha de nacimiento del paciente"),
 *     @OA\Property(property="addressStreet", type="string", description="Calle de la dirección del paciente"),
 *     @OA\Property(property="addressNumber", type="string", description="Número de la dirección del paciente"),
 *     @OA\Property(property="addressFloor", type="string", description="Piso de la dirección del paciente"),
 *     @OA\Property(property="addressDoor", type="string", description="Puerta de la dirección del paciente"),
 *     @OA\Property(property="addressPostalCode", type="string", description="Código postal de la dirección del paciente"),
 *     @OA\Property(property="addressCity", type="string", description="Ciudad de la dirección del paciente"),
 *     @OA\Property(property="addressProvince", type="string", description="Provincia de la dirección del paciente"),
 *     @OA\Property(property="addressCountry", type="string", description="País de la dirección del paciente"),
 *     @OA\Property(property="dni", type="string", description="DNI del paciente"),
 *     @OA\Property(property="healthCardNumber", type="string", description="Número de tarjeta sanitaria del paciente"),
 *     @OA\Property(property="prefix", type="string", description="Prefijo del paciente"),
 *     @OA\Property(property="phone", type="string", description="Número de teléfono del paciente"),
 *     @OA\Property(property="language", type="array", 
 *         @OA\Items(type="string", enum={"english"}, description="Lenguas del paciente"),
 *         description="Idiomas hablados por el paciente"),
 *     @OA\Property(property="email", type="string", description="Correo electrónico del paciente"),
 *     @OA\Property(property="zoneId", type="integer", description="ID de la zona asociada al paciente"),
 *     @OA\Property(property="situationPersonalFamily", type="string", description="Situación personal y familiar del paciente"),
 *     @OA\Property(property="healthSituation", type="string", description="Situación de salud del paciente"),
 *     @OA\Property(property="housingSituationType", type="string", description="Tipo de situación de la vivienda del paciente"),
 *     @OA\Property(property="housingSituationStatus", type="string", description="Estado de la situación de vivienda del paciente"),
 *     @OA\Property(property="housingSituationNumberOfRooms", type="integer", description="Número de habitaciones de la vivienda del paciente"),
 *     @OA\Property(property="housingSituationLocation", type="string", description="Ubicación de la vivienda del paciente"),
 *     @OA\Property(property="personalAutonomy", type="string", description="Autonomía personal del paciente"),
 *     @OA\Property(property="economicSituation", type="string", description="Situación económica del paciente"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación del registro del paciente"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización del registro del paciente"),
 *     @OA\Property(property="user", ref="#/components/schemas/User", description="Usuario asociado al paciente"),
 *     @OA\Property(property="zone", ref="#/components/schemas/Zone", description="Zona asociada al paciente"),
 *     @OA\Property(property="contacts", type="array", 
 *         @OA\Items(ref="#/components/schemas/Contact"), description="Contactos asociados al paciente"),
 *     @OA\Property(property="alerts", type="array", 
 *         @OA\Items(ref="#/components/schemas/Alert"), description="Alertas asociadas al paciente"),
 *     @OA\Property(property="calls", type="array", 
 *         @OA\Items(ref="#/components/schemas/Call"), description="Llamadas asociadas al paciente")
 * )
 */
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
