<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ZoneFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'lastName',
        'email',
        'prefixId',
        'phone',
        'patientId',
        'relationship',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patientId');
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class, 'relationshipId');
    }

    public function prefix()
    {
        return $this->belongsTo(Prefix::class, 'prefixId');
    }
}
