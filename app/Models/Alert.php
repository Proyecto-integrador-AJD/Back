<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
