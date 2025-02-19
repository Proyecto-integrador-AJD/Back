<?php

namespace App\Http\Requests\Call;

use Illuminate\Foundation\Http\FormRequest;

class CallUpdateRequest extends FormRequest
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
            'date' => 'date',
            'patientId' => 'exists:patients,id',
            'userId' => 'exists:users,id',
            'incoming' => 'boolean',
            'type' => 'string',
            'subType' => 'string',
            'alertId' => 'nullable|exists:alerts,id',
            'duration' => 'integer',
            'description' => 'string',
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
            'date.date' => 'El camp "Data" ha de ser una data vàlida.',
            'patientId.exists' => 'L\'ID del pacient proporcionat no és vàlid.',
            'userId.exists' => 'L\'ID de l\'usuari proporcionat no és vàlid.',
            'incoming.boolean' => 'El camp "Entrant" ha de ser un valor booleà.',
            'type.string' => 'El camp "Tipus" ha de ser una cadena de caràcters.',
            'subType.string' => 'El camp "Subtipus" ha de ser una cadena de caràcters.',
            'alertId.exists' => 'L\'ID de l\'alerta proporcionat no és vàlid.',
            'duration.integer' => 'El camp "Durada" ha de ser un valor enter.',
            'description.string' => 'El camp "Descripció" ha de ser una cadena de caràcters.',
        ];
    }
}
