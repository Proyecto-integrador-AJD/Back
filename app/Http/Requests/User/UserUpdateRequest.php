<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Language;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determina si l'usuari està autoritzat a fer aquesta petició.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['admintrator', 'operator']);
    }

    /**
     * Obté les regles de validació aplicables a la petició.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'lastName' => 'string|max:255',
            'prefix' => 'string|max:255',
            'phone' => 'integer',
            'role' => 'string',
            'language' => 'array',
            'language.*' => 'string|max:255',
            'dateHire' => 'date',
            'dateTermination' => 'nullable|date',
            'password' => 'string|max:255',
        ];
    }

    /**
     * Obté els missatges d'error personalitzats per a cada regla.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no puede tener más de 255 caracteres.',
            'lastName.string' => 'El campo apellido debe ser una cadena de texto.',
            'lastName.max' => 'El campo apellido no puede tener más de 255 caracteres.',
            'prefix.string' => 'El campo prefijo debe ser una cadena de texto.',
            'prefix.max' => 'El campo prefijo no puede tener más de 255 caracteres.',
            'phone.integer' => 'El campo teléfono debe ser un número entero.',
            'role.string' => 'El campo rol debe ser una cadena de texto.',
            'language.array' => 'El campo idioma debe ser un array.',
            'language.*.string' => 'El campo idioma debe ser una cadena de texto.',
            'language.*.max' => 'El campo idioma no puede tener más de 255 caracteres.',
            'dateHire.date' => 'El campo fecha de contratación debe ser una fecha válida.',
            'dateTermination.nullable' => 'El campo fecha de terminación debe ser nulo.',
            'dateTermination.date' => 'El campo fecha de terminación debe ser una fecha válida.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto.',
            'password.max' => 'El campo contraseña no puede tener más de 255 caracteres.',
        ];
    }
}
