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
            'date' => 'required|date',
            'patientId' => 'required|exists:patients,id',
            'userId' => 'required|exists:users,id',
            'incoming' => 'required|boolean',
            'type' => 'required|string',
            'subType' => 'required|string',
            'alertId' => 'required|exists:alerts,id',
            'duration' => 'required|integer',
            'description' => 'required|string',
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
            'date.required' => 'El camp "Data" és obligatori.',
            'date.date' => 'El camp "Data" ha de ser una data vàlida.',
            'patientId.required' => 'El camp "ID del pacient" és obligatori.',
            'patientId.exists' => 'L\'ID del pacient proporcionat no és vàlid.',
            'userId.required' => 'El camp "ID de l\'usuari" és obligatori.',
            'userId.exists' => 'L\'ID de l\'usuari proporcionat no és vàlid.',
            'incoming.required' => 'El camp "Entrant" és obligatori.',
            'incoming.boolean' => 'El camp "Entrant" ha de ser un valor booleà.',
            'type.required' => 'El camp "Tipus" és obligatori.',
            'type.string' => 'El camp "Tipus" ha de ser una cadena de caràcters.',
            'subType.required' => 'El camp "Subtipus" és obligatori.',
            'subType.string' => 'El camp "Subtipus" ha de ser una cadena de caràcters.',
            'alertId.required' => 'El camp "ID de l\'alerta" és obligatori.',
            'alertId.exists' => 'L\'ID de l\'alerta proporcionat no és vàlid.',
            'duration.required' => 'El camp "Durada" és obligatori.',
            'duration.integer' => 'El camp "Durada" ha de ser un valor enter.',
            'description.required' => 'El camp "Descripció" és obligatori.',
            'description.string' => 'El camp "Descripció" ha de ser una cadena de caràcters.',
        ];
    }
}
