<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecurrenceType extends Model
{
    protected $table = 'recurrenceTypes';
    protected $fillable = ['name', 'spanishName', 'valencianName'];
    public $timestamps = false;
}
