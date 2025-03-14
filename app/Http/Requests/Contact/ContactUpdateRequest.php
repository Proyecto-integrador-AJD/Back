<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ContactUpdateRequest",
 *     type="object",
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del contacto",
 *         example="Juan",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="lastName",
 *         type="string",
 *         description="Apellido del contacto",
 *         example="Pérez",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="Correo electrónico del contacto",
 *         example="juan.perez@example.com",
 *         maxLength=255
 *     ),
 *     @OA\Property(
 *         property="prefix",
 *         type="string",
 *         description="Prefijo telefónico del contacto",
 *         example="+34"
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="integer",
 *         description="Número de teléfono del contacto",
 *         example="612345678"
 *     ),
 *     @OA\Property(
 *         property="patientId",
 *         type="integer",
 *         description="ID del paciente asociado al contacto",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="relationship",
 *         type="string",
 *         description="Relación del contacto con el paciente",
 *         example="sister"
 *     )
 * )
 */
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
            'prefix' => 'exists:prefixes,prefix',
            'phone' => 'integer',
            'patientId' => 'exists:patients,id',
            'relationship' => 'exists:relationships,name',
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
            'prefix.exists' => 'El campo "Prefijo" seleccionado no es válido.',
            'phone.integer' => 'El campo "Teléfono" debe ser un número entero.',
            'patientId.exists' => 'El campo "ID del paciente" no existe en la tabla de pacientes.',
            'relationship.exists' => 'El campo "Relación" no existe en la tabla de relaciones.',
        ];
    }
}
