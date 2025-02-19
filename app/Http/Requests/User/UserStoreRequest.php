<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Language;

/**
 * @OA\Schema(
 *     schema="UserStoreRequest",
 *     type="object",
 *     required={"name", "lastName", "email", "prefix", "phone", "language", "dateHire", "username", "password"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del usuario",
 *         example="Juan"
 *     ),
 *     @OA\Property(
 *         property="lastName",
 *         type="string",
 *         description="Apellido del usuario",
 *         example="Pérez"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="Correo electrónico del usuario",
 *         example="juan.perez@example.com"
 *     ),
 *     @OA\Property(
 *         property="prefix",
 *         type="string",
 *         description="Prefijo telefónico del usuario",
 *         example="+34"
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="integer",
 *         description="Número de teléfono del usuario",
 *         example="123456789"
 *     ),

 *     @OA\Property(
 *         property="language",
 *         type="array",
 *         description="Idiomas del usuario",
 *         @OA\Items(
 *             type="string",
 *             example="english"
 *         ),
 *         example={"english"}
 *     ),
 *     @OA\Property(
 *         property="dateHire",
 *         type="string",
 *         format="date",
 *         description="Fecha de contratación del usuario",
 *         example="2025-02-19"
 *     ),
 *     @OA\Property(
 *         property="dateTermination",
 *         type="string",
 *         format="date",
 *         description="Fecha de terminación del usuario",
 *         example="2026-02-19"
 *     ),
 *     @OA\Property(
 *         property="username",
 *         type="string",
 *         description="Nombre de usuario",
 *         example="juanperez"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         description="Contraseña del usuario",
 *         example="password123"
 *     )
 * )
 */
class UserStoreRequest extends FormRequest
{
    /**
     * Determina si l'usuari està autoritzat a fer aquesta petició.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obté les regles de validació aplicables a la petició.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $current=$this->route('user');
        // dd($current);
        return [
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'prefix' => 'required|exists:prefixes,prefix',
            'phone' => 'required|integer',
            'role' => 'string',
            'language' => 'required|array',
            'language.*' => 'string|exists:languages,name|max:255',
            'dateHire' => 'required|date',
            'dateTermination' => 'nullable|date',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|max:255',
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
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no puede tener más de 255 caracteres.',
            'lastName.required' => 'El campo apellido es obligatorio.',
            'lastName.string' => 'El campo apellido debe ser una cadena de texto.',
            'lastName.max' => 'El campo apellido no puede tener más de 255 caracteres.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya ha sido registrado.',
            'email.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El campo correo electrónico no puede tener más de 255 caracteres.',
            'role' => 'El campo rol debe ser una cadena de texto.',
            'prefix.required' => 'El campo prefijo es obligatorio.',
            'prefix.exists' => 'El prefijo seleccionado no es válido.',
            'phone.required' => 'El campo teléfono es obligatorio.',
            'phone.integer' => 'El campo teléfono debe ser un número entero.',
            'language.required' => 'El campo idioma es obligatorio.',
            'language.array' => 'El campo idioma debe ser un array.',
            'language.*.string' => 'El campo idioma debe ser una cadena de texto.',
            'language.*.max' => 'El campo idioma no puede tener más de 255 caracteres.',
            'dateHire.required' => 'El campo fecha de contratación es obligatorio.',
            'dateHire.date' => 'El campo fecha de contratación debe ser una fecha válida.',
            'dateTermination.nullable' => 'El campo fecha de terminación debe ser nulo.',
            'dateTermination.date' => 'El campo fecha de terminación debe ser una fecha válida.',
            'username.required' => 'El campo nombre de usuario es obligatorio.',
            'username.string' => 'El campo nombre de usuario debe ser una cadena de texto.',
            'username.max' => 'El campo nombre de usuario no puede tener más de 255 caracteres.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto.',
            'password.max' => 'El campo contraseña no puede tener más de 255 caracteres.',
        ];
    }
}
