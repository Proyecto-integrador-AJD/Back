<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ContactResource",
 *     description="Respuestas del contacto",
 *     @OA\Property(property="id", type="integer", description="ID del contacto"),
 *     @OA\Property(property="name", type="string", description="Nombre del contacto"),
 *     @OA\Property(property="lastName", type="string", description="Apellido del contacto"),
 *     @OA\Property(property="email", type="string", description="Correo electrónico del contacto"),
 *     @OA\Property(property="prefix", type="string", description="Prefijo telefónico del contacto"),
 *     @OA\Property(property="phone", type="integer", description="Número de teléfono del contacto"),
 *     @OA\Property(property="patientId", type="integer", description="ID del paciente asociado al contacto"),
 *     @OA\Property(property="relationship", type="string", description="Relación del contacto con el paciente")
 * )
 */
class ContactResource extends JsonResource
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
            'email' => $this->email,
            'prefix' => $this->prefix,
            'phone' => $this->phone,
            'patientId' => $this->patientId,
            'relationship' => $this->relationship,
        ];
    }
}