<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *     schema="UserResource",
 *     description="Respuesta de los datos del usuario",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID del usuario",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="role",
 *         type="string",
 *         description="Rol del usuario",
 *         example="admin"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del usuario",
 *         example="Anna"
 *     ),
 *     @OA\Property(
 *         property="lastName",
 *         type="string",
 *         description="Apellido del usuario",
 *         example="Martínez"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="Correo electrónico del usuario",
 *         example="anna.martinez@example.com"
 *     ),
 *     @OA\Property(
 *         property="prefix",
 *         type="string",
 *         description="Prefijo telefónico del usuario",
 *         example="34"
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         description="Número de teléfono del usuario",
 *         example="666777888"
 *     ),
 *     @OA\Property(
 *         property="language",
 *         type="array",
 *         description="Idiomas preferidos del usuario",
 *         @OA\Items(type="string", example="Català")
 *     ),
 *     @OA\Property(
 *         property="dateHire",
 *         type="string",
 *         format="date",
 *         description="Fecha de contratación del usuario",
 *         example="2023-01-01"
 *     ),
 *     @OA\Property(
 *         property="dateTermination",
 *         type="string",
 *         format="date",
 *         description="Fecha de terminación del usuario (puede ser nula)",
 *         example=null
 *     ),
 *     @OA\Property(
 *         property="username",
 *         type="string",
 *         description="Nombre de usuario",
 *         example="admin_anna"
 *     )
 * )
 */
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
            'prefix' => $this->prefix,
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