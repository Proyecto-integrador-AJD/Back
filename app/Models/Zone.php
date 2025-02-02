<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsToMany(User::class);
    }

    // public function patients()
    // {
    //     return $this->belongsToMany(User::class);
    // }


    
}
