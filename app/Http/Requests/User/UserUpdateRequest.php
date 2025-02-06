<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'prefix' => 'required|string|max:255',
            'phone' => 'required|integer|max:255',
            'language' => 'required|array',
            'dateHire' => 'required|date',
            'dateTermination' => 'nullable|date',
            'username' => 'required|string|max:255',
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
            'name.required' => 'El camp "Nom" és obligatori.',
            'name.unique' => 'Aquest nom ja està en ús. Si us plau, tria un altre.',
            'role.required' => 'El camp "Rol" és obligatori.',
            'role.max' => 'El rol no pot superar els 255 caràcters.',
            'lastName.required' => 'El camp "Cognom" és obligatori.',
            'lastName.max' => 'El cognom no pot superar els 255 caràcters.',
            'email.required' => 'El camp "Email" és obligatori.',
            'email.email' => 'El format de l\'email no és vàlid.',
            'email.max' => 'L\'email no pot superar els 255 caràcters.',
            'prefix.required' => 'El camp "Prefix" és obligatori.',
            'prefix.max' => 'El prefix no pot superar els 255 caràcters.',
            'phone.required' => 'El camp "Telèfon" és obligatori.',
            'phone.integer' => 'El telèfon ha de ser un número enter.',
            'phone.max' => 'El telèfon no pot superar els 255 caràcters.',
            'language.required' => 'El camp "Idioma" és obligatori.',
            'dateHire.required' => 'El camp "Data d\'alta" és obligatori.',
            'dateHire.date' => 'El format de la data d\'alta no és vàlid.',
            'dateTermination.date' => 'El format de la data de baixa no és vàlid.',
            'username.required' => 'El camp "Nom d\'usuari" és obligatori.',
            'username.max' => 'El nom d\'usuari no pot superar els 255 caràcters.',
            'password.required' => 'El camp "Contrasenya" és obligatori.',
            'password.max' => 'La contrasenya no pot superar els 255 caràcters.',
        ];
    }
}
