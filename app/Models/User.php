<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\{Language};
use App\Casts\CsvToArrayCast;

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
        return $this->role === 'admintrator';
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
        'language' => Language::SPANISH->value . ',' . Language::CATALAN->value,
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
