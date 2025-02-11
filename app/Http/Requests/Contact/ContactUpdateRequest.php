<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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
            'email' => 'email|max:255',
            'prefix' => 'string',
            'phone' => 'integer',
            'patientId' => 'exists:patients,id',
            'relationship' => 'string',
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
            'name.string' => 'El campo "Nombre" debe ser una cadena de caracteres.',
            'name.max' => 'El campo "Nombre" no puede tener más de 255 caracteres.',
            'lastName.string' => 'El campo "Apellido" debe ser una cadena de caracteres.',
            'lastName.max' => 'El campo "Apellido" no puede tener más de 255 caracteres.',
            'email.email' => 'El campo "Email" debe ser una dirección de correo electrónico válida.',
            'email.max' => 'El campo "Email" no puede tener más de 255 caracteres.',
            'prefix.string' => 'El campo "Prefijo" debe ser una cadena de caracteres.',
            'phone.integer' => 'El campo "Teléfono" debe ser un número entero.',
            'patientId.exists' => 'El campo "ID del paciente" no existe en la tabla de pacientes.',
            'relationship.string' => 'El campo "Relación" debe ser una cadena de caracteres.',
        ];
    }
}
