<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class TypeCall extends Model
{
    /** @use HasFactory<\Database\Factories\TypeCallFactory> */
    use HasFactory;

    protected $table = 'typecall';

    protected $fillable = [
        'name',
        'spanishName',
        'valencianName',
        'incoming',
    ];

    public function subtypes(): HasMany
    {
        return $this->hasMany(SubTypeCall::class, 'typecall_id');
    }
}
?>