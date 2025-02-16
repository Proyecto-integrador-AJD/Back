<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlertSubtype extends Model
{
    protected $table = 'alertSubtypes';

    protected $fillable = ['alertTypeName', 'name', 'spanishName', 'valencianName'];

    public function type()
    {
        return $this->belongsTo(AlertType::class, 'alertTypeName', 'name');
    }
}
