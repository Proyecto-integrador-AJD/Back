<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CsvToArrayCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return explode(',', $value); // Convierte CSV a array
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return is_array($value) ? implode(',', $value) : $value; // Convierte array a CSV
    }
}
