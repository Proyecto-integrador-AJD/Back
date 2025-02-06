<?php

namespace App\Http\Requests;

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
            'name' => 'required|unique:zone|max:255',
            'email' => 'required|unique:contacts|max:255',
            'prefix' => 'required|string',
            'phone' => 'required|integer',
            'patientId' => 'required|exists:patients,id',
            'relationship' => 'required|string',
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
            'email.required' => 'El camp "Email" és obligatori.',
            'email.unique' => 'Aquest email ja està en ús. Si us plau, tria un altre.',
            'prefix.required' => 'El camp "Prefix" és obligatori.',
            'prefix.string' => 'El camp "Prefix" ha de ser una cadena de caràcters.',
            'phone.required' => 'El camp "Telèfon" és obligatori.',
            'phone.integer' => 'El camp "Telèfon" ha de ser un número enter.',
            'patientId.required' => 'El camp "ID del pacient" és obligatori.',
            'patientId.exists' => 'L\'ID del pacient proporcionat no existeix.',
            'relationship.required' => 'El camp "Relació" és obligatori.',
            'relationship.string' => 'El camp "Relació" ha de ser una cadena de caràcters.',
        ];
    }
}
