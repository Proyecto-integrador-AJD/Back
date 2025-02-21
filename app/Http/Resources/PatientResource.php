<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
/**
 * @OA\Schema(
 *     schema="PatientResource",
 *     description="Recurso de paciente",
 *     @OA\Property(property="id", type="integer", description="ID del paciente"),
 *     @OA\Property(property="name", type="string", description="Nombre del paciente"),
 *     @OA\Property(property="lastName", type="string", description="Apellido del paciente"),
 *     @OA\Property(property="birthDate", type="string", format="date", description="Fecha de nacimiento del paciente"),
 *     @OA\Property(property="userId", type="integer", description="ID del usuario asociado al paciente"),
 * 
 *     @OA\Property(property="addressStreet", type="string", description="Calle de la dirección del paciente"),
 *     @OA\Property(property="addressNumber", type="integer", description="Número de la dirección del paciente"),
 *     @OA\Property(property="addressFloor", type="string", description="Piso de la dirección del paciente"),
 *     @OA\Property(property="addressDoor", type="string", description="Puerta de la dirección del paciente"),
 *     @OA\Property(property="addressPostalCode", type="integer", description="Código postal de la dirección del paciente"),
 *     @OA\Property(property="addressCity", type="string", description="Ciudad de la dirección del paciente"),
 *     @OA\Property(property="addressProvince", type="string", description="Provincia de la dirección del paciente"),
 *     @OA\Property(property="addressCountry", type="string", description="País de la dirección del paciente"),
 * 
 *     @OA\Property(property="dni", type="string", description="DNI del paciente"),
 *     @OA\Property(property="healthCardNumber", type="string", description="Número de la tarjeta sanitaria del paciente"),
 * 
 *     @OA\Property(property="prefix", type="string", description="Prefijo del teléfono del paciente"),
 *     @OA\Property(property="phone", type="integer", description="Número de teléfono del paciente"),
 * 
 *     @OA\Property(property="email", type="string", format="email", description="Correo electrónico del paciente"),
 *     @OA\Property(property="language", type="string", description="Idioma preferido del paciente"),
 * 
 *     @OA\Property(property="zoneId", type="integer", description="ID de la zona asignada al paciente"),
 * 
 *     @OA\Property(property="healthSituation", type="string", description="Situación de salud del paciente"),
 *     @OA\Property(property="situationPersonalFamily", type="string", description="Situación personal/familiar del paciente"),
 *     @OA\Property(property="housingSituationType", type="string", description="Tipo de situación de vivienda del paciente"),
 *     @OA\Property(property="housingSituationStatus", type="string", description="Estado de situación de vivienda del paciente"),
 *     @OA\Property(property="housingSituationNumberOfRooms", type="integer", description="Número de habitaciones en la vivienda del paciente"),
 *     @OA\Property(property="housingSituationLocation", type="string", description="Ubicación de la vivienda del paciente"),
 *     @OA\Property(property="personalAutonomy", type="string", description="Autonomía personal del paciente"),
 * 
 *     @OA\Property(property="economicSituation", type="string", description="Situación económica del paciente"),
 *     @OA\Property(property="contacts", type="array", @OA\Items(type="string"), description="Contactos del paciente")
 * )
 */
class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'birthDate' => $this->birthDate,
            'userId' => $this->userId,

            // Address fields
            'addressStreet' => $this->addressStreet,
            'addressNumber' => $this->addressNumber,
            'addressFloor' => $this->addressFloor,
            'addressDoor' => $this->addressDoor,
            'addressPostalCode' => $this->addressPostalCode,
            'addressCity' => $this->addressCity,
            'addressProvince' => $this->addressProvince,
            'addressCountry' => $this->addressCountry,

            // DNI and Health Card
            'dni' => $this->dni,
            'healthCardNumber' => $this->healthCardNumber,

            // Phone
            'prefix' => $this->prefix,
            'phone' => $this->phone,

            'email' => $this->email,
            'language' => $this->language,

            // Foreign Key - Zone
            'zoneId' => $this->zoneId,

            // Situation fields
            'healthSituation' => $this->healthSituation,
            'situationPersonalFamily' => $this->situationPersonalFamily,
            'housingSituationType' => $this->housingSituationType,
            'housingSituationStatus' => $this->housingSituationStatus,
            'housingSituationNumberOfRooms' => $this->housingSituationNumberOfRooms,
            'housingSituationLocation' => $this->housingSituationLocation,
            'personalAutonomy' => $this->personalAutonomy,


            // Economic Situation
            'economicSituation' => $this->economicSituation,
            'contacts' => $this->contacts,
        ];

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId'); // Relación inversa
    }
}