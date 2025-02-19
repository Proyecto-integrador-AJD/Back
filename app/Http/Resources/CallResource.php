<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="CallResource",
 *     description="Respuestas de la llamada",
 *     @OA\Property(property="id", type="integer", description="ID de la llamada"),
 *     @OA\Property(property="date", type="string", format="date-time", description="Fecha y hora de la llamada", example="2025-02-19 15:30:00"),
 *     @OA\Property(property="patientId", type="integer", description="ID del paciente relacionado con la llamada", example=1),
 *     @OA\Property(property="userId", type="integer", description="ID del usuario que realizó la llamada", example=2),
 *     @OA\Property(property="incoming", type="boolean", description="Indica si la llamada fue entrante", example=true),
 *     @OA\Property(property="type", type="string", description="Tipo de llamada", example="emergency"),
 *     @OA\Property(property="subType", type="string", description="Subtipo de llamada (opcional)", example="heart attack"),
 *     @OA\Property(property="alertId", type="integer", description="ID de la alerta asociada (opcional)", example=3),
 *     @OA\Property(property="duration", type="integer", description="Duración de la llamada en segundos", example=120),
 *     @OA\Property(property="description", type="string", description="Descripción de la llamada", example="Paciente con dificultad respiratoria")
 * )
 */
class CallResource extends JsonResource
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
            'date' => $this->date,
            'patientId' => $this->patientId,
            'userId' => $this->userId,
            'incoming' => $this->incoming,
            'type' => $this->type,
            'subType' => $this->subType,
            'alertId' => $this->alertId,
            'duration' => $this->duration,
            'description' => $this->description,
        ];
    }
}