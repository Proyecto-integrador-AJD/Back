<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlertType extends Model
{
    protected $table = 'alertTypes';
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['name', 'spanishName', 'valencianName'];

    public function subtypes(): HasMany
    {
        return $this->hasMany(AlertSubtype::class, 'alertTypeName', 'name');
    }
}
