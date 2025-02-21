<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\{Language};
use App\Casts\CsvToArrayCast;

/**
 * @OA\Schema(
 *     schema="User",
 *     description="Esquema del modelo Usuario",
 *     @OA\Property(property="id", type="integer", description="ID del usuario"),
 *     @OA\Property(property="name", type="string", description="Nombre del usuario"),
 *     @OA\Property(property="lastName", type="string", description="Apellido del usuario"),
 *     @OA\Property(property="email", type="string", description="Correo electrónico del usuario"),
 *     @OA\Property(property="password", type="string", description="Contraseña del usuario"),
 *     @OA\Property(property="phone", type="string", description="Número de teléfono del usuario"),
 *     @OA\Property(property="dateHire", type="string", format="date", description="Fecha de contratación"),
 *     @OA\Property(property="dateTermination", type="string", format="date", description="Fecha de terminación (si aplica)"),
 *     @OA\Property(property="username", type="string", description="Nombre de usuario para autenticación"),
 *     @OA\Property(property="language", type="array", @OA\Items(type="string"), description="Idiomas hablados por el usuario"),
 *     @OA\Property(property="prefix", type="string", description="Prefijo asociado al usuario"),
 *     @OA\Property(property="zones", type="array", 
 *         @OA\Items(ref="#/components/schemas/Zone"), description="Zonas asignadas al usuario"),
 *     @OA\Property(property="patients", type="array", 
 *         @OA\Items(ref="#/components/schemas/Patient"), description="Pacientes asignados al usuario"),
 *     @OA\Property(property="calls", type="array", 
 *         @OA\Items(ref="#/components/schemas/Call"), description="Llamadas realizadas por el usuario"),
 *     @OA\Property(property="alerts", type="array", 
 *         @OA\Items(ref="#/components/schemas/Alert"), description="Alertas asociadas al usuario"),
 * )
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastName',
        'email',
        'password',
        'role',
        'phone',
        'dateHire',
        'dateTermination',
        'username',
        'language',
        'prefix'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin(): bool
    {
        return isset($this->role) && $this->role === 'admintrator';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'language' => CsvToArrayCast::class,
        ];
    }

    protected $attributes = [
        'language' => 'Castellano,Valenciano',
    ];
    

    public function zones()
    {
        return $this->belongsToMany(Zone::class, 'users_zones', 'userId', 'zoneId');
    }

    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'userId');
    }

    public function calls()
    {
        return $this->hasMany(Call::class, 'userId');
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class, 'userId');
    }


    
    
}
