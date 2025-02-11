<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

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
            'prefix' => new PrefixResource($this->prefix),
            'phone' => $this->phone,

            'email' => $this->email,

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
            // 'contacts' => new ContactResource($this->contacts),
        ];

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId'); // Relación inversa
    }
}