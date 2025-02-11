<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        /*
        "id": 1,
            "role": "admin",
            "name": "Anna",
            "lastName": "Martínez",
            "email": "anna.martinez@example.com",
            "prefix": "34",
            "phone": "666777888",
            "zoneIds": [1],
            "language": ["Català"],
            "dateHire": "2023-01-01",
            "dateTermination": null,
            "username": "admin_anna",
            "passwordHash": "hashed_password"
        */
        return [
            'id' => $this->id,
            'role' => $this->role,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'prefix' => $this->prefix->prefix,
            'phone' => $this->phone,
            // 'zones' => new ZoneResource($this->zones),
            'language' => $this->language,
            'dateHire' => $this->dateHire,
            'dateTermination' => $this->dateTermination,
            'username' => $this->username,
            // 'patients' => new PatientResource($this->patients),
        ];
    }
}