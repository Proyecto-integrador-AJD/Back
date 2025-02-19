<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Call",
 *     description="Esquema del modelo Call",
 *     @OA\Property(property="date", type="string", format="date", description="Fecha de la llamada"),
 *     @OA\Property(property="patientId", type="integer", description="ID del paciente asociado a la llamada"),
 *     @OA\Property(property="userId", type="integer", description="ID del usuario que realiza la llamada"),
 *     @OA\Property(property="incoming", type="boolean", description="Indica si la llamada es entrante"),
 *     @OA\Property(property="type", type="string", description="Tipo de la llamada"),
 *     @OA\Property(property="subType", type="string", description="Subtipo de la llamada"),
 *     @OA\Property(property="alertId", type="integer", description="ID de la alerta asociada"),
 *     @OA\Property(property="duration", type="integer", description="Duración de la llamada en minutos"),
 *     @OA\Property(property="description", type="string", description="Descripción de la llamada"),
 * )
 */
class Call extends Model
{
    /** @use HasFactory<\Database\Factories\CallFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'patientId',
        'userId',
        'incoming',
        'type',
        'subType',
        'alertId',
        'duration',
        'description',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patientId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function alert()
    {
        return $this->belongsTo(Alert::class, 'alertId');
    }

    public function getTypeAndSubtypeAttribute()
    {
        // return $this->type . ' - ' . $this->subType;
        return $this->type;
    }
}
