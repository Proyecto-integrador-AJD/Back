<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(
 *     schema="Zone",
 *     description="Esquema del model Zona",
 *     @OA\Property(property="name", type="string", description="Nombre de la zona"),
 *     @OA\Property(property="description", type="string", description="Descripcion de la zona"),
 *     @OA\Property(property="location", type="string", description="Ubicacion de la zona"),
 *     
 * )
 */

class Zone extends Model
{
    /** @use HasFactory<\Database\Factories\ZoneFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'usuario_zona', 'zoneId', 'userId');
    }

}
