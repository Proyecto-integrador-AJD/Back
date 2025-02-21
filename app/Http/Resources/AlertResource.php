<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="AlertResource",
 *     description="Respuesta de la alerta",
 *     @OA\Property(property="id", type="integer", description="ID de la alerta"),
 *     @OA\Property(property="patientId", type="integer", description="ID del paciente asociado a la alerta"),
 *     @OA\Property(
 *         property="patient",
 *         type="object",
 *         description="Paciente asociado a la alerta",
 *         ref="#/components/schemas/PatientResource"
 *     ),
 *     @OA\Property(property="type", type="string", description="Tipo de alerta"),
 *     @OA\Property(property="subType", type="string", description="Subtipo de alerta"),
 *     @OA\Property(property="description", type="string", description="Descripción de la alerta"),
 *     @OA\Property(property="startDate", type="string", format="date-time", description="Fecha de inicio de la alerta"),
 *     @OA\Property(property="isRecurring", type="boolean", description="Indica si la alerta es recurrente"),
 *     @OA\Property(property="recurrenceType", type="string", description="Tipo de recurrencia de la alerta"),
 *     @OA\Property(property="recurrence", type="integer", description="Número de recurrencias")
 * )
 */
class AlertResource extends JsonResource
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
            'patientId' => $this->patientId,
            'patient' => new PatientResource($this->patient ),
            'type' => $this->type,
            'subType' => $this->subType,
            'description' => $this->description,
            'startDate' => $this->startDate,
            'isRecurring' => $this->isRecurring,
            'recurrenceType' => $this->recurrenceType,
            'recurrence' => $this->recurrence,
        ];
    }
}