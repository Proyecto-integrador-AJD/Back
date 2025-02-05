<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlertUpdateRequest extends FormRequest
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
            'description' => 'required|max:255',
            'location' => 'required|max:255',
            'patientId' => 'required|exists:patients,id',
            'type' => 'required|string|max:255',
            'subType' => 'required|string|max:255',
            'startDate' => 'required|date',
            'isRecurring' => 'required|boolean',
            'recurrenceType' => 'nullable|string',
            'recurrence' => 'nullable|integer', // no se para que es
        ];
    }

    public function messages(){
        return[
            'name.required' => 'El camp "Nom" és obligatori.',
            'name.unique' => 'Aquest nom ja està en ús. Si us plau, tria un altre.',
            'description.required' => 'El camp "Descripció" és obligatori.',
            'description.max' => 'La descripció no pot superar els 255 caràcters.',
            'location.required' => 'El camp "Ubicació" és obligatori.',
            'location.max' => 'La ubicació no pot superar els 255 caràcters.',
            'patientId.required' => 'El camp "Pacient" és obligatori.',
            'patientId.exists' => 'El pacient seleccionat no existeix.',
            'type.required' => 'El camp "Tipus" és obligatori.',
            'type.string' => 'El camp "Tipus" ha de ser una cadena de caràcters.',
            'type.max' => 'El camp "Tipus" no pot superar els 255 caràcters.',
            'subType.required' => 'El camp "Subtipus" és obligatori.',
            'subType.string' => 'El camp "Subtipus" ha de ser una cadena de caràcters.',
            'subType.max' => 'El camp "Subtipus" no pot superar els 255 caràcters.',
            'startDate.required' => 'El camp "Data d\'inici" és obligatori.',
            'startDate.date' => 'El camp "Data d\'inici" ha de ser una data.',
            'isRecurring.required' => 'El camp "Es recurrent" és obligatori.',
            'isRecurring.boolean' => 'El camp "Es recurrent" ha de ser un booleà.',
            'recurrenceType.string' => 'El camp "Tipus de recurrència" ha de ser una cadena de caràcters.',
            'recurrence.integer' => 'El camp "Recurrencia" ha de ser un enter.',
        ];
    }
}
