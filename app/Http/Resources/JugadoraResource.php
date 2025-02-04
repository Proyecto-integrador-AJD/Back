<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JugadoraResource extends JsonResource
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

            // Foreign Key - Zone
            'zoneId' => $this->zoneId,

            // Situation fields
            'situationPersonalFamily' => $this->situationPersonalFamily,
            'situationHealth' => $this->healthSituation,
            'situationType' => $this->housingSituationType,
            'situationStatus' => $this->housingSituationStatus,
            'situationNumberOfRooms' => $this->housingSituationNumberOfRooms,
            'situationLocation' => $this->housingSituationLocation,

            // Economic Situation
            'economicSituation' => $this->economicSituation,
        ];
    }
}