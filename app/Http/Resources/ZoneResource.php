<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;



/**
 * @OA\Schema(
 *     schema="ZoneResource",
 *     description="Respuestas de la zona",
 *     @OA\Property(property="id", type="integer", description="ID de la zona"),
 *     @OA\Property(property="name", type="string", description="Nombre de la zona"),
 *     @OA\Property(property="description", type="string", description="Descripcion de la zona"),
 *     @OA\Property(property="location", type="string", description="Ubicacion de la zona")
 * )
 */
class ZoneResource extends JsonResource
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
            'description' => $this->description,
            'location' => $this->location,
        ];
    }
}