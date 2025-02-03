<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
