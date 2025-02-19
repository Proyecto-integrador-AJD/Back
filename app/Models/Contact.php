<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Contact",
 *     description="Esquema del modelo Contacto",
 *     @OA\Property(property="id", type="integer", description="ID del contacto"),
 *     @OA\Property(property="name", type="string", description="Nombre del contacto"),
 *     @OA\Property(property="lastName", type="string", description="Apellido del contacto"),
 *     @OA\Property(property="email", type="string", description="Correo electrónico del contacto"),
 *     @OA\Property(property="prefix", type="string", description="Prefijo del contacto"),
 *     @OA\Property(property="phone", type="string", description="Número de teléfono del contacto"),
 *     @OA\Property(property="patientId", type="integer", description="ID del paciente asociado al contacto"),
 *     @OA\Property(property="relationship", type="string", description="Relación con el paciente"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación del contacto"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización del contacto"),
 *     @OA\Property(property="patient", ref="#/components/schemas/Patient", description="Paciente asociado al contacto")
 * )
 */
class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ZoneFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'lastName',
        'email',
        'prefix',
        'phone',
        'patientId',
        'relationship',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patientId');
    }

    
}
