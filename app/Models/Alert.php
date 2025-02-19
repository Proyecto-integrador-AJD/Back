<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     schema="Alert",
 *     description="Esquema del modelo Alerta",
 *     @OA\Property(property="id", type="integer", description="ID de la alerta"),
 *     @OA\Property(property="patientId", type="integer", description="ID del paciente asociado a la alerta"),
 *     @OA\Property(property="type", type="string", description="Tipo de alerta"),
 *     @OA\Property(property="subType", type="string", description="Subtipo de alerta"),
 *     @OA\Property(property="description", type="string", description="Descripción de la alerta"),
 *     @OA\Property(property="startDate", type="string", format="date-time", description="Fecha de inicio de la alerta"),
 *     @OA\Property(property="isRecurring", type="boolean", description="Indica si la alerta es recurrente"),
 *     @OA\Property(property="recurrenceType", type="string", description="Tipo de recurrencia de la alerta (por ejemplo, diaria, semanal, etc.)"),
 *     @OA\Property(property="recurrence", type="integer", description="Frecuencia de la recurrencia de la alerta en días"),
 *     @OA\Property(property="patient", ref="#/components/schemas/Patient", description="Paciente asociado a la alerta")
 * )
 */
class Alert extends Model
{
    /** @use HasFactory<\Database\Factories\AlertFactory> */
    use HasFactory;

    protected $fillable = [
        'patientId',
        'type',
        'subType',
        'description',
        'startDate',
        'isRecurring',
        'recurrenceType',
        'recurrence',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patientId');
    }
}
