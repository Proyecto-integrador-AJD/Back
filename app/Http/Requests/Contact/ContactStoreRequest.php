<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ContactStoreRequest",
 *     type="object",
 *     required={"name", "lastName", "email", "prefix", "phone", "patientId", "relationship"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del contacto",
 *         example="Juan"
 *     ),
 *     @OA\Property(
 *         property="lastName",
 *         type="string",
 *         description="Apellido del contacto",
 *         example="Pérez"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="Correo electrónico del contacto",
 *         example="juan.perez@example.com"
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
 *         example="Madre"
 *     )
 * )
 */
class ContactStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'prefix' => 'required|string|exists:prefixes,prefix',
            'phone' => 'required|integer',
            'patientId' => 'required|exists:patients,id',
            'relationship' => 'required|string|exists:relationships,name',
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
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de caracteres.',
            'name.max' => 'El campo nombre no puede tener más de 255 caracteres.',
            'lastName.required' => 'El campo apellido es obligatorio.',
            'lastName.string' => 'El campo apellido debe ser una cadena de caracteres.',
            'lastName.max' => 'El campo apellido no puede tener más de 255 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.max' => 'El campo email no puede tener más de 255 caracteres.',
            'prefix.required' => 'El campo prefijo es obligatorio.',
            'prefix.exists' => 'El prefijo seleccionado no es válido.',
            'phone.required' => 'El campo teléfono es obligatorio.',
            'phone.integer' => 'El campo teléfono debe ser un número entero.',
            'patientId.required' => 'El campo ID del paciente es obligatorio.',
            'patientId.exists' => 'El ID del paciente proporcionado no existe.',
            'relationship.required' => 'El campo relación es obligatorio.',
            'relationship.exists' => 'La relación proporcionada no existe.',
        ];
    }
}
